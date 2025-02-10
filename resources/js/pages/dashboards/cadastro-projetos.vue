<!--

  1. Problemas com o botão desabilitado com campos vazios
  2. 

-->

<script>
export default {
  data() {
    return {
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
      clientes: ['Empresa A', 'Empresa B', 'Empresa C'],
      status: ['Em andamento', 'Concluído', 'Pendente'],
      analistas: ['Analista 1', 'Analista 2', 'Analista 3'],
      programadores: ['Programador 1', 'Programador 2', 'Programador 3'],
      isLoading: false,
      isFormValid: false,
      formModified: false,
      showModal: false,
    };
  },
  watch: {
    form: {
      handler() {
        this.formModified = true;
        this.validateForm();
      },
      deep: true
    }
  },
  methods: {
    validateForm() {
      this.isFormValid = this.form.nomeProjeto !== '' && this.form.dataInicial !== '';
    },
    cancelar() {
      this.$refs.form.reset();
      this.isFormValid = false;
      this.formModified = false;
    },
    cadastrar() {
      this.isLoading = true;
      setTimeout(() => {
        this.isLoading = false;
        this.$refs.form.reset();
        this.isFormValid = false;
        this.formModified = false;
        alert('Cadastro realizado!');
      }, 2000);
    },
    onTabChange() {
      if (this.formModified) {
        console.log("foi")
        this.showModal = true;
      }
    },
    closeModal() {
      this.showModal = false;
    },
    confirmExit() {
      this.formModified = false;
      this.showModal = false;
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
              <v-select label="Cliente" v-model="form.cliente" :items="clientes"></v-select>
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
              <v-btn color="primary" block @click="cadastrar" :disabled="!isFormValid || isLoading">
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

    <!-- Modal de Alerta -->
    <v-dialog v-model="showModal" max-width="500px">
      <v-card>
        <v-card-title>
          <span class="headline">Atenção</span>
        </v-card-title>
        <v-card-text>
          Você deve Gravar ou Cancelar as edições efetuadas antes de sair!
        </v-card-text>
        <v-card-actions>
          <v-btn color="red" text @click="closeModal">Fechar</v-btn>
          <v-btn color="green" text @click="confirmExit">Sair sem salvar</v-btn>
        </v-card-actions>
      </v-card>
    </v-dialog>
  </v-container>
</template>
