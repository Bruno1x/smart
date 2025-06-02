<template>
  <nav class="navbar">
    <router-link to="/cadastro" class="nav-link">Cadastro</router-link>
    <router-link to="/vendas" class="nav-link">Vendas</router-link>
  </nav>
</template>

<style scoped>
.navbar {
  display: flex;
  justify-content: center;
  gap: 40px;
  padding: 20px;
  background-color: #1e1e1e;
  border-bottom: 1px solid #333;
  margin-bottom: 20px;
}

.nav-link {
  color: #42b983;
  text-decoration: none;
  font-size: 18px;
  font-weight: bold;
}

.nav-link:hover {
  color: white;
}

.router-link-exact-active {
  color: white;
  border-bottom: 2px solid #42b983;
}
</style>
