<template>
  <div class="lista-produtos">


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
            <button @click="prepararEdicao(produto)">Editar</button>
            <button @click="excluirProduto(produto.id)">Excluir</button>
            
          </td>
        </tr>
      </tbody>
    </table>

    <!-- Formulário de edição -->
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
  try {
    const res = await api.get('/produtos')
    produtos.value = res.data
  } catch (error) {
    console.error('Erro ao carregar produtos:', error)
  }
}

const carregarMarcas = async () => {
  try {
    const res = await api.get('/marcas')
    marcas.value = res.data
  } catch (error) {
    console.error('Erro ao carregar marcas:', error)
  }
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
  produtoEditado.value = {
    id: null,
    descricao: '',
    valor: '',
    marca_id: ''
  }
}

const atualizarProduto = async () => {
  try {
    await api.put(`/produtos/${produtoEditado.value.id}`, produtoEditado.value)
    await carregarProdutos()
    cancelarEdicao()
  } catch (err) {
    console.error('Erro ao atualizar produto', err)
  }
}

const excluirProduto = async (id) => {
  if (confirm('Deseja excluir este produto?')) {
    try {
      await api.delete(`/produtos/${id}`)
      await carregarProdutos()
    } catch (err) {
      console.error('Erro ao excluir produto:', err)
    }
  }
}

onMounted(async () => {
  await carregarProdutos()
  await carregarMarcas()
})

window.addEventListener('produto-cadastrado', carregarProdutos)
</script>

<style scoped>
.lista-produtos {
  margin-top: 30px;
  font-family: sans-serif;
}

.atualizar {
  margin-bottom: 10px;
  padding: 8px 12px;
  background-color: #2980b9;
  color: white;
  border: none;
  border-radius: 4px;
  cursor: pointer;
}

.atualizar:hover {
  background-color: #3498db;
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
button:hover {
  opacity: 0.9;
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
  color: white;
  padding: 20px;
  margin-top: 20px;
  border: 1px solid #444;
  border-radius: 8px;
}
.editar-form input,
.editar-form select {
  width: 100%;
  padding: 8px;
  margin-bottom: 12px;
  background: #1f1f1f;
  color: white;
  border: 1px solid #555;
  border-radius: 4px;
}
</style>
