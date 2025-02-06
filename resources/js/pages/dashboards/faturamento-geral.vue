<script setup>
import AppDateTimePicker from '@/@core/components/app-form-elements/AppDateTimePicker.vue'
import BarChart from '@/@core/libs/chartjs/components/BarChart'
import { onMounted } from 'vue'
import Spinner from '../components/spinner.vue'

//TODO: Melhorar feedback na hora de clicar no grafico, (loading)

const chartVars = {
  labels: [
    'Ordens de Serviço',
    'Nota Fiscal de Serviço apenas',
    'Ordens de Serviço e Nota Fiscal de Serviço',
    'Sem vínculo',
  ],
  label: 'Faturamento (R$)',
  colors: {
    1: '#2c3791',
    2: '#ed6168',
    3: '#61ed61',
    4: '#949494',
  },
}

const chartOptions = {
  indexAxis: 'y',
}

const startDate = ref()
const finalDate = ref()
const loading = ref(false)
const fatResponse = ref()
const chartData = ref()

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

const getDataForStatus = codeStatus => {
  return chartVars.labels.map(label => {
    return fatResponse.value.fat
      .filter(item => item.status.CODIGO === codeStatus && item.tipo_conta === label)
      .reduce((acc, item) => acc + item.total, 0)
  })
}

const getFat = async () => {
  loading.value = true
  try{
    const response = await $api('dashboards/faturamento-geral', {
      method: 'GET',
      onResponseError({ response }) {
        errors.value = response._data.errors
      },
    })

    fatResponse.value = response
    

    chartData.value = {
      labels: chartVars.labels,
      datasets: [
        {
          label: 'Total a Vencer',
          data: getDataForStatus(1),
          backgroundColor: chartVars.colors[1],
        },
        {
          label: 'Vencido',
          data: getDataForStatus(2),
          backgroundColor: chartVars.colors[2],
        },
        {
          label: 'Quitado',
          data: getDataForStatus(3),
          backgroundColor: chartVars.colors[3],
        },
        {
          label: 'Cancelado',
          data: getDataForStatus(4),
          backgroundColor: chartVars.colors[4],
        },
      ],
    }
  }catch (err) {
    console.error(err)
  }finally{
    loading.value = false
  }
}

const getNfsByDateInterval = async () => {
  if(startDate.value > finalDate.value){
    return false
  }
  loading.value = true
  try{
    const response = await $api('dashboards/clientes-nfs-date', {
      method: 'POST',
      body: {
        startDate: startDate.value,
        finalDate: finalDate.value,
      },
      onResponseError({ response }) {
        errors.value = response._data.errors
      },
    })

    nfsResponse.value = response
    startDate.value = nfsResponse.value.dates.startDate
    finalDate.value = nfsResponse.value.dates.finalDate
    totalNfs.value = nfsResponse.value.totalNfs

    nfsData.value = {
      labels: nfsResponse.value.data.map(item => item.client ? item.client.NOME_FANTASIA : null),
      datasets: [
        {
          label: chartVars.label,
          backgroundColor: chartVars.backgroundColor,
          data: response.data.map(item => item.total),
          clientIds: nfsResponse.value.data.map(item => item.client ? item.client.CODIGO : null),
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
      getNfsByDateInterval()
  })
}

onMounted(() => {
  getFat()
})
</script>

<template>
  <h1>Dashboards NFS X Clientes</h1>
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
      <h2>NFS Totais</h2>
      <span class="text-2xl font-weight-bold">{{ totalNfs }}</span>
    </div>
    <BarChart
      :data="chartData || { labels: [], datasets: [] }"
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
