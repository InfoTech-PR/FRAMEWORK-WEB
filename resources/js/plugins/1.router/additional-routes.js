const emailRouteComponent = () => import('@/pages/apps/email/index.vue')

// 👉 Redirects
export const redirects = [
  // ℹ️ We are redirecting to different pages based on role.
  // NOTE: Role is just for UI purposes. ACL is based on abilities.
  {
    path: '/',
    name: 'index',
    redirect: to => {
      // TODO: Get type from backend
      const userData = useCookie('userData')
      if (userData)
        return { name: 'dashboards' }
      
      return { name: 'login', query: to.query }
    },
  },
]
export const routes = [
  {
    path: '/dashboards/os-clientes',
    name: 'dashboards-os-clientes',
    component: () => import('@/pages/dashboards/os-clientes.vue'),
  },
  {
    path: '/dashboards',
    name: 'dashboards',
    component: () => import('@/pages/dashboards/dashboard.vue'),
  },
  {
    path: '/dashboards/cliente-os/:id',
    name: 'cliente-os',
    component: () => import('@/pages/dashboards/cliente-os.vue'),
  },
  {
    path: '/dashboards/ordem-servico/:id',
    name: 'ordem-servico',
    component: () => import('@/pages/dashboards/ordem-servico.vue'),
  },

  //Notas fiscais

  {
    path: '/dashboards/nfs-clientes/',
    name: 'dashboards-nfs-clientes',
    component: () => import('@/pages/dashboards/nfs-clientes.vue'),
  },
  {
    path: '/dashboards/cliente-nfs/:id',
    name: 'cliente-nfs',
    component: () => import('@/pages/dashboards/cliente-nfs.vue'),
  },
  {
    path: '/nota-fiscal-servico/:id',
    name: 'nota-fiscal-servico',
    component: () => import('@/pages/dashboards/nota-fiscal-servico.vue'),
  },

  //Faturamento

  {
    path: '/dashboards/faturamento-geral/',
    name: 'dashboards-faturamento-geral',
    component: () => import('@/pages/dashboards/faturamento-geral.vue'),
  },
  
]
