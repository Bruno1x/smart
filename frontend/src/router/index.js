import { createRouter, createWebHistory } from 'vue-router'
import CadastroPage from '../pages/CadastroPage.vue'
import VendasPage from '../pages/VendasPage.vue'

const routes = [
  { path: '/', redirect: '/cadastro' },
  { path: '/cadastro', component: CadastroPage },
  { path: '/vendas', component: VendasPage }
]

const router = createRouter({
  history: createWebHistory(),
  routes
})

export default router