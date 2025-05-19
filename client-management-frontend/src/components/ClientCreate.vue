<template>
  <div>
    <h1>Create Client</h1>
    <form @submit.prevent="createClient">
      <div>
        <label>Name:</label>
        <input v-model="client.name" type="text" required />
      </div>
      <div>
        <label>Email:</label>
        <input v-model="client.email" type="email" required />
      </div>
      <div>
        <label>Phone:</label>
        <input v-model="client.phone" type="text" />
      </div>
      <button type="submit">Create</button>
    </form>

    <p v-if="errorMessage" style="color: red;">{{ errorMessage }}</p>
  </div>
</template>

<script>
import axios from 'axios';

export default {
  name: 'ClientCreate',
  data() {
    return {
      client: {
        name: '',
        email: '',
        phone: ''
      },
      errorMessage: ''
    };
  },
  methods: {
    async createClient() {
      try {
        await axios.post('http://localhost:8000/api/clients', this.client);
        this.$router.push('/clients'); // После создания переходим обратно к списку
      } catch (error) {
        this.errorMessage = 'Ошибка при создании клиента';
      }
    }
  }
};
</script>

<style scoped>
form {
  max-width: 400px;
  margin: 0 auto;
}
div {
  margin-bottom: 10px;
}
label {
  display: block;
  margin-bottom: 5px;
}
input {
  width: 100%;
  padding: 8px;
  box-sizing: border-box;
}
button {
  padding: 10px 15px;
  background-color: #4CAF50;
  color: white;
  border: none;
  cursor: pointer;
}
</style>
