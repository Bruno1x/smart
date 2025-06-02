<template>
  <div style="padding: 20px; max-width: 900px; margin: auto">
    <h1>Cadastro de Produtos</h1>
    <CadastroProduto />

    <hr style="margin: 30px 0;" />

    <h2>Marcas Cadastradas</h2>
    <ListaMarcas />

    <hr style="margin: 30px 0;" />

    <h2>Produtos Cadastrados</h2>
    <ListaProdutos />
  </div>
</template>

<script setup>
import CadastroProduto from '../components/CadastroProduto.vue'
import ListaMarcas from '../components/ListaMarcas.vue'
import ListaProdutos from '../components/ListaProdutos.vue'
</script>
