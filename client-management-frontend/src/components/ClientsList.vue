<template>
  <div class="container">
    <h1>Список клиентов</h1>

    <!-- Поиск -->
    <input
      type="text"
      v-model="searchQuery"
      placeholder="Поиск по имени или email..."
      class="search-input"
    />

    <button @click="$router.push('/clients/create')" class="create-button">
      + Создать клиента
    </button>

    <!-- Список клиентов -->
    <div v-if="filteredClients.length" class="cards">
      <div class="card" v-for="client in filteredClients" :key="client.id">
        <div class="client-info">
          <strong>{{ client.name }}</strong>
          <p>{{ client.email }}</p>
        </div>
        <div class="actions">
          <button class="edit-btn" @click="editClient(client.id)">✏️ Редактировать</button>
          <button class="delete-btn" @click="deleteClient(client.id)">🗑️ Удалить</button>
        </div>
      </div>
    </div>

    <!-- Нет результатов -->
    <div v-else class="no-results">
      Клиенты не найдены
    </div>

    <!-- Ошибка -->
    <div v-if="errorMessage" class="error">
      {{ errorMessage }}
    </div>
  </div>
</template>

<script>
import axios from 'axios';

export default {
  name: 'ClientsList',
  data() {
    return {
      clients: [],
      searchQuery: '',
      errorMessage: ''
    };
  },
  computed: {
    filteredClients() {
      const q = this.searchQuery.toLowerCase();
      return this.clients.filter(
        client =>
          client.name.toLowerCase().includes(q) ||
          client.email.toLowerCase().includes(q)
      );
    }
  },
  mounted() {
    this.fetchClients();
  },
  methods: {
    async fetchClients() {
      try {
        const response = await axios.get('http://localhost:8000/api/clients');
        this.clients = response.data;
      } catch (error) {
        this.errorMessage = 'Ошибка при загрузке данных';
      }
    },
    editClient(id) {
      this.$router.push(`/clients/${id}/edit`);
    },
    async deleteClient(id) {
      try {
        await axios.delete(`http://localhost:8000/api/clients/${id}`);
        this.fetchClients();
      } catch (error) {
        this.errorMessage = 'Ошибка при удалении клиента';
      }
    }
  }
};
</script>

<style scoped>
.container {
  max-width: 800px;
  margin: auto;
  padding: 20px;
  font-family: 'Segoe UI', sans-serif;
}

h1 {
  color: #2c3e50;
  text-align: center;
}

.search-input {
  width: 100%;
  padding: 10px;
  margin-bottom: 20px;
  font-size: 16px;
}

.create-button {
  background-color: #42b983;
  color: white;
  padding: 10px 20px;
  border: none;
  margin-bottom: 20px;
  cursor: pointer;
  border-radius: 4px;
}

.create-button:hover {
  background-color: #369f6b;
}

.cards {
  display: flex;
  flex-direction: column;
  gap: 15px;
}

.card {
  background-color: #f9f9f9;
  padding: 15px 20px;
  border-radius: 8px;
  border: 1px solid #ddd;
  display: flex;
  justify-content: space-between;
  align-items: center;
}

.client-info p {
  margin: 4px 0 0 0;
  color: #555;
}

.actions button {
  margin-left: 10px;
  padding: 6px 12px;
  border-radius: 4px;
  border: none;
  cursor: pointer;
}

.edit-btn {
  background-color: #2196f3;
  color: white;
}

.edit-btn:hover {
  background-color: #0b7dda;
}

.delete-btn {
  background-color: #f44336;
  color: white;
}

.delete-btn:hover {
  background-color: #d32f2f;
}

.no-results {
  text-align: center;
  color: #999;
  font-style: italic;
  margin-top: 20px;
}

.error {
  color: red;
  margin-top: 20px;
  text-align: center;
}
</style>
