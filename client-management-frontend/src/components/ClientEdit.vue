<template>
  <div class="edit-container">
    <div class="card animate-fade-in">
      <h2 class="animated-title">
        <span v-for="(char, index) in titleText" :key="index" :style="{ animationDelay: (index * 0.05) + 's' }">
          {{ char }}
        </span>
      </h2>
      <form @submit.prevent="updateClient">
        <div class="form-group">
          <label>Имя</label>
          <input v-model="client.name" type="text" required />
        </div>
        <div class="form-group">
          <label>Email</label>
          <input v-model="client.email" type="email" required />
        </div>
        <div class="form-group">
          <label>Телефон</label>
          <input v-model="client.phone" type="text" />
        </div>
        <button type="submit">Сохранить</button>
      </form>
    </div>
  </div>
</template>

<script>
import axios from 'axios';

export default {
  name: 'ClientEdit',
  data() {
    return {
      client: {
        name: '',
        email: '',
        phone: ''
      },
      titleText: 'Редактировать клиента'.split('').map(c => c === ' ' ? '\u00A0' : c),
      errorMessage: ''
    };
  },
  mounted() {
    this.loadClient();
  },
  methods: {
    async loadClient() {
      const id = this.$route.params.id;
      try {
        const response = await axios.get(`http://localhost:8000/api/clients/${id}`);
        this.client = response.data;
      } catch (error) {
        this.errorMessage = 'Ошибка при загрузке клиента';
      }
    },
    async updateClient() {
      const id = this.$route.params.id;
      try {
        await axios.put(`http://localhost:8000/api/clients/${id}`, this.client);
        this.$router.push('/clients');
      } catch (error) {
        this.errorMessage = 'Ошибка при обновлении клиента';
      }
    }
  }
};
</script>

<style scoped>
.edit-container {
  display: flex;
  justify-content: center;
  align-items: center;
  padding: 60px 20px;
  background-color: #f3f4f6;
  min-height: 100vh;
}

.card {
  background: white;
  padding: 40px;
  border-radius: 20px;
  box-shadow: 0 25px 40px rgba(0, 0, 0, 0.05), 0 8px 20px rgba(0, 0, 0, 0.03);
  width: 100%;
  max-width: 480px;
  transition: all 0.3s ease;
}

.card:hover {
  transform: translateY(-3px);
  box-shadow: 0 35px 60px rgba(0, 0, 0, 0.07);
}

.animate-fade-in {
  opacity: 0;
  transform: translateY(30px);
  animation: fadeInUp 0.6s ease-out forwards;
}

@keyframes fadeInUp {
  to {
    opacity: 1;
    transform: translateY(0);
  }
}

/* 🔤 Анимация заголовка */
.animated-title {
  display: flex;
  justify-content: center;
  flex-wrap: wrap;
  font-size: 26px;
  font-weight: 800;
  margin-bottom: 30px;
  color: #111827;
}

.animated-title span {
  display: inline-block;
  animation: bounce 1.2s ease-in-out infinite;
  white-space: pre; /* строка, чтобы сохранить пробелы */
}

@keyframes bounce {
  0%, 100% {
    transform: translateY(0px);
  }
  50% {
    transform: translateY(-8px);
  }
}

.form-group {
  margin-bottom: 22px;
}

label {
  display: block;
  margin-bottom: 8px;
  font-weight: 600;
  color: #374151;
}

input {
  width: 100%;
  max-width: 320px;
  margin: 0 auto;
  display: block;
  padding: 10px 14px;
  border: 1px solid #d1d5db;
  border-radius: 10px;
  font-size: 15px;
  transition: border-color 0.3s ease, box-shadow 0.3s ease;
}

input:focus {
  border-color: #10b981;
  outline: none;
  box-shadow: 0 0 0 3px rgba(16, 185, 129, 0.2);
}

button {
  width: 100%;
  padding: 14px;
  background: linear-gradient(135deg, #10b981, #059669);
  color: white;
  font-weight: 600;
  border: none;
  border-radius: 10px;
  font-size: 16px;
  cursor: pointer;
  transition: background 0.3s ease, transform 0.2s ease;
}

button:hover {
  background: linear-gradient(135deg, #059669, #047857);
  transform: scale(1.02);
}

button:active {
  transform: scale(0.97);
}
</style>
