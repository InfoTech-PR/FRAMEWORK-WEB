<template>
  <div class="login-page d-flex flex-column min-vh-100 bg-light">
    <div class="row no-gutters">
      <div class="col-md-6 image-section">
        <img src="../../images/infotech.png" alt="Imagem da InfoTech" class="img-fluid w-100" />
      </div>

      <div class="col-md-6 form-section p-4 d-flex justify-content-center align-items-center">
        <div class="login-container w-100">
          <form @submit.prevent="submitLogin">
            <div class="form-group mb-4">
              <label for="name" class="text-light">Usuário</label>
              <input type="text" id="name" v-model="name" class="form-control" required placeholder="Digite seu usuário" />
            </div>

            <div class="form-group mb-4">
              <label for="password" class="text-light">Senha</label>
              <div class="input-group">
                <input v-if="showPassword" type="text" id="password" v-model="password" class="form-control" required placeholder="Digite sua senha" />
                <input v-else type="password" id="password" v-model="password" class="form-control" required placeholder="Digite sua senha" />
                <div class="input-group-append">
                  <button type="button" class="btn btn-outline-secondary" @click="toggleShowPassword">
                    <i :class="showPassword ? 'fas fa-eye-slash' : 'fas fa-eye'"></i>
                  </button>
                </div>
              </div>
            </div>

            <button type="submit" :disabled="!name || !password || isLoading" class="btn btn-primary w-100">
              <span v-if="isLoading" class="spinner-border spinner-border-sm" role="status" aria-hidden="true"></span>
              <span v-else>Login</span>
            </button>
          </form>

          <div v-if="error" class="error-modal mt-4">
            <div class="modal-content p-4 text-center">
              <p>{{ errorMessage }}</p>
              <button @click="closeErrorModal" class="btn btn-secondary">Fechar</button>
            </div>
          </div>
        </div>
      </div>
    </div>
  </div>
</template>

<script>
import axios from 'axios';

export default {
  data() {
    return {
      name: "",
      password: "",
      showPassword: false,
      isLoading: false,
      error: false,
      errorMessage: "",
    };
  },
  methods: {
    toggleShowPassword() {
      this.showPassword = !this.showPassword;
    },
    async submitLogin() {
        this.isLoading = true;
        try {
            const response = await axios.post("http://127.0.0.1:8000/api/login", {
                NOME: this.name,
                SENHA: this.password,
            });

            if (response.status === 200) {
                const token = response.data.token;
                localStorage.setItem('token', token);
                this.$router.push('/home');
            }
        } catch (error) {
            this.isLoading = false;

            if (error.response) {
                if (error.response.status === 401) {
                    this.errorMessage = "Credenciais inválidas! Por favor, tente novamente.";
                } else {
                    this.errorMessage = error.response.data.message || "Erro no servidor!";
                }
            } else {
                this.errorMessage = "Erro de rede. Verifique sua conexão.";
            }

            this.error = true;
        }
    }
,
    closeErrorModal() {
      this.error = false;
      this.errorMessage = "";
    },
  },
};
</script>

<style scoped>
.login-page {
  display: flex;
  flex-direction: column;
  min-height: 100vh;
}

.image-section img {
  width: 100%;
  height: 100%;
  object-fit: cover;
}

.form-section {
  display: flex;
  justify-content: center;
  background-color: rgb(71, 99, 108);
  align-items: center;
}

.login-container {
  max-width: 400px;
  width: 100%;
}

.error-modal {
  position: fixed;
  top: 50%;
  left: 50%;
  transform: translate(-50%, -50%);
  background-color: rgba(0, 0, 0, 0.8);
  color: white;
  border-radius: 8px;
  padding: 15px;
  z-index: 1050;
  max-width: 80%;
  width: 400px;
}

button.btn {
  font-size: 16px;
}

.form-group {
  margin-bottom: 20px;
}

.input-group-append button {
  background-color: white;
  cursor: pointer;
  border: 1px solid #d9dde1;
  border-left: none;
  border-top-left-radius: 0;
  border-bottom-left-radius: 0;
}
</style>
