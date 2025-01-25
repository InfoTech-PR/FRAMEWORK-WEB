<template>
  <div class="top-navigation">
    <div class="user-info">
      <img :src="user.photoUrl" alt="User Photo" class="user-photo" />
      <span class="user-name">{{ user.name }}</span>
    </div>
    <button @click="logout" class="logout-button">Sair</button>
  </div>
</template>

<script>
import axios from 'axios';

export default {
    name: 'TopNavigation',
    data() {
    return {
      user: {
        name: '',
        photoUrl: '',
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

          this.user.name = response.data.data.NOME || 'Visitante';
          this.user.photoUrl = response.data.data.FOTO || 'https://cdn-icons-png.flaticon.com/512/3177/3177440.png';
        }
      } catch (error) {
        console.error('Erro ao buscar dados do usuário:', error);
      }
    },
    logout() {
      localStorage.removeItem('token');
      this.$router.push('/');
    },
  },
};
</script>

<style scoped>
.top-navigation {
  display: flex;
  justify-content: flex-end;
  gap: 10px;
  align-items: center;
  background-color: #463c3c;
  color: white;
  padding: 15px;
  position: fixed;
  top: 0;
  left: 280px;
  right: 0;
  z-index: 1000;
}

.user-info {
  display: flex;
  align-items: center;
}

.user-photo {
  width: 40px;
  height: 40px;
  border-radius: 50%;
  margin-right: 10px;
}

.user-name {
  font-size: 16px;
}

.logout-button {
  background-color: #f44336;
  color: white;
  border: none;
  padding: 8px 16px;
  cursor: pointer;
  border-radius: 4px;
}

.logout-button:hover {
  background-color: #d32f2f;
}
</style>
