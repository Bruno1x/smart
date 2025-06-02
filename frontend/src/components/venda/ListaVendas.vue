<template>
  <div class="lista-vendas">
 

    <table>
      <thead>
        <tr>
          <th>ID</th>
          <th>Cliente</th>
          <th>Data</th>
          <th>Total (R$)</th>
        </tr>
      </thead>
      <tbody>
        <tr v-if="vendas.length === 0">
          <td colspan="4">Nenhuma venda registrada.</td>
        </tr>
        <tr v-for="venda in vendas" :key="venda.id">
          <td>{{ venda.id }}</td>
          <td>{{ venda.cliente?.nome || 'Desconhecido' }}</td>
          <td>{{ formatarData(venda.created_at) }}</td>
          <td>R$ {{ venda.total.toFixed(2) }}</td>
        </tr>
      </tbody>
    </table>
  </div>
</template>

<script setup>
import { ref, onMounted } from 'vue'
import api from '../../services/api'

const vendas = ref([])

const carregarVendas = async () => {
  try {
    const res = await api.get('/vendas')
    vendas.value = res.data
  } catch (error) {
    console.error('Erro ao carregar vendas:', error)
  }
}

const formatarData = (data) => {
  return new Date(data).toLocaleString('pt-BR')
}

onMounted(carregarVendas)
</script>

<style scoped>
.lista-vendas {
  margin-top: 30px;
  font-family: sans-serif;
  color: white;
}

table {
  width: 100%;
  border-collapse: collapse;
  background-color: #1e1e1e;
  color: white;
  border-radius: 8px;
  overflow: hidden;
  margin-top: 20px;
}

th, td {
  padding: 12px;
  border: 1px solid #333;
  text-align: left;
}

thead {
  background-color: #2c2c2c;
}

tbody tr:nth-child(odd) {
  background-color: #1b1b1b;
}
</style>

