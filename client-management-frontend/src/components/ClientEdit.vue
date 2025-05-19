<template>
  <div>
    <h1>Edit Client</h1>
    <form @submit.prevent="updateClient">
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
      <button type="submit">Update</button>
    </form>
    <p v-if="errorMessage" style="color: red;">{{ errorMessage }}</p>
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
  background-color: #42b983;
  color: white;
  border: none;
  cursor: pointer;
}
</style>
