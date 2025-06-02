<template>
  <div class="lista-produtos">
    <h2>Produtos Cadastrados</h2>

    <button @click="carregarProdutos" class="atualizar">
      Atualizar Lista
    </button>

    <table>
      <thead>
        <tr>
          <th>#</th>
          <th>Descrição</th>
          <th>Marca</th>
          <th>Valor (R$)</th>
          <th>Ações</th>
        </tr>
      </thead>
      <tbody>
        <tr v-if="produtos.length === 0">
          <td colspan="5">Nenhum produto cadastrado.</td>
        </tr>
        <tr v-for="produto in produtos" :key="produto.id">
          <td>{{ produto.id }}</td>
          <td>{{ produto.descricao }}</td>
          <td>{{ produto.marca?.nome || 'Sem marca' }}</td>
          <td>R$ {{ produto.valor.toFixed(2) }}</td>
          <td>
            <button class="editar" @click="prepararEdicao(produto)">Editar</button>
            <button class="excluir" @click="excluirProduto(produto.id)">Excluir</button>
          </td>
        </tr>
      </tbody>
    </table>

    <div v-if="editando" class="editar-form">
      <h3>Editar Produto</h3>
      <form @submit.prevent="atualizarProduto">
        <label>Descrição:</label>
        <input v-model="produtoEditado.descricao" type="text" required />

        <label>Valor:</label>
        <input v-model.number="produtoEditado.valor" type="number" step="0.01" required />

        <label>Marca:</label>
        <select v-model="produtoEditado.marca_id" required>
          <option v-for="marca in marcas" :key="marca.id" :value="marca.id">
            {{ marca.nome }}
          </option>
        </select>

        <button type="submit">Salvar Alterações</button>
        <button type="button" @click="cancelarEdicao">Cancelar</button>
      </form>
    </div>
  </div>
</template>

<script setup>
import { ref, onMounted } from 'vue'
import api from '../services/api'

const produtos = ref([])
const marcas = ref([])

const editando = ref(false)
const produtoEditado = ref({
  id: null,
  descricao: '',
  valor: '',
  marca_id: ''
})

const carregarProdutos = async () => {
  const res = await api.get('/produtos')
  produtos.value = res.data
}
const carregarMarcas = async () => {
  const res = await api.get('/marcas')
  marcas.value = res.data
}

const prepararEdicao = (produto) => {
  editando.value = true
  produtoEditado.value = {
    id: produto.id,
    descricao: produto.descricao,
    valor: produto.valor,
    marca_id: produto.marca?.id || ''
  }
}

const cancelarEdicao = () => {
  editando.value = false
  produtoEditado.value = { id: null, descricao: '', valor: '', marca_id: '' }
}

const atualizarProduto = async () => {
  await api.put(`/produtos/${produtoEditado.value.id}`, produtoEditado.value)
  await carregarProdutos()
  cancelarEdicao()
}

const excluirProduto = async (id) => {
  if (confirm('Deseja excluir este produto?')) {
    await api.delete(`/produtos/${id}`)
    await carregarProdutos()
  }
}

onMounted(async () => {
  await carregarProdutos()
  await carregarMarcas()
})
</script>

<style scoped>
body {
  background-color: #121212;
  color: white;
  font-family: 'Segoe UI', sans-serif;
  margin: 0;
  padding: 0;
}

.lista-produtos {
  margin-top: 30px;
}

h2, h3 {
  text-align: center;
  color: #42b983;
  margin-bottom: 20px;
}

.atualizar {
  margin-bottom: 15px;
  padding: 10px 14px;
  background-color: #42b983;
  color: white;
  border: none;
  border-radius: 6px;
  font-weight: bold;
  cursor: pointer;
}

.atualizar:hover {
  background-color: #2ecc71;
}

table {
  width: 100%;
  border-collapse: collapse;
  background-color: #1e1e1e;
  color: white;
  border-radius: 8px;
  overflow: hidden;
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
  background-color: #1a1a1a;
}

button {
  margin: 3px;
  padding: 8px 12px;
  border: none;
  border-radius: 4px;
  font-weight: bold;
  cursor: pointer;
}
button.editar {
  background-color: #3498db;
  color: white;
}
button.excluir {
  background-color: #e74c3c;
  color: white;
}
button:hover {
  opacity: 0.9;
}

.editar-form {
  background-color: #2c2c2c;
  padding: 20px;
  margin-top: 30px;
  border-radius: 8px;
}

input,
select {
  width: 100%;
  padding: 10px;
  margin-bottom: 15px;
  background-color: #1f1f1f;
  color: white;
  border: 1px solid #555;
  border-radius: 4px;
}
input:focus,
select:focus {
  outline: none;
  border-color: #42b983;
}
</style>


