<template>
  <div class="lista-marcas">
   

    <table>
      <thead>
        <tr>
          <th>#</th>
          <th>Nome</th>
          <th>Ações</th>
        </tr>
      </thead>
      <tbody>
        <tr v-if="marcas.length === 0">
          <td colspan="3">Nenhuma marca cadastrada.</td>
        </tr>
        <tr v-for="marca in marcas" :key="marca.id">
          <td>{{ marca.id }}</td>
          <td>{{ marca.nome }}</td>
          <td>
            <button @click="prepararEdicao(marca)">Editar</button>
            <button @click="excluirMarca(marca.id)">Excluir</button>
          </td>
        </tr>
      </tbody>
    </table>

  
    <div v-if="editando" class="editar-form">
      <h3>Editar Marca</h3>
      <form @submit.prevent="atualizarMarca">
        <label>Nome:</label>
        <input v-model="marcaEditada.nome" type="text" required />

        <button type="submit">Salvar Alterações</button>
        <button type="button" @click="cancelarEdicao">Cancelar</button>
      </form>
    </div>
  </div>
</template>

<script setup>
import { ref, onMounted } from 'vue'
import api from '../services/api'

const marcas = ref([])
const editando = ref(false)
const marcaEditada = ref({
  id: null,
  nome: ''
})

const carregarMarcas = async () => {
  const res = await api.get('/marcas')
  marcas.value = res.data
}

const prepararEdicao = (marca) => {
  editando.value = true
  marcaEditada.value = { ...marca }
}

const cancelarEdicao = () => {
  editando.value = false
  marcaEditada.value = { id: null, nome: '' }
}

const atualizarMarca = async () => {
  await api.put(`/marcas/${marcaEditada.value.id}`, marcaEditada.value)
  await carregarMarcas()
  cancelarEdicao()
}

const excluirMarca = async (id) => {
  if (confirm('Deseja excluir esta marca?')) {
    await api.delete(`/marcas/${id}`)
    await carregarMarcas()
  }
}

onMounted(carregarMarcas)
</script>

<style scoped>
.lista-marcas {
  margin-top: 30px;
  font-family: sans-serif;
  color: white;
}

table {
  width: 100%;
  border-collapse: collapse;
  background-color: #1f1f1f;
  color: white;
  border-radius: 8px;
  overflow: hidden;
}

th, td {
  padding: 12px;
  border: 1px solid #444;
  text-align: left;
}

thead {
  background-color: #333;
  font-weight: bold;
}

button {
  margin: 3px;
  padding: 6px 10px;
  border: none;
  border-radius: 4px;
  cursor: pointer;
}
button:nth-child(1) {
  background: #3498db;
  color: white;
}
button:nth-child(2) {
  background: #e74c3c;
  color: white;
}

.editar-form {
  background-color: #2c2c2c;
  padding: 20px;
  margin-top: 20px;
  border-radius: 8px;
}
input {
  width: 100%;
  margin-bottom: 10px;
  padding: 8px;
  background-color: #1f1f1f;
  color: white;
  border: 1px solid #555;
  border-radius: 4px;
}
</style>
