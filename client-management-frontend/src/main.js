import { createApp } from 'vue';
import App from './App.vue';
import router from './router'; // Импорт роутера

import Toast from 'vue-toastification';
import 'vue-toastification/dist/index.css';

const app = createApp(App);
app.use(router); // Подключение роутера
app.use(Toast); // Подключение тостов
app.mount('#app');
