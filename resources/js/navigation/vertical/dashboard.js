export default [
  {
    title: 'Projetos',
    icon: { icon: 'tabler-device-laptop' },
    children: [
      {
        title: 'Cadastro',
        icon: { icon: 'tabler-copy-plus' },
        to: 'dashboards-cadastro-projetos',
      },
      {
        title: 'Consulta',
        icon: { icon: 'tabler-search' },
        to: 'dashboards-consulta-projetos',
      },
    ],
  },
  {
    title: 'Controle de Versões / Correções',
    icon: { icon: 'tabler-shield-check' },
    to: 'dashboards'
  },
]
