<template>
  <div class="navigation">
    <ul>
      <li>
        <a href="#" @click.prevent="toggleProjetos">Projetos</a>
        <ul v-if="isProjetosExpanded">
          <li><router-link to="/cadastro">Cadastro</router-link></li>
          <li><router-link to="/consulta">Consulta</router-link></li>
        </ul>
        <a href="#" @click.prevent="toggleVersoes">Controle de Versões / Correções</a>
        <ul v-if="isVersoesExpanded">
          <li><router-link to="#">Alterações Pendentes</router-link></li>
          <li><router-link to="#">Aguardando Testes</router-link></li>
          <li><router-link to="#">Alterações Concluídas</router-link></li>
          <li><router-link to="#">Minhas Pendencias</router-link></li>
        </ul>
      </li>
    </ul>
  </div>
</template>


<script>
export default {
  name: 'Navigation',
  data() {
    return {
      isProjetosExpanded: false,
      isVersoesExpanded: false,
    };
  },
  methods: {
    toggleProjetos() {
      this.isProjetosExpanded = !this.isProjetosExpanded;
      },
    toggleVersoes() {
      this.isVersoesExpanded = !this.isVersoesExpanded;
    },
  },
};
</script>

<style scoped>
.navigation {
  background-color: #333;
  padding: 15px;
  width: 250px;
  height: 100vh;
  position: fixed;
  top: 0;
  left: 0;
}

.navigation ul {
  list-style: none;
  padding: 0;
  margin: 0;
}

.navigation ul li {
  margin: 20px 0;
}

.navigation ul li a {
  color: white;
  text-decoration: none;
  font-size: 18px;
  display: block;
}

.navigation ul li a:hover {
  background-color: #575757;
  padding-left: 10px;
}

.navigation ul li ul {
  margin-left: 20px;
}

.navigation ul li ul li {
  margin: 10px 0;
}

.navigation ul li ul li a {
  font-size: 16px;
  color: white;
}

.navigation ul li ul li a:hover {
  background-color: #666;
}
</style>
