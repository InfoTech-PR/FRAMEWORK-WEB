const emailRouteComponent = () => import('@/pages/apps/email/index.vue')

export const redirects = [
  {
    path: '/',
    name: 'index',
    redirect: to => {
      const userData = useCookie('userData')
      if (userData)
        return { name: 'dashboards' }

      return { name: 'login', query: to.query }
    },
  },
]
export const routes = [
  {
    path: '/dashboards',
    name: 'dashboards',
    component: () => import('@/pages/dashboards/dashboard.vue'),
  },
  // {
  //   path: '/dashboards/cliente-os/:id',
  //   name: 'cliente-os',
  //   component: () => import('@/pages/dashboards/cliente-os.vue'),
  // },
  {
    path: '/dashboards/cadastro-projetos',
    name: 'cadastro-projetos',
    component: () => import('@/pages/dashboards/cadastro-projetos.vue'),
  },
]
