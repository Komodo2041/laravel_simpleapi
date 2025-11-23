<template>
  <div id="app">

    <nav>
      <router-link to="/">Home</router-link> |
      <router-link to="/about">About</router-link>
    </nav>
 
     <router-view/>
  </div>
</template>

<script>
 
 

export default {
  name: 'App',
  components: {
    
  }
}
</script>

<style>
#app {
  font-family: Avenir, Helvetica, Arial, sans-serif;
  -webkit-font-smoothing: antialiased;
  -moz-osx-font-smoothing: grayscale;
  text-align: center;
  color: #2c3e50;
  margin-top: 60px;
}

nav { padding: 20px; background: #f4f4f4; }
nav a { font-weight: bold; color: #2c3e50; margin: 0 10px; }
.router-link-active { color: #42b983 !important; }

</style>
