<script setup>
import { RouterLink, RouterView } from 'vue-router'

// import HelloWorld from './components/HelloWorld.vue'
// import TableContact from './components/TableContact.vue'



</script>

<template>
    
      <!-- <nav class="navbar navbar-expand-lg bg-body-tertiary"> -->
      <nav class="navbar navbar-expand-lg">
        <div class="container-fluid">
          <RouterLink class="navbar-brand" to="/">YellowBook</RouterLink>
          <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNav" aria-controls="navbarNav" aria-expanded="false" aria-label="Toggle navigation">
            <span class="navbar-toggler-icon"></span>
          </button>
          <div class="collapse navbar-collapse" id="navbarNav">
            <ul class="navbar-nav">
              <li class="nav-item">
                <RouterLink to="/" class="nav-link">Home</RouterLink>
              </li>
              <li class="nav-item">
                <RouterLink to="/contact" class="nav-link">List</RouterLink>
              </li>
              <li class="nav-item">
                <RouterLink to="/about" class="nav-link">About</RouterLink>
              </li> 
              
            </ul>
          </div>
        </div>
      </nav>

    
      <!-- <nav>
        <RouterLink to="/">Home</RouterLink>
        <RouterLink to="/about">About</RouterLink>
      </nav> -->




  <RouterView />

</template>

<style scoped>
.navbar-brand {
  color: #FFD700;
  font-weight: bold;
}

.navbar {
  background-color: #36454F;
}

.navbar-toggler {
  border-color: white
}

.nav-link {
  color: white;
}

</style>
