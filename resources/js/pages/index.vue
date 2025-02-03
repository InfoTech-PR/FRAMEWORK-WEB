<template>
  <div class="home">
    <TopNavigation/>
    <div class="main-layout">
        <router-view></router-view>
    </div>
    <Sidebar />
  </div>
</template>

<script>
import Sidebar from '../components/sidebar/Sidebar';
import TopNavigation from '../components/TopNavigation.vue';
import { defineComponent } from 'vue';

export default defineComponent({
  components: {
    Sidebar,
    TopNavigation,
  }
});
</script>

<style scoped>
/* inserir css futuramente */
</style>
