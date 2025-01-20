<template>
  <div class="login-page">
    <div class="container">
      <!-- Imagem à esquerda -->
      <div class="image-section">
        <img src="https://scontent.fcwb6-1.fna.fbcdn.net/v/t39.30808-6/317731148_693806412127573_2090145287509864909_n.jpg?_nc_cat=109&ccb=1-7&_nc_sid=6ee11a&_nc_ohc=6KMN4V0wdxYQ7kNvgHRT_YT&_nc_oc=AdhWVq5cYHXJ4OKRJoSVFiPGZYA_c5yDFC5RrynhfIvG6hM6K1U-tjHuXbjmjWeB55iEIveHqhUzeTAJ-sVzmDd6&_nc_zt=23&_nc_ht=scontent.fcwb6-1.fna&_nc_gid=AfNsX8cpJYBdtFMmysrylC_&oh=00_AYCcDK683OuEWVbgT5taetLUaK8GD7wjuATby3o378t3rg&oe=678C68DD" alt="Imagem da InfoTech" />
      </div>

      <!-- Formulário de Login à direita -->
      <div class="form-section">
        <div class="login-container">
          <form @submit.prevent="submitLogin">
            <div class="form-group">
              <label for="name">Usuário</label>
              <input type="text" id="name" v-model="name" class="form-control-name" required placeholder="Digite seu usuário" />
            </div>

            <!-- Campo de senha com a opção de mostrar/esconder -->
            <div class="form-group">
              <label for="password">Senha</label>
              <div class="field has-addons">
                <div class="control is-expanded">
                  <input v-if="showPassword" type="text" id="password" v-model="password" class="form-control-password" required placeholder="Digite sua senha" />
                  <input v-else type="password" id="password" v-model="password" class="form-control-password" required placeholder="Digite sua senha" />
                </div>
                <div class="control">
                  <button type="button" class="button is-light" @click="toggleShowPassword">
                    <span class="icon is-small">
                      <span>{{ showPassword ? '⥈' : '👁' }}</span>
                    </span>
                  </button>
                </div>
              </div>
            </div>

            <!-- Botão de login com spinner -->
            <button type="submit" :disabled="!name || !password || isLoading" class="btn btn-primary">
              <span v-if="isLoading" class="spinner-border spinner-border-sm" role="status" aria-hidden="true">Carregando...</span>
              <span v-else>Login</span>
            </button>
          </form>

          <div v-if="error" class="error-modal">
            <div class="modal-content">
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
          name: this.name,
          password: this.password,
        });

        if (response.status === 200) {
            this.$router.push(response.data.redirect);
            /*const token = response.data.token;
            localStorage.setItem('token', token);*/
        }
      } catch (error) {
        if (error.response) {
          if (error.response.status === 500) {
            this.errorMessage =
              error.response.data.message || "Erro no servidor. Tente novamente mais tarde.";
          } else {
            this.errorMessage = error.response.data.message || "Erro ao tentar autenticar";
          }
        } else {
          this.errorMessage = "Erro de rede. Verifique sua conexão com a internet.";
        }
        this.error = true;
      } finally {
        this.isLoading = false;
      }
    },
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
  justify-content: center;
  align-items: center;
  height: 100vh;
  background-color: #f4f4f9;
  font-family: Arial, sans-serif;
}

.container {
  display: flex;
  align-items: center;
  justify-content: center;
  width: 90%;
  max-width: 1200px;
  height: 80%;
  background-color: white;
  border-radius: 8px;
  box-shadow: 0 4px 8px rgba(0, 0, 0, 0.1);
  overflow: hidden;
}

.image-section {
  width: 50%;
  height: 100%;
}

.image-section img {
  width: 100%;
  height: 100%;
  object-fit: cover;
}

.form-section {
  width: 50%;
  padding: 20px;
}

.login-container {
  max-width: 400px;
  margin: 0 auto;
  width: 100%;
}

.form-group {
  margin-bottom: 20px;
}

input.form-control-name {
  width: 100%;
  padding: 12px;
  font-size: 16px;
  border: 1px solid #ccc;
  border-radius: 8px;
  background-color: #f9f9f9;
  box-sizing: border-box;
  margin: 0;
}

input.form-control-password {
  width: 100%;
  padding: 12px;
  font-size: 16px;
  border: 1px solid #ccc;
  border-radius: 8px;
  border-top-right-radius: 0;
  border-bottom-right-radius: 0;
  border-right: none;
  background-color: #f9f9f9;
  box-sizing: border-box;
  margin: 0;
}

button.btn {
  width: 100%;
  padding: 14px;
  font-size: 16px;
  background-color: #3498db;
  color: white;
  border: none;
  border-radius: 8px;
  cursor: pointer;
  box-sizing: border-box;
}

button.btn:hover {
  background-color: #2980b9;
}

button.btn:disabled {
  opacity: 0.6;
  cursor: not-allowed;
}

button.is-light {
    cursor: pointer;
  background-color: #d8d8d8;
  border: 1px solid #ccc;
  border-radius: 8px;
  border-top-left-radius: 0;
  border-bottom-left-radius: 0;
  border-left: none;
  padding: 12.5px;
}

.field.has-addons {
  display: flex;
  align-items: center;
}

.field.has-addons .control.is-expanded {
  flex: 1;
}

.error-modal {
  position: fixed;
  top: 50%;
  left: 50%;
  transform: translate(-50%, -50%);
  background-color: rgba(0, 0, 0, 0.7);
  color: white;
  padding: 20px;
  border-radius: 8px;
  width: 80%;
  max-width: 400px;
  text-align: center;
}

.modal-content button {
  background-color: #e74c3c;
  padding: 10px 20px;
  border: none;
  border-radius: 5px;
  color: white;
  font-size: 16px;
  cursor: pointer;
}
</style>
