    import { createRouter, createWebHistory } from 'vue-router';
    import Login from '../pages/login.vue';
    import Index from '../pages/index.vue';
    import Home from '../pages/home.vue';
    import Projetos from '../pages/projetos.vue';
    import axios from 'axios';

    const routes = [
    { path: '/', name: 'login', component: Login, meta: { requiresGuest: true } },
    {
        path: '/index',
        name: 'index',
        component: Index,
        children: [
        { path: '/home', name: 'home', component: Home, meta: { requiresAuth: true } },
        { path: '/projetos', name: 'projetos', component: Projetos, meta: { requiresAuth: true } },
        ]
    },
    ];

    const router = createRouter({
    history: createWebHistory(),
    routes
    });

    router.beforeEach((to, from, next) => {
    const token = localStorage.getItem('token');

    if (to.matched.some(record => record.meta.requiresGuest)) {
        if (token) {
        next('/home');  
        } else {
        next();
        }
    }
    else if (to.matched.some(record => record.meta.requiresAuth)) {
        if (token) {
        axios.get('http://127.0.0.1:8000/api/user', {
            headers: { 'Authorization': `Bearer ${token}` }
        })
            .then(response => {
            next();
            })
            .catch(error => {
            localStorage.removeItem('token');
            next('/');
            });
        } else {
        next('/');
        }
    } else {
        next();
    }
    });

    export default router;
