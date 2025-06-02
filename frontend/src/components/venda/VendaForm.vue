<template>
  <div style="margin-top: 20px">
    <!-- Campo Cliente -->
    <label for="cliente">Cliente:</label>
    <select v-model="clienteSelecionado">
      <option disabled value="">Selecione um cliente</option>
      <option v-for="cliente in clientes" :key="cliente.id" :value="cliente.id">
        {{ cliente.nome }}
      </option>
    </select>

    <!-- Campo Produto -->
    <label for="produto">Produto:</label>
    <select v-model="produtoSelecionado">
      <option disabled value="">Selecione um produto</option>
      <option v-for="produto in produtos" :key="produto.id" :value="produto.id">
        {{ produto.descricao }}
      </option>
    </select>

    <!-- Campo Quantidade -->
    <label for="quantidade">Quantidade:</label>
    <input type="number" v-model.number="quantidade" min="1" />

    <!-- Botão -->
    <button
      @click="emitirItem"
      :disabled="!clienteSelecionado || !produtoSelecionado || quantidade < 1"
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
const clientes = ref([])

const produtoSelecionado = ref('')
const clienteSelecionado = ref('')
const quantidade = ref(1)

onMounted(async () => {
  const resProdutos = await api.get('/produtos')
  produtos.value = resProdutos.data

  const resClientes = await api.get('/clientes')
  clientes.value = resClientes.data
})

const emitirItem = () => {
  const produto = produtos.value.find(p => p.id === produtoSelecionado.value)
  const cliente = clientes.value.find(c => c.id === clienteSelecionado.value)

  if (produto && cliente) {
    emit('itemAdicionado', {
      cliente_id: cliente.id,
      produto_id: produto.id,
      descricao: produto.descricao,
      quantidade: quantidade.value
    })

    produtoSelecionado.value = ''
    quantidade.value = 1
  }
}
</script>

