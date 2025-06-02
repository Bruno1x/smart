<template>
  <div class="itens-venda">
    <h3>Itens da Venda</h3>

    <table v-if="itens.length > 0">
      <thead>
        <tr>
          <th>#</th>
          <th>Descrição</th>
          <th>Quantidade</th>
        </tr>
      </thead>
      <tbody>
        <tr v-for="(item, index) in itens" :key="index">
          <td>{{ index + 1 }}</td>
          <td>{{ item.descricao }}</td>
          <td>{{ item.quantidade }}</td>
        </tr>
      </tbody>
    </table>

    <p v-else>Nenhum item adicionado.</p>
  </div>
</template>

<script setup>
defineProps(['itens'])
</script>

<style scoped>
.itens-venda {
  margin-top: 20px;
  color: white;
}

h3 {
  text-align: center;
  margin-bottom: 10px;
}

table {
  width: 100%;
  border-collapse: collapse;
  margin-top: 10px;
  background: #1e1e1e;
}

th,
td {
  border: 1px solid #444;
  padding: 8px;
  text-align: center;
}

th {
  background-color: #2c2c2c;
  color: #fff;
}
</style>

