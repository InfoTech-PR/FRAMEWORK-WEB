import { createRouter, createWebHistory } from 'vue-router';
import Login from '../pages/login.vue';
import Index from '../pages/index.vue';
import Home from '../pages/home.vue';
import Projetos from '../pages/projetos.vue';

const routes = [
    { path: '/', name: 'login', component: Login },
    { path: '/index', name: 'index', component: Index,
        children: [
            { path: '/home', name: 'home', component: Home },
            { path: '/projetos', name: 'projetos', component: Projetos },
        ]
    },

];

const router = createRouter({
  history: createWebHistory(),
  routes
});

export default router;
