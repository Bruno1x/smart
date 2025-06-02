<template>
  <div class="selecao-produto">
    <label>Produto:</label>
    <select v-model="produtoSelecionado">
      <option disabled value="">Selecione um produto</option>
      <option
        v-for="produto in produtos"
        :key="produto.id"
        :value="produto.id"
      >
        {{ produto.descricao }}
      </option>
    </select>

    <label>Quantidade:</label>
    <input type="number" v-model.number="quantidade" min="1" />

    <button
      @click="emitirItem"
      :disabled="!produtoSelecionado || quantidade < 1"
    >
      Adicionar Item
    </button>
  </div>
</template>

<script setup>
import { ref, onMounted } from 'vue'
import api from '../../services/api'

const emit = defineEmits(['itemAdicionado'])

const produtos = ref([])
const produtoSelecionado = ref('')
const quantidade = ref(1)

onMounted(async () => {
  try {
    const res = await api.get('/produtos')
    produtos.value = res.data
  } catch (error) {
    console.error('Erro ao carregar produtos:', error)
  }
})

const emitirItem = () => {
  const produto = produtos.value.find(p => p.id === produtoSelecionado.value)
  if (produto) {
    emit('itemAdicionado', {
      produto_id: produto.id,
      descricao: produto.descricao,
      quantidade: quantidade.value
    })

    
    produtoSelecionado.value = ''
    quantidade.value = 1
  }
}
</script>

<style scoped>
.selecao-produto {
  margin-top: 20px;
  color: white;
}

label {
  display: block;
  margin-top: 10px;
  margin-bottom: 4px;
  font-weight: bold;
}

select,
input {
  width: 100%;
  padding: 8px;
  margin-bottom: 12px;
  background: #1e1e1e;
  color: white;
  border: 1px solid #444;
  border-radius: 4px;
}

button {
  padding: 10px 16px;
  background-color: #2980b9;
  color: white;
  border: none;
  cursor: pointer;
  width: 100%;
  font-weight: bold;
}

button:disabled {
  background-color: #777;
  cursor: not-allowed;
}
</style>
