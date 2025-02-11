<script>
import axios from 'axios';

export default {
  data() {
    return {
      tab: 0,
      form: {
        nomeProjeto: '',
        cliente: '',
        contatoEmpresa: '',
        status: '',
        analista: '',
        programador: '',
        observacoes: '',
        dataInicial: '',
        dataFinal: ''
      },
      clientes: [],
      status: ['Em andamento', 'Concluído', 'Pendente'],
      analistas: ['Analista 1', 'Analista 2', 'Analista 3'],
      programadores: ['Programador 1', 'Programador 2', 'Programador 3'],
      isLoading: false,
    };
  },
  created() {
    this.fetchClientes();
  },
  methods: {
    async fetchClientes() {
      this.isLoading = true;
      try {
        const response = await axios.get('/api/clientes');
        this.clientes = response.data.map(cliente => cliente.nome);
      } catch (error) {
        console.error("Erro ao buscar clientes:", error);
      } finally {
        this.isLoading = false;
      }
    },
    cancelar() {
      this.$refs.form.reset();
    },
    cadastrar() {
      this.isLoading = true;
      setTimeout(() => {
        this.isLoading = false;
        this.$refs.form.reset();
        alert('Cadastro realizado!');
      }, 2000);
    }
  }
}
</script>

<template>
  <v-container>
    <!-- Título -->
    <v-row>
      <v-col>
        <h1 class="mb-4">Projetos > Novo Projeto</h1>
      </v-col>
    </v-row>

    <!-- Aba de Cadastro e Arquivos -->
    <v-tabs v-model="tab" class="mb-4">
      <v-tab>Cadastro</v-tab>
      <v-tab>Arquivos</v-tab>
    </v-tabs>

    <v-tabs-items v-model="tab">
      <!-- Aba Cadastro -->
      <v-tab-item v-if="tab === 0">
        <v-form ref="form">
          <v-row>
            <v-col cols="6">
              <v-text-field label="Nome do Projeto" v-model="form.nomeProjeto"
                :rules="[v => !!v || 'Campo obrigatório']" required></v-text-field>
            </v-col>
            <v-col cols="6">
              <v-select v-if="clientes.length > 0" label="Cliente" v-model="form.cliente" :items="clientes"
                :loading="isLoading" item-text="nome" item-value="nome"
                :placeholder="isLoading ? 'Carregando...' : 'Selecione um cliente'">
              </v-select>
            </v-col>
          </v-row>

          <v-row>
            <v-col cols="6">
              <v-text-field label="Contato da Empresa" v-model="form.contatoEmpresa"></v-text-field>
            </v-col>
            <v-col cols="6">
              <v-select label="Status" v-model="form.status" :items="status"></v-select>
            </v-col>
          </v-row>

          <v-row>
            <v-col cols="6">
              <v-select label="Analista" v-model="form.analista" :items="analistas"></v-select>
            </v-col>
            <v-col cols="6">
              <v-select label="Programador" v-model="form.programador" :items="programadores"></v-select>
            </v-col>
          </v-row>

          <v-row>
            <v-col cols="12">
              <v-textarea label="Observações" v-model="form.observacoes"></v-textarea>
            </v-col>
          </v-row>

          <!-- Data -->
          <v-row>
            <v-col cols="6">
              <v-text-field label="Data Inicial" v-model="form.dataInicial" :rules="[v => !!v || 'Campo obrigatório']"
                mask="####-##-##" hint="Formato: YYYY-MM-DD" persistent-hint required></v-text-field>
            </v-col>

            <v-col cols="6">
              <v-text-field label="Data Final" v-model="form.dataFinal" mask="####-##-##" hint="Formato: YYYY-MM-DD"
                persistent-hint></v-text-field>
            </v-col>
          </v-row>

          <v-row>
            <v-col cols="6">
              <v-btn color="grey" block @click="cancelar">Cancelar</v-btn>
            </v-col>
            <v-col cols="6">
              <v-btn color="primary" block @click="cadastrar"
                :disabled="!form.nomeProjeto || !form.dataInicial || isLoading">
                <template v-if="isLoading">
                  <VProgressCircular indeterminate color="white" size="24" />
                </template>
                <template v-else>
                  Cadastrar
                </template>
              </V-btn>
            </v-col>
          </v-row>
        </v-form>
      </v-tab-item>

      <!-- Aba Arquivos -->
      <v-tab-item v-if="tab === 1">
        <v-card>
          <v-card-text>
            <p>Aba de arquivos em construção...</p>
          </v-card-text>
        </v-card>
      </v-tab-item>
    </v-tabs-items>
  </v-container>
</template>
