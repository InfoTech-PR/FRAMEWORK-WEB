<script>
import axios from 'axios';

export default {
  name: 'TopNavigation',
  data() {
    return {
      user: {
        name: '',
        photoUrl: '',
        email: '',
      },
    };
  },
  created() {
    this.getUserInfo();
  },
  methods: {
    async getUserInfo() {
      try {
        const token = localStorage.getItem('token');
        if (token) {
          const response = await axios.get('http://127.0.0.1:8000/api/user', {
            headers: {
              Authorization: `Bearer ${token}`,
            },
          });

            if (response.data.data) {
            console.log(response.data.data)
            this.user.name = response.data.data.NOME || 'Visitante';
            this.user.email = response.data.data.EMAIL || 'sem-email@exemplo.com';
            this.user.photoUrl = response.data.data.FOTO || '';
          } else {
            this.user.name = 'Visitante';
            this.user.email = 'sem-email@exemplo.com';
            this.user.email = '';
          }
        }
      } catch (error) {
        console.error('Erro ao buscar dados do usuário:', error);
      }
    },
    editProfile() {
      alert('Aqui você pode editar o perfil.');
    },
    logout() {
      localStorage.removeItem('token');
      this.$router.push('/');
    },
  },
};
</script>

<template>
  <nav class="navbar navbar-expand-lg navbar-light bg-light">
    <div class="container-fluid">
      <ul class="navbar-nav ml-auto">
        <li class="nav-item dropdown">
            <a class="nav-link dropdown-toggle" id="navbarDropdownProfile" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                <img v-if="user.photoUrl" :src="user.photoUrl" alt="Foto do usuário" class="user-avatar" />
                <i v-else class="fas fa-user"></i>
            </a>
          <div class="dropdown-menu" aria-labelledby="navbarDropdownProfile">
            <h6 class="dropdown-header" id="userName">{{ user.name }}</h6>
            <small id="userEmail">{{ user.email }}</small>
            <div class="dropdown-divider"></div>
            <a class="btn-edit" href="#" id="editProfile" @click="editProfile">Editar Perfil</a>
            <a class="btn-exit" href="#" id="logout" @click="logout">Sair</a>
          </div>
        </li>
      </ul>
    </div>
  </nav>
</template>

<style scoped>
.navbar-nav {
  display: flex;
  justify-content: flex-end;
  width: 100%;
  background-color: #f1f1f1;
  border-radius: 10px;
  box-shadow: 0 4px 8px rgba(0, 0, 0, 0.1);
  padding: 5px 20px;
  transition: background-color 0.3s ease-in-out;
}

.navbar-nav .nav-item .nav-link {
  font-size: 16px;
  padding: 10px 15px;
  color: #333;
  transition: color 0.3s ease;
}

.navbar-nav .nav-item .nav-link:hover {
  color: #2f7285;
}

.user-avatar {
  width: 40px;
  height: 40px;
  border-radius: 50%;
  object-fit: cover;
  margin-right: 10px;
}

.dropdown-menu {
    padding: 15px 20px;
    right: 0 !important;
    left: auto !important;
    margin-right: -10px;
}

#userEmail {
    font-size: 12px;
    display: flex;
    justify-content: center;
    align-items: center;
    height: 100%;
}
.btn-edit, .btn-exit {
  display: block;
  width: 100%;
  padding: 8px 0;
  text-align: center;
  font-size: 14px;
  border: none;
  border-radius: 5px;
  margin: 5px 0;
  transition: background-color 0.3s ease;
  cursor: pointer;
  text-decoration: none;
}

.btn-edit {
  background-color: #2f7285;
  color: white;
}

.btn-edit:hover {
  background-color: #1e4f56;
}

.btn-exit {
  background-color: #e74c3c;
  color: white;
}

.btn-exit:hover {
  background-color: #c0392b;
}
</style>
