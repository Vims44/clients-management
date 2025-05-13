<template>
  <div>
    <h1>Clients List</h1>
    <ul>
      <li v-for="client in clients" :key="client.id">
        {{ client.name }} - {{ client.email }}
      </li>
    </ul>
  </div>
</template>

<script>
export default {
  name: 'ClientsList',
  data() {
    return {
      clients: [
        { id: 1, name: 'Client 1', email: 'client1@example.com' },
        { id: 2, name: 'Client 2', email: 'client2@example.com' },
        { id: 3, name: 'Client 3', email: 'client3@example.com' }
      ]
    };
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
</style>
