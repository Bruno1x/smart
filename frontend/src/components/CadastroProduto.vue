<template>
  <div class="cadastro-produto">
    <h2>Cadastrar Produto</h2>

    <form @submit.prevent="cadastrarProduto">
      <div>
        <label for="marca">Marca:</label>
        <select v-model="produto.marca_id" required>
          <option disabled value="">Selecione uma marca</option>
          <option v-for="marca in marcas" :key="marca.id" :value="marca.id">
            {{ marca.nome }}
          </option>
        </select>
      </div>

      <div>
        <label for="descricao">Descrição:</label>
        <input v-model="produto.descricao" type="text" required />
      </div>

      <div>
        <label for="valor">Valor (R$):</label>
        <input v-model.number="produto.valor" type="number" step="0.01" required />
      </div>

      <button type="submit">Salvar Produto</button>
    </form>

    <p v-if="mensagem">{{ mensagem }}</p>
  </div>
</template>

<script setup>
import { ref, onMounted } from 'vue'
import api from '../services/api'

const marcas = ref([])
const mensagem = ref('')
const produto = ref({
  marca_id: '',
  descricao: '',
  valor: null
})

// Carrega marcas no início
onMounted(async () => {
  const res = await api.get('/marcas')
  marcas.value = res.data
})

const cadastrarProduto = async () => {
  try {
    await api.post('/produtos', {
      ...produto.value,
      valor: parseFloat(produto.value.valor)
    })

    mensagem.value = 'Produto cadastrado com sucesso!'

    // Dispara evento global para atualizar a lista
    window.dispatchEvent(new Event('produto-cadastrado'))

    // Limpa o formulário
    produto.value = {
      marca_id: '',
      descricao: '',
      valor: null
    }
  } catch (error) {
    console.error(error)
    mensagem.value = 'Erro ao cadastrar produto.'
  }
}
</script>

<style scoped>
.cadastro-produto {
  max-width: 400px;
  margin: auto;
  padding: 20px;
  border: 1px solid #ccc;
  border-radius: 8px;
}
.cadastro-produto div {
  margin-bottom: 10px;
}
.cadastro-produto label {
  display: block;
  margin-bottom: 4px;
}
.cadastro-produto input,
.cadastro-produto select {
  width: 100%;
  padding: 6px;
}
button {
  width: 100%;
  padding: 10px;
  font-weight: bold;
  background: #27ae60;
  color: white;
  border: none;
  border-radius: 4px;
  cursor: pointer;
}
p {
  margin-top: 10px;
  text-align: center;
  font-weight: bold;
}
</style>
