<template>
  <div>
    <nav class="menu">
      <router-link to="/cadastro">Cadastro</router-link>
      <router-link to="/vendas">Vendas</router-link>
    </nav>

    <router-view />
  </div>
</template>

<script setup>

</script>

<style scoped>
.menu {
  text-align: center;
  background: #1f1f1f;
  padding: 15px;
  margin-bottom: 30px;
}

.menu a {
  margin: 0 20px;
  text-decoration: none;
  font-weight: bold;
  color: #42b983;
  font-size: 18px;
}

.menu a.router-link-active {
  color: #ffffff;
}
</style>




