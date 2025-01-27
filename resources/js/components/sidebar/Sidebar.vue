<script>
import SidebarLink from './SidebarLink'
import { collapsed, toggleSidebar } from './state'

export default {
  props: {},
  components: { SidebarLink },
  setup() {
    return { collapsed, toggleSidebar }
  }
}
</script>

<template>
  <div class="sidebar" :style="{ width: collapsed ? '70px' : '280px' }">
    <h1>
        <img class="img-icon" v-if="collapsed" src="../../../images/icon.png" alt="Logo" />
        <img class="img-logo" v-else src="../../../images/logo_infotech.png" alt="Logo" />
    </h1>

    <SidebarLink to="/home" icon="fas fa-home">Home</SidebarLink>
    <SidebarLink to="/projetos" icon="fas fa-columns">Projetos</SidebarLink>
    <SidebarLink to="#" icon="fas fa-chart-bar">Controle de Versões / Correções</SidebarLink>

    <span
      class="collapse-icon"
      :class="{ 'rotate-180': collapsed }"
      @click="toggleSidebar"
    >
      <i class="fas fa-angle-double-left" />
    </span>
  </div>
</template>

<style>
:root {
  --sidebar-bg-color: #2f7285;
  --sidebar-item-hover: #4d8ea0;
  --sidebar-item-active: #215867;
}
</style>

<style scoped>
.sidebar {
  color: white;
  background-color: var(--sidebar-bg-color);

  float: left;
  position: fixed;
  z-index: 1;
  top: 0;
  left: 0;
  bottom: 0;
  padding: 0.5em;

  transition: 0.3s ease;

  display: flex;
  flex-direction: column;
}

.sidebar h1 {
  display: flex;
  justify-content: center;
  align-items: center;
  height: 2.5em;
}

.collapse-icon {
  position: absolute;
  bottom: 0;
  padding: 0.75em;

  color: rgba(255, 255, 255, 0.7);

  transition: 0.2s linear;
}

.rotate-180 {
  transform: rotate(180deg);
  transition: 0.2s linear;
}

.img-logo{
    height: 100px;
    width: auto;
}

.img-icon {
  height: 20px;
  width: auto;
  animation: rotate 2s linear infinite;
}

@keyframes rotate {
  0% {
    transform: rotate(0deg);
  }
  100% {
    transform: rotate(360deg);
  }
}

</style>
