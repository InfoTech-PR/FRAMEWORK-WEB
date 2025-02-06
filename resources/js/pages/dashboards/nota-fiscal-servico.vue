<script setup>
import AppTextarea from '@/@core/components/app-form-elements/AppTextarea.vue'
import { onMounted } from 'vue'
import { useRoute } from 'vue-router'
import Spinner from '../components/spinner.vue'



const route = useRoute()
const loading = ref(false)
const nfsResponse = ref()

const nfs = ref({
  OBSERVACOES: '',
})

const services = ref([{}])
const client = ref({})

const getOrder = async () => {
  loading.value = true

  try{
    const response = await $api(`dashboards/nfs-detail/${route.params.id}`, {
      method: 'GET',
      onResponseError({ response }) {
        errors.value = response._data.errors
      },
    })

    nfsResponse.value = response

    nfs.value = nfsResponse.value.nfs
    client.value = nfsResponse.value.client
    services.value = nfsResponse.value.services
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
  <h1>Detalhamento NFS do Cliente</h1>
  <VCard v-if="!loading">
    <div class="pa-6">
      <h3>Dados do Cliente</h3>
      <div class="border pa-3 mb-3">
        <VRow>
          <VCol
            cols="12"
            md="4"
          >
            <AppTextField
              label="Cliente"
              readonly
              :value="client.NOME"
            />
          </VCol>
          <VCol
            cols="12"
            md="4"
          >
            <AppTextField
              label="Nome Fantasia"
              readonly
              :value="client.NOME_FANTASIA"
            />
          </VCol>
          <VCol
            cols="12"
            md="4"
          >
            <AppTextField
              label="Inscrição Estadual"
              readonly
              :value="client.INSC_ESTADUAL"
            />
          </VCol>
          <VCol
            cols="12"
            md="4"
          >
            <AppTextField
              label="CPF / CNPJ"
              readonly
              :value="client.CPF_CNPJ"
            />
          </VCol>
          <VCol
            cols="12"
            md="2"
          >
            <AppTextField
              label="Local Atend."
              readonly
              :value="nfs.COD_LOCAL_ATENDIMENTO"
            />
          </VCol>
          <VCol
            cols="12"
            md="4"
          >
            <AppTextField
              label="Endereço"
              readonly
              :value="client.ENDERECO"
            />
          </VCol>
          <VCol
            cols="12"
            md="2"
          >
            <AppTextField
              label="Numero"
              readonly
              :value="client.NUMERO"
            />
          </VCol>
          <VCol
            cols="12"
            md="4"
          >
            <AppTextField
              label="Identi. Estrangeiro"
              readonly
              :value="client.INDENTIFICADOR_ESTRANGEIRO"
            />
          </VCol>
          <VCol
            cols="12"
            md="4"
          >
            <AppTextField
              label="Bairro"
              readonly
              :value="client.district ? client.district.BAIRRO : ''"
            />
          </VCol>
          <VCol
            cols="12"
            md="4"
          >
            <AppTextField
              label="Complemento"
              readonly
              :value="client.COMPLEMENTO"
            />
          </VCol>
          <VCol
            cols="12"
            md="4"
          >
            <AppTextField
              label="Cidade"
              readonly
              :value="client.city ? client.city.CIDADE : ''"
            />
          </VCol>
          <VCol
            cols="12"
            md="2"
          >
            <AppTextField
              label="Estado"
              readonly
              :value="client.state ? client.state.UF : ''"
            />
          </VCol>
          <VCol
            cols="12"
            md="4"
          >
            <AppTextField
              label="CEP"
              readonly
              :value="client.CEP"
            />
          </VCol>
          <VCol
            cols="12"
            md="2"
          >
            <AppTextField
              label="Prazo"
              readonly
              :value="nfs.PRAZO"
            />
          </VCol>
        </VRow>
      </div>
      <h3>Dados do serviço</h3>
      <div class="border pa-3 mb-3">
        <VCarousel
          class="fill-height"
          hide-delimiters
          :show-arrows="services.length > 1"
        >
          <VCarouselItem
            v-for="service in services"
            :key="service.CODIGO"
          >
            <VRow class="pa-3">
              <VCol
                cols="12"
                md="4"
              >
                <AppTextField
                  label="Tipo do Serviço"
                  readonly
                  :value="service.type ? service.type.TIPO_SERVICO_NFS : ''"
                />
              </VCol>
              <VCol
                cols="12"
                md="4"
              >
                <AppTextField
                  label="Aliquota"
                  readonly
                  :value="`${service.ALIQUOTA}%`"
                />
              </VCol>
              <VCol
                cols="12"
                md="4"
              >
                <AppTextField
                  label="Valor Tributação"
                  readonly
                  :value="`R$${service.VALOR_TRIBUTACAO}`"
                />
              </VCol>
              <VCol
                cols="12"
                md="4"
                class="d-flex flex-column justify-content-between"
              >
                <AppTextField
                  label="Valor Dedução"
                  readonly
                  :value="`R$${service.VALOR_DEDUCAO}`"
                />
                <AppTextField
                  label="Valor ISSRF"
                  readonly
                  :value="`R$${service.VALOR_ISSRF}`"
                />
              </VCol>
              <VCol
                cols="12"
                md="8"
              >
                <AppTextarea
                  label="Descrição do Serviço"
                  readonly
                  :model-value="service.DESCRICAO_SERVICO"
                />
              </VCol>
            </VRow>
          </VCarouselItem>
        </VCarousel>
      </div>
      <h3>Dados da nota</h3>
      <div class="border pa-3 mb-3">
        <VRow>
          <VCol
            cols="12"
            md="2"
          >
            <AppTextField
              label="Sub Total"
              readonly
              :value="`R$${nfs.SUB_TOTAL_ITENS}`"
            />
          </VCol>
          <VCol
            cols="12"
            md="2"
          >
            <AppTextField
              label="Desconto"
              readonly
              :value="`R$${nfs.VALOR_DESCONTO}`"
            />
          </VCol>
          <VCol
            cols="12"
            md="4"
          >
            <AppTextField
              label="Valor Total"
              readonly
              :value="`R$${nfs.VALOR_TOTAL}`"
            />
          </VCol>
          <VCol
            cols="12"
            md="4"
          >
            <AppTextField
              label="Usuário para Trans."
              readonly
              :value="`${nfs.USUARIO_TRANSMISSAO}`"
            />
          </VCol>
          <VCol
            cols="12"
            md="12"
          >
            <AppTextarea
              label="Observações"
              readonly
              auto-grow
              :model-value="`${nfs.OBSERVACOES.trim()}`"
            />
          </VCol>
        </VRow>
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
