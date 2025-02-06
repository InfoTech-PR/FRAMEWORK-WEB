<script setup>
import AppDateTimePicker from '@/@core/components/app-form-elements/AppDateTimePicker.vue'
import BarChart from '@/@core/libs/chartjs/components/BarChart'
import { router } from '@/plugins/1.router'
import { onMounted } from 'vue'
import Spinner from '../components/spinner.vue'

//TODO: Melhorar feedback na hora de clicar no grafico, (loading)

const chartVars = {
  label: 'Faturamento (R$)',
  backgroundColor: '#42A5F5',
}

const chartOptions = {
  onClick: function (evt, elements) {
    if (elements.length > 0) {
      loading.value = true

      const chartElement = elements[0]
      const index = chartElement.index
      const clientName = ordersData.value.labels[index]
      const clientId = ordersData.value.datasets[0].clientIds[index]
      
      router.push({ name: 'cliente-os', params: { id: clientId } })
    }
  },
  onHover: (event, activeElements) => {
    if (activeElements?.length > 0) {
      event.native.target.style.cursor = 'pointer'
    } else {
      event.native.target.style.cursor = 'auto'
    }
  },
}

const totalOrders = ref(0)
const ordersData = ref()
const startDate = ref()
const finalDate = ref()
const loading = ref(false)
const orderResponse = ref()

const refVForm = ref()

const defaultStartDate = ref()
const defaultFinalDate = ref()

const errors = ref({
  startDate: undefined, 
})

const clearFields = () => {
  startDate.value = defaultStartDate.value
  finalDate.value = defaultFinalDate.value
}

const getOrders = async () => {
  loading.value = true
  try{
    const response = await $api('dashboards/clientes-os', {
      method: 'GET',
      onResponseError({ response }) {
        errors.value = response._data.errors
      },
    })

    orderResponse.value = response
    startDate.value = orderResponse.value.dates.startDate

    //Define o valores do input de data
    finalDate.value = orderResponse.value.dates.finalDate
    totalOrders.value = orderResponse.value.totalOrders

    defaultStartDate.value = orderResponse.value.dates.startDate
    defaultFinalDate.value = orderResponse.value.dates.finalDate

    ordersData.value = {
      labels: orderResponse.value.data.map(item => item.client ? item.client.NOME_FANTASIA : null),
      datasets: [
        {
          label: chartVars.label,
          backgroundColor: chartVars.backgroundColor,
          data: response.data.map(item => item.total),
          clientIds: orderResponse.value.data.map(item => item.client ? item.client.CODIGO : null),
        },
      ],
    }
  }catch (err) {
    console.error(err)
  }finally{
    loading.value = false
  }
}

const getOrdersByDateInterval = async () => {
  if(startDate.value > finalDate.value){
    return false
  }
  loading.value = true
  try{
    const response = await $api('dashboards/clientes-os-date', {
      method: 'POST',
      body: {
        startDate: startDate.value,
        finalDate: finalDate.value,
      },
      onResponseError({ response }) {
        errors.value = response._data.errors
      },
    })

    orderResponse.value = response
    startDate.value = orderResponse.value.dates.startDate
    finalDate.value = orderResponse.value.dates.finalDate
    totalOrders.value = orderResponse.value.totalOrders

    ordersData.value = {
      labels: orderResponse.value.data.map(item => item.client ? item.client.NOME_FANTASIA : null),
      datasets: [
        {
          label: chartVars.label,
          backgroundColor: chartVars.backgroundColor,
          data: response.data.map(item => item.total),
          clientIds: orderResponse.value.data.map(item => item.client ? item.client.CODIGO : null),
        },
      ],
    }
  }catch (err) {
    console.error(err)
  }finally{
    loading.value = false
  }
}

const onSubmit = () => {
  refVForm.value?.validate().then(({ valid: isValid }) => {
    if (isValid)
      getOrdersByDateInterval()
  })
}

onMounted(() => {
  getOrders()
})
</script>

<template>
  <h1>Dashboards O.S. X Clientes</h1>
  <VCard v-if="!loading">
    <div class="pa-3">
      <VForm
        ref="refVForm"
        @submit.prevent="onSubmit"
      >
        <VRow class="match-height">
          <VCol
            cols="12"
            md="9"
          >
            <div class="border pa-3">
              <h3>Período</h3>
            
              <VRow class="match-height">
                <VCol
                  cols="12"
                  md="6"
                >
                  <AppDateTimePicker
                    v-model="startDate"
                    :rules="[requiredValidator,afterFinalDate(startDate,finalDate)]"
                    :error-messages="errors.startDate"
                    label="Data inicial"
                  />
                </VCol>
                <VCol
                  cols="12"
                  md="6"
                >
                  <AppDateTimePicker
                    v-model="finalDate"
                    label="Data final"
                  />
                </VCol>
              </VRow>
            </div>
          </VCol>
          <VCol
            cols="12"
            md="3"
          >
            <div class="d-flex flex-column justify-space-between fill-height gap-8">
              <VBtn
                block
                type="submit"
              >
                Pesquisar
                <VIcon
                  icon="tabler-search"
                  size="20"
                  class="mx-2"
                />
              </VBtn>
              <VBtn
                block
                type="button"
                color="logo-red-lighter"
                @click="clearFields"
              >
                Limpar Filtros
                <VIcon
                  icon="tabler-trash"
                  size="20"
                  class="mx-2"
                />
              </VBtn>
            </div>
          </VCol>
        </VRow>
      </VForm>
    </div>
    <div class="text-center my-3">
      <h2>Ordem de Serviço Totais</h2>
      <span class="text-2xl font-weight-bold">{{ totalOrders }}</span>
    </div>
    <BarChart
      :data="ordersData || { labels: [], datasets: [] }"
      :height="150"
      :options="chartOptions"
    />
  </VCard>
  <h1
    v-else
    class="text-center"
  >
    <Spinner />
  </h1>
</template>

<style lang="scss">
@use "@core-scss/template/libs/apex-chart";
</style>
