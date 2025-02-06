<script setup>
import { PerfectScrollbar } from 'vue3-perfect-scrollbar'

const router = useRouter()
const ability = useAbility()

// TODO: Get type from backend
const userData = useCookie('userData')

const logout = async () => {

  // Remove "accessToken" from cookie
  useCookie('accessToken').value = null

  // Remove "userData" from cookie
  userData.value = null

  // Redirect to login page
  await router.push('/login')

  // ℹ️ We had to remove abilities in then block because if we don't nav menu items mutation is visible while redirecting user to login page

  // Remove "userAbilities" from cookie
  useCookie('userAbilityRules').value = null

  // Reset ability to initial ability
  ability.update([])
}
</script>

<template>
  <h4 class="mx-2">
    {{ userData }}
  </h4>
  <VAvatar
    size="38"
    class="cursor-pointer"
    :color="!(userData && userData.avatar) ? 'primary' : undefined"
    :variant="!(userData && userData.avatar) ? 'tonal' : undefined"
  >
    <VIcon icon="tabler-user" />

    <!-- SECTION Menu -->
    <VMenu
      activator="parent"
      width="240"
      location="bottom end"
      offset="12px"
    >
      <VList>
        <VListItem>
          <div class="d-flex gap-2 align-center">
            <VListItemAction>
              <VAvatar
                :color="!(userData && userData.avatar) ? 'primary' : undefined"
                :variant="!(userData && userData.avatar) ? 'tonal' : undefined"
              >
                <VIcon icon="tabler-user" />
              </VAvatar>
            </VListItemAction>

            <div>
              <h6 class="text-h6 font-weight-medium">
                {{ userData }}
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
    <!-- !SECTION -->
  </VAvatar>
</template>
