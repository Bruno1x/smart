<template>
  <div style="padding: 20px; max-width: 900px; margin: auto">
    <h1>Vendas Realizadas</h1>
    <ListaVendas />

    <hr style="margin: 30px 0;" />

    <h1>Sistema de Vendas</h1>
    <VendaForm />
  </div>
</template>

<script setup>
import ListaVendas from '../components/venda/ListaVendas.vue'
import VendaForm from '../components/venda/VendaForm.vue'
</script>
