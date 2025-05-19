<template>
  <div>
    <h1>Clients List</h1>
    <button @click="$router.push('/clients/create')" style="margin-bottom: 20px;">
      Создать клиента
    </button>
    <ul>
      <li v-for="client in clients" :key="client.id">
        {{ client.name }} - {{ client.email }}
        <!-- Добавить кнопки для редактирования и удаления -->
        <button @click="editClient(client.id)">Edit</button>
        <button @click="deleteClient(client.id)">Delete</button>
      </li>
    </ul>

    <!-- Ошибка при запросе -->
    <div v-if="errorMessage" style="color: red;">
      {{ errorMessage }}
    </div>
  </div>
</template>

<script>
// Импортируем axios для запросов к API
import axios from 'axios';

export default {
  name: 'ClientsList',
  data() {
    return {
      clients: [],        // Массив для хранения клиентов
      errorMessage: ''    // Переменная для ошибок
    };
  },
  mounted() {
    // Загружаем клиентов при монтировании компонента
    this.fetchClients();
  },
  methods: {
    // Функция для получения клиентов с бэкенда
    async fetchClients() {
      try {
        const response = await axios.get('http://localhost:8000/api/clients');
        this.clients = response.data;  // Заполняем список клиентов
      } catch (error) {
        this.errorMessage = 'Ошибка при загрузке данных'; // Обрабатываем ошибку
      }
    },

    // Метод для редактирования клиента
    editClient(id) {
      this.$router.push(`/clients/${id}/edit`); // Переход на страницу редактирования
    },

    // Метод для удаления клиента
    async deleteClient(id) {
      try {
        await axios.delete(`http://localhost:8000/api/clients/${id}`);
        this.fetchClients(); // Перезагружаем список клиентов после удаления
      } catch (error) {
        this.errorMessage = 'Ошибка при удалении клиента'; // Обрабатываем ошибку
      }
    }
  }
};
</script>

<style scoped>
h1 {
  color: #42b983;
}
ul {
  list-style-type: none;
  padding: 0;
}
li {
  padding: 10px;
  border-bottom: 1px solid #ccc;
}
button {
  margin-left: 10px;
  padding: 5px 10px;
  background-color: #f44336;
  color: white;
  border: none;
  cursor: pointer;
}
button:hover {
  background-color: #d32f2f;
}
</style>
