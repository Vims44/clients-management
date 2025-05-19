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
  </div>
</template>

<script>
import axios from 'axios';
import { useToast } from 'vue-toastification';

export default {
  name: 'ClientCreate',
  data() {
    return {
      client: {
        name: '',
        email: '',
        phone: ''
      }
    };
  },
  setup() {
    const toast = useToast(); // инициализация тостов
    return { toast };
  },
  methods: {
    async createClient() {
      try {
        await axios.post('http://localhost:8000/api/clients', this.client);
        this.toast.success('Клиент успешно создан ✅'); // тост об успехе
        this.$router.push('/clients');
      } catch (error) {
        this.toast.error('Ошибка при создании клиента ❌'); // тост об ошибке
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
