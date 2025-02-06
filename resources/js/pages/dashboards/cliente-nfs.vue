<script setup>
import AppDateTimePicker from '@/@core/components/app-form-elements/AppDateTimePicker.vue'
import AppSelect from '@/@core/components/app-form-elements/AppSelect.vue'
import AppTextField from '@/@core/components/app-form-elements/AppTextField.vue'
import { router } from '@/plugins/1.router'
import { onMounted } from 'vue'
import { useRoute } from 'vue-router'
import Spinner from '../components/spinner.vue'



const route = useRoute()

const chartVars = {
  label: 'Ordens de Serviço',
  backgroundColor: '#42A5F5',
}

const client = ref({})
const allNfs = ref([{}]) 
const showNfs = ref([{}])
const loading = ref(false)
const nfsResponse = ref()

const nfsNumber = ref()

const creationDateSelect = ref()

const status = ref([{}])
const statusSelect = ref()

const errors = ref({
  
})

const tableHeaders = [  
  { title: 'Ação', value: 'actions' },
  { title: 'N NFSe', value: 'NUM_NFS' },
  { title: 'Cliente', value: 'NOME' },
  { title: 'Nome Fantasia', value: 'NOME_FANTASIA' },
  { title: 'Status', value: 'status.STATUS_NFS' },
  { title: 'Sub Total', value: 'SUB_TOTAL_ITENS' },
  { title: 'Valor Total', value: 'VALOR_TOTAL' },
]


const getNfs = async () => {
  loading.value = true
  try{
    const response = await $api(`dashboards/nfs-cliente/${route.params.id}`, {
      method: 'GET',
      onResponseError({ response }) {
        errors.value = response._data.errors
      },
    })

    nfsResponse.value = response
    allNfs.value = nfsResponse.value.nfs
    showNfs.value = allNfs.value
    client.value = nfsResponse.value.client
    status.value = nfsResponse.value.allStatus

  }catch (err) {
    console.error(err)
  }finally{
    loading.value = false
  }
}

const getNfsFilter = async () => {
  loading.value = true

  try{
    showNfs.value = allNfs.value.filter(function (item) {

      const matchNumNfs = nfsNumber.value ? item.NUM_NFS.match(nfsNumber.value) : true
      const matchCreationDate = creationDateSelect.value ? item.DATA_CRIACAO == creationDateSelect.value : true
      const matchStatus = statusSelect.value ? item.COD_SITUACAO_NFS == statusSelect.value : true

      return matchNumNfs && matchCreationDate && matchStatus
    })

  }catch (err) {
    console.error(err)
  }finally{
    loading.value = false
  }
}

const onSubmit = () => {
  getNfsFilter()
}

const redirectToNfs = nfs => {
  loading.value = true
  try {
    router.push({ name: 'nota-fiscal-servico', params: { id: nfs.CODIGO } })
  } catch (err) {
    console.log(err)
  }
}

onMounted(() => {
  getNfs()
})
</script>

<template>
  <h1>Detalhamento do Cliente X Nota Fiscal de Serviço</h1>
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
                <AppTextField
                  v-model="nfsNumber"
                  label="Numero NFSe"
                />
              </VCol>
              <VCol cols="4">
                <AppDateTimePicker
                  v-model="creationDateSelect"
                  label="Data de Criação"
                />
              </VCol>
              <VCol cols="4">
                <AppSelect
                  v-model="statusSelect"
                  label="Status"
                  :items="status"
                  item-title="STATUS_NFS"
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
      <div class="my-6">
        <h3 class="text-center my-2">
          {{ showNfs.length }} Ordens de Serviços Encontradas para {{ client.NOME_FANTASIA }}
        </h3>
        <VDataTable
          :items="showNfs"
          :headers="tableHeaders"
        >
          <template #item.actions="{ item }">
            <VBtn @click="redirectToNfs(item)">
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
