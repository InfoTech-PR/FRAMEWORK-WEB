<script setup>
import { onMounted } from 'vue'
import { useRoute } from 'vue-router'
import Spinner from '../components/spinner.vue'



const route = useRoute()
const ordersData = ref()
const loading = ref(false)
const orderResponse = ref()

const serviceOrder = ref({})
const client = ref({})
const type = ref({})
const ship = ref({})
const status = ref({})
const modal = ref({})
const modality = ref({})
const dispatch = ref({})

const getOrder = async () => {
  loading.value = true

  try{
    const response = await $api(`dashboards/os-detail/${route.params.id}`, {
      method: 'GET',
      onResponseError({ response }) {
        errors.value = response._data.errors
      },
    })

    orderResponse.value = response

    serviceOrder.value = orderResponse.value.serviceOrder
    serviceOrder.value.DATA_ORDEM = new Date(serviceOrder.value.DATA_ORDEM).toLocaleDateString('pt-BR')
    client.value = serviceOrder.value.client
    type.value = serviceOrder.value.type
    ship.value = serviceOrder.value.ship
    status.value = serviceOrder.value.status
    modal.value = serviceOrder.value.modal
    modality.value = serviceOrder.value.modality
    dispatch.value = serviceOrder.value.dispatch
  }catch (err) {
    console.error(err)
  }finally{
    loading.value = false
  }
}


onMounted(() => {
  getOrder()
})
</script>

<template>
  <h1>Detalhamento Cliente X Ordem de Serviço</h1>
  <VCard v-if="!loading">
    <div class="pa-6">
      <h3>{{ client.NOME_FANTASIA }} > O.S. {{ serviceOrder.NUM_OS }}</h3>
    
      <VRow>
        <VCol
          cols="12"
          md="4"
        >
          <AppTextField
            label="Data da Ordem"
            disabled
            :value="serviceOrder.DATA_ORDEM"
          />
        </VCol>
        <VCol
          cols="12"
          md="4"
        >
          <AppTextField
            label="Cliente"
            disabled
            :value="client.NOME_FANTASIA"
          />
        </VCol>
        <VCol
          cols="12"
          md="4"
        >
          <AppTextField
            label="Tipo de O.S."
            disabled
            :value="type.TIPO_SERVICO"
          />
        </VCol>
        <VCol
          cols="12"
          md="4"
        >
          <AppTextField
            label="Navio"
            disabled
            :value="ship.NAVIO"
          />
        </VCol>
        <VCol
          cols="12"
          md="4"
        >
          <AppTextField
            label="Referência"
            disabled
            :value="serviceOrder.REFERENCIA"
          />
        </VCol>
        <VCol
          cols="12"
          md="4"
        >
          <AppTextField
            label="Modal"
            disabled
            :value="modal.MODAL"
          />
        </VCol>
        <VCol
          cols="12"
          md="4"
        >
          <AppTextField
            label="Numero de D.I."
            disabled
            :value="serviceOrder.NUM_DI"
          />
        </VCol>
        <VCol
          cols="12"
          md="4"
        >
          <AppTextField
            label="Numero de L.I."
            disabled
            :value="serviceOrder.NUM_LI"
          />
        </VCol>
        <VCol
          cols="12"
          md="4"
        >
          <AppTextField
            label="B.L."
            disabled
            :value="serviceOrder.BL"
          />
        </VCol>
        <VCol
          cols="12"
          md="4"
        >
          <AppTextField
            label="Modalidade"
            disabled
            :value="modality.MODALIDADE_OS"
          />
        </VCol>
        <VCol
          cols="12"
          md="4"
        >
          <AppTextField
            label="Despacho"
            disabled
            :value="dispatch.DESPACHO"
          />
        </VCol>
        <VCol
          cols="12"
          md="4"
        >
          <AppTextField
            label="Status da O.S."
            disabled
            :value="status.SITUACAO"
          />
        </VCol>
        <VCol
          cols="12"
          md="3"
        >
          <AppTextField
            label="Valor"
            disabled
            :value="`R$${serviceOrder.VALOR_RECEBIDO}`"
          />
        </VCol>
        <VCol
          cols="12"
          md="3"
        >
          <AppTextField
            label="Total Gasto"
            disabled
            :value="`R$${serviceOrder.TOTAL_GASTO_DOC}`"
          />
        </VCol>
        <VCol
          cols="12"
          md="3"
        >
          <AppTextField
            label="Valor Total"
            disabled
            :value="`R$${serviceOrder.VALOR_TOTAL}`"
          />
        </VCol>
        <VCol
          cols="12"
          md="3"
        >
          <AppTextField
            label="Saldo Restante"
            disabled
            :value="`R$${serviceOrder.SALDO_RESTANTE}`"
          />
        </VCol>
      </VRow>
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
