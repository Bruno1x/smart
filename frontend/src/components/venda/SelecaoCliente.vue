<template>
  <div class="selecao-cliente">
    <label for="cliente">Cliente:</label>
    <select v-model="selecionado" @change="emitirCliente" required>
      <option disabled value="">Selecione um cliente</option>
      <option v-for="cliente in clientes" :key="cliente.id" :value="cliente.id">
        {{ cliente.nome }}
      </option>
    </select>
  </div>
</template>

<script setup>
import { ref, onMounted } from 'vue'
import api from '../../services/api'

const emit = defineEmits(['clienteSelecionado'])

const clientes = ref([])
const selecionado = ref('')

const emitirCliente = () => {
  emit('clienteSelecionado', selecionado.value)
}

onMounted(async () => {
  const res = await api.get('/clientes')
  clientes.value = res.data
})
</script>

<style scoped>
.selecao-cliente {
  margin-bottom: 20px;
}
select {
  padding: 6px;
  width: 100%;
}
</style>
