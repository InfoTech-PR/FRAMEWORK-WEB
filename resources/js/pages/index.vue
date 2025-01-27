<template>
  <div class="home">
    <TopNavigation />
    <div class="main-layout">
      <Sidebar />
      <div class="content" :style="{ 'margin-left': sidebarWidth }">
        <router-view></router-view>
      </div>
    </div>
  </div>
</template>

<script>
import Sidebar from '../components/sidebar/Sidebar';
import TopNavigation from '../components/TopNavigation.vue';
import { sidebarWidth } from '../components/sidebar/state';
import { defineComponent } from 'vue';

export default defineComponent({
  name: 'Home',
  components: {
    Sidebar,
    TopNavigation,
  },
  setup() {
    return { sidebarWidth };
  },
});
</script>

<style scoped>
.home {
  display: flex;
  flex-direction: column;
  height: 100vh;
}

.main-layout {
  display: flex;
  flex: 1;
  margin-top: 60px;
}

.content {
  flex: 1;
  padding: 20px;
  overflow-y: auto;
  margin-left: 280px;
  margin-top: 60px;
  transition: margin-left 0.3s ease;
}
</style>
