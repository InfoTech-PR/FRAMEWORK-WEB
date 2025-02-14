<!-- 
 
  1. DatePicker não funciona
  2. Confirmar antes de sair da tela não funciona
  3. 

-->

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
      status: ['Em Desenvolvimento', 'Fase Inicial', 'Estável, com necessidade de alterações', 'Estável, sem necessidade de alterações', 'Inutilizado', 'Abandonado', 'Cancelado'],
      analistas: [],
      programadores: [],
      isLoading: false,
      error: false,
      errorMessage: '',
    };
  },
  created() {
    this.fetchClientes();
    this.fetchFuncionarios();

    const today = new Date().toISOString().substr(0, 10);
    this.form.dataInicial = today;
  },
  methods: {
    async fetchClientes() {
      this.isLoading = true;
      try {
        const response = await axios.get('/api/clientes');
        this.clientes = response.data.map(cliente => cliente.NOME);
      } catch (error) {
        console.error("Erro ao buscar clientes:", error);
      } finally {
        this.isLoading = false;
      }
    },
    async fetchFuncionarios() {
      this.isLoading = true;
      try {
        const response = await axios.get('/api/funcionarios');
        this.programadores = response.data.map(programador => programador.NOME);
        this.analistas = response.data.map(analista => analista.NOME);
      } catch (error) {
        console.error("Erro ao buscar funcionarios:", error);
      } finally {
        this.isLoading = false;
      }
    },
    async cadastrar() {
      this.isLoading = true;
      try {
        // Mapear os campos para os nomes esperados pelo back-end
        const payload = {
          NOME_PROJETO: this.form.nomeProjeto,
          COD_CLIENTE: this.form.cliente,
          CONTATO_EMPRESA: this.form.contatoEmpresa,
          COD_STATUS_SOFTWARE: this.form.status,
          COD_ANALISTA_RESP: this.form.analista,
          COD_PROGRAMADOR_CHEFE: this.form.programador,
          OBSERVACOES: this.form.observacoes,
          DATA_INICIAL: this.form.dataInicial,
          DATA_FINAL: this.form.dataFinal,
        };

        console.log('Dados enviados:', payload);

        const response = await axios.post('/api/cadastrarProjeto', payload);

        if (response.data.projeto) {
          this.$refs.form.reset();
          this.error = true;
          this.errorMessage = 'Cadastro realizado com sucesso!';

          console.log('Projeto criado:', response.data.projeto);
        } else {
          this.error = true;
          this.errorMessage = 'Erro ao realizar cadastro!';
        }
      } catch (error) {
        this.error = true;
        this.errorMessage = 'Erro ao realizar cadastro! Detalhes: ' + error.message;
      } finally {
        this.isLoading = false;
      }
    },
    cancelar() {
      this.$refs.form.reset();
    },
    closeAndReset() {
      this.error = false;
    }
  },
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
                :loading="isLoading" item-text="nome" item-value="id"
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
              <v-select v-if="programadores.length > 0" label="Programador" v-model="form.programador"
                :items="programadores" :loading="isLoading" item-text="nome" item-value="id"
                :placeholder="isLoading ? 'Carregando...' : 'Selecione um Programador'">
              </v-select>
            </v-col>
            <v-col cols="6">
              <v-select v-if="analistas.length > 0" label="Analista" v-model="form.analista" :items="analistas"
                :loading="isLoading" item-text="nome" item-value="id"
                :placeholder="isLoading ? 'Carregando...' : 'Selecione um Analista'">
              </v-select>
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
              </v-btn>
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

  <!-- Modal de erros ou sucessos -->
  <v-dialog v-model="error" max-width="400px" @click:outside="closeAndReset">
    <template #default="{ close }">
      <v-card>
        <v-card-text class="text-center">
          <h4 class="mb-2">
            Opa, Houve um Problema!
          </h4>
          <p>{{ errorMessage }}</p>
          <v-btn color="primary" @click="closeAndReset">
            Fechar
          </v-btn>
        </v-card-text>
      </v-card>
    </template>
  </v-dialog>
</template>
