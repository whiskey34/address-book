<template>
  <div class="card-container" >
    <div class="card">
      <div class="card-body">
        <div class="about">
          <h1 class="title">YellowBook</h1>
          <h5 class="sub-title">Save All Address & Contact at one place. </h5>
          <p class="mb-4">Created By Delfin ( <i class="pi pi-github" style="font-size: 1rem"></i> : 
            <a href="https://github.com/whiskey34/address-book">Whiskey34</a> ) 🎉🥳</p>
        </div>
      </div>
    </div>
  </div>
  
</template>

<script setup>

</script>

<style>

.card-container {
  margin-top: 20px;
  display: flex;
  justify-content: center;
  align-items: center;
  height: 50vh; 
}

.card {
  justify-content: center;
  align-items: center;
  padding: 20px;
  width: 500px;
  border-radius: 10px;
  box-shadow: 4px 4px #d0cccc;
  border: none;
  background-color: #90EE90;
}

.card-body {
  align-items: center;
  text-align: center;
  justify-content: center;
}

.card:hover {
    transform: rotate(3deg);
}

.title {
    color: #FFD700;
    font-weight: bold;
  }

  .sub-title {
    color: gray;
  }

/* @media (min-width: 1024px) {
  .about {
    min-height: 100vh;
    display: flex;
    align-items: center;
    text-align: center;
    margin-top: 50px;
  }
  .title {
    color: #FFD700;
    font-weight: bold;
  }

  .sub-title {
    color: gray;
  }
  
} */
</style>
