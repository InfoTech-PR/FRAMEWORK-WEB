<script setup>
import { PerfectScrollbar } from 'vue3-perfect-scrollbar'

const router = useRouter()
const ability = useAbility()
const userData = useCookie('userData')

const logout = async () => {
  useCookie('accessToken').value = null
  useCookie('userAbilityRules').value = null
  userData.value = null
  ability.update([])
  await router.push('/login')
}
</script>

<template>
  <h4 class="mx-2">
    {{ userData.nome || 'Usuario' }}
  </h4>

  <VAvatar
    size="38"
    class="cursor-pointer"
    :color="!(userData && userData.avatar) ? 'primary' : undefined"
    :variant="!(userData && userData.avatar) ? 'tonal' : undefined"
  >
    <template v-if="userData && userData.avatar">
      <img
        :src="userData.avatar"
        alt="User Avatar"
        class="avatar-image"
      />
    </template>
    <template v-else>
      <VIcon icon="tabler-user" />
    </template>

    <VMenu
      activator="parent"
      width="240"
      location="bottom end"
      offset="12px"
    >
      <VList>
        <VListItem>
          <div class="d-flex gap-2 align-center">
            <div class="email-container">
              <h6 class="text-h6 font-weight-medium">
                {{ userData?.email || 'Email não disponível' }}
              </h6>
            </div>
          </div>
        </VListItem>

        <PerfectScrollbar :options="{ wheelPropagation: false }">
          <div class="px-4 py-2">
            <VBtn
              block
              size="small"
              color="error"
              append-icon="tabler-logout"
              @click="logout"
            >
              Sair
            </VBtn>
          </div>
        </PerfectScrollbar>
      </VList>
    </VMenu>
  </VAvatar>
</template>

<style scoped>
.avatar-image {
  width: 100%;
  height: 100%;
  object-fit: cover; /* Garante que a imagem ocupe todo o espaço sem distorcer */
  border-radius: 50%; /* Mantém o formato circular */
}

.email-container h6 {
  white-space: nowrap; /* Evita que o email seja quebrado em várias linhas */
  overflow: hidden; /* Esconde qualquer parte do texto que ultrapasse o limite */
  text-overflow: ellipsis; /* Exibe "..." se o texto for muito longo */
  max-width: 150px; /* Limita a largura do email para evitar que ocupe muito espaço */
}
</style>
