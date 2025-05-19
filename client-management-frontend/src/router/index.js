import { createRouter, createWebHistory } from 'vue-router';
import ClientsList from '../components/ClientsList.vue';
import ClientEdit from '../components/ClientEdit.vue'; 
import ClientCreate from '../components/ClientCreate.vue';

const routes = [
  {
    path: '/',
    redirect: '/clients'
  },
  {
    path: '/clients',
    name: 'ClientsList',
    component: ClientsList
  },
  {
    path: '/clients/create', 
    name: 'ClientCreate',
    component: ClientCreate
  },
  {
    path: '/clients/:id/edit',
    name: 'ClientEdit',
    component: ClientEdit
  }
];

const router = createRouter({
  history: createWebHistory(),
  routes
});

export default router;
