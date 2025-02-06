<script setup>
import AppSelect from '@/@core/components/app-form-elements/AppSelect.vue'
import BarChart from '@/@core/libs/chartjs/components/BarChart'
import { router } from '@/plugins/1.router'
import { onMounted } from 'vue'
import { useRoute } from 'vue-router'
import Spinner from '../components/spinner.vue'



const route = useRoute()

const chartVars = {
  label: 'Ordens de Serviço',
  backgroundColor: '#42A5F5',
}

const client = ref({ })
const ordersData = ref()
const loading = ref(false)
const orderResponse = ref()

const serviceOrders = ref([{}])

const modals = ref([{}])
const modalSelect = ref()

const modalities = ref([{}])
const modalitySelect = ref()

const serviceTypes = ref([{}])
const serviceTypeSelect = ref()

const errors = ref({
  
})

const tableHeaders = [  
  { title: 'Ação', value: 'actions' },
  { title: 'N O.S.', value: 'NUM_OS' },
  { title: 'Data', value: 'DATA_ORDEM' },
  { title: 'Status', value: 'status.SITUACAO' },
  { title: 'Referência', value: 'REFERENCIA' },
  { title: 'Navio', value: 'ship.NAVIO' },
  { title: 'Valor', value: 'VALOR_RECEBIDO' },
]


const getOrders = async () => {
  loading.value = true

  try{
    const response = await $api(`dashboards/os-cliente/${route.params.id}`, {
      method: 'GET',
      onResponseError({ response }) {
        errors.value = response._data.errors
      },
    })

    orderResponse.value = response
    client.value = orderResponse.value.client
    modals.value = orderResponse.value.modals
    modalities.value = orderResponse.value.modalities
    serviceTypes.value = orderResponse.value.serviceTypes

    serviceOrders.value = orderResponse.value.orders.map(order => ({
      ...order,
      DATA_ORDEM: new Date(order.DATA_ORDEM).toLocaleDateString('pt-BR'), VALOR_RECEBIDO: `R$${order.VALOR_RECEBIDO}`,
    })) 

    ordersData.value = {
      labels: orderResponse.value.data.map(item => item.status ? item.status.SITUACAO : null),
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

const getOrdersFilter = async () => {
  loading.value = true

  try{
    const response = await $api(`dashboards/os-cliente/${route.params.id}/filter`, {
      method: 'POST',
      body: {
        modalSelect: modalSelect.value,
        modalitySelect: modalitySelect.value,
        serviceTypeSelect: serviceTypeSelect.value,
      },
      onResponseError({ response }) {
        if(response.status == 500){
          errors.value = 'Ocorreu um erro ao recuperar os dados pelo filtro'
        }
      },
    })

    orderResponse.value = response
    client.value = orderResponse.value.client
    modals.value = orderResponse.value.modals
    modalities.value = orderResponse.value.modalities
    serviceTypes.value = orderResponse.value.serviceTypes

    serviceOrders.value = orderResponse.value.orders.map(order => ({
      ...order,
      DATA_ORDEM: new Date(order.DATA_ORDEM).toLocaleDateString('pt-BR'), VALOR_RECEBIDO: `R$${order.VALOR_RECEBIDO}`,
    })) 

    ordersData.value = {
      labels: orderResponse.value.data.map(item => item.status ? item.status.SITUACAO : null),
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
  getOrdersFilter()
}

const redirectToOrder = order => {
  loading.value = true;
  router.push({ name: 'ordem-servico', params: { id: order.CODIGO } })
}

onMounted(() => {
  getOrders()
})
</script>

<template>
  <h1>Detalhamento Cliente X Ordem de Serviço</h1>
  <VCard v-if="!loading">
    <div class="pa-3">
      <VForm @submit.prevent="onSubmit">
        <VRow class="match-height">
          <VCol cols="12">
            <h3>{{ client.NOME_FANTASIA }}</h3>
          </VCol>
          <VCol cols="12">
            <VRow> 
              <VCol cols="4">
                <AppSelect
                  v-model="modalSelect"
                  label="Modal"
                  :items="modals"
                  item-title="MODAL"
                  item-value="CODIGO"
                />
              </VCol>
              <VCol cols="4">
                <AppSelect
                  v-model="modalitySelect"
                  label="Modalidade"
                  :items="modalities"
                  item-title="MODALIDADE_OS"
                  item-value="CODIGO"
                />
              </VCol>
              <VCol cols="4">
                <AppSelect
                  v-model="serviceTypeSelect"
                  label="Tipo de O.S."
                  :items="serviceTypes"
                  item-title="TIPO_SERVICO"
                  item-value="CODIGO"
                />
              </VCol>
            </VRow>
          </VCol>
        </VRow>
        <VRow>
          <VCol cols="6">
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
          </VCol>
          <VCol cols="6">
            <VBtn
              block
              type="reset"
              color="logo-red-lighter"
            >
              Limpar Filtros
              <VIcon
                icon="tabler-trash"
                size="20"
                class="mx-2"
              />
            </VBtn>
          </VCol>
        </VRow>
      </VForm>
    
      <BarChart
        :data="ordersData || { labels: [], datasets: [] }"
        :height="150"
      />
      <div class="my-6">
        <h3 class="text-center my-2">
          {{ serviceOrders.length }} Ordens de Serviços Encontradas para {{ client.NOME_FANTASIA }}
        </h3>
        <VDataTable
          :items="serviceOrders"
          :headers="tableHeaders"
        >
          <template #item.actions="{ item }">
            <VBtn @click="redirectToOrder(item)">
              <VIcon
                size="24"
                icon="tabler-search"
              />
            </VBtn>
          </template>
        </VDataTable>
      </div>
    </div>
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
