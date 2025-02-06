<script setup>
import { VForm } from 'vuetify/components/VForm'

const isPasswordVisible = ref(false)
const isLoading = ref(false)
const route = useRoute()
const router = useRouter()
const ability = useAbility()
const refVForm = ref()
const error = ref(false) 
const errorMessage = ref('') 
const modalOpen = ref(true)

definePage({
  meta: {
    layout: 'blank',
    unauthenticatedOnly: true,
  },
})

const credentials = ref({
  NOME: '',
  SENHA: '',
})

const login = async () => {
  isLoading.value = true
  try {
    const res = await $api('/auth/login', {
      method: 'POST',
      body: {
        NOME: credentials.value.NOME,
        SENHA: credentials.value.SENHA,
      },
    });

    if (res?.token && res?.userAbilityRules && res?.userData) {
      const userAbilityRules = res.userAbilityRules;
      const userData = res.userData;
      useCookie('accessToken').value = res.token;
      useCookie('userAbilityRules').value = userAbilityRules;
      useCookie('userData').value = userData;
      ability.update(userAbilityRules);

      await nextTick(() => {
        router.replace(route.query.to ? String(route.query.to) : '/');
      });
    } else {
      errorMessage.value = res?.message || 'Usuário ou senha inválidos!';
      error.value = true;
    }
  } catch (err) {
    if (err.response?.status === 401) {
      errorMessage.value = 'Usuário ou senha inválidos!';
    } else {
      errorMessage.value = err?.response?.data?.message || 'Erro desconhecido';
    }
    error.value = true;  
  } finally {
    isLoading.value = false 
  }
};

const onSubmit = () => {
  refVForm.value?.validate().then(({ valid: isValid }) => {
    if (isValid)
      login()
  })
}

const isFormValid = computed(() => {
  return credentials.value.NOME.trim() !== '' && credentials.value.SENHA.trim() !== ''
})

const closeAndReset = () => {
  credentials.value.NOME = '';
  credentials.value.SENHA = '';
  error.value = false; 
}
</script>

<template>
  <VRow no-gutters class="auth-wrapper bg-surface">
    <VCol md="8" class="d-none d-md-flex">
      <div class="position-relative bg-background w-100 me-0">
        <div class="d-flex align-center justify-center w-100 h-100" style="padding-inline: 6.25rem">
          <img src="@/assets/infotech500x500.png" alt="Logotipo LAP" class="auth-illustration mt-16 mb-2">
        </div>
      </div>
    </VCol>

    <VCol cols="12" md="4" class="auth-card-v2 d-flex align-center justify-center">
      <VCard flat :max-width="500" class="mt-12 mt-sm-0 pa-4">
        <VCardText>
          <h4 class="text-h4 mb-1">
            Bem-vindo ao Framework da InfoTech!
          </h4>
          <p class="mb-0">
            Faça o login para acessar a plataforma!
          </p>
        </VCardText>
        <VCardText>
          <VForm ref="refVForm" @submit.prevent="onSubmit">
            <VRow>
              <VCol cols="12">
                <AppTextField
                  v-model="credentials.NOME"
                  label="Usuário"
                  type="text"
                />
              </VCol>
              <VCol cols="12">
                <AppTextField
                  v-model="credentials.SENHA"
                  label="Senha"
                  :type="isPasswordVisible ? 'text' : 'password'"
                  :append-inner-icon="isPasswordVisible ? 'tabler-eye-off' : 'tabler-eye'"
                  @click:append-inner="isPasswordVisible = !isPasswordVisible"
                />
              </VCol>
              <VCol cols="12">
                <VBtn block type="submit" class="mt-5" :disabled="!isFormValid || isLoading">
                  <template v-if="isLoading">
                    <VProgressCircular indeterminate color="white" size="24" />
                  </template>
                  <template v-else>
                    Login
                  </template>
                </VBtn>
              </VCol>
            </VRow>
          </VForm>
        </VCardText>
      </VCard>
    </VCol>
  </VRow>

  <VDialog v-model="error" max-width="400px" @click:outside="closeAndReset">
    <template #default="{ close }">
      <VCard>
        <VCardText class="text-center">
          <h4 class="mb-2">
            Opa, Houve um Problema!
          </h4>
          <p>{{ errorMessage }}</p>
          <VBtn color="primary" @click="closeAndReset">
            Fechar
          </VBtn>
        </VCardText>
      </VCard>
    </template>
  </VDialog>
</template>

<style lang="scss">
@use "@core-scss/template/pages/page-auth"
</style>
