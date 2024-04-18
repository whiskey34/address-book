<template>
    <div class="position-fixed bottom-0 end-0 p-3" style="z-index: 5">
      <div id="liveToast" class="toast hide" role="alert" aria-live="assertive" aria-atomic="true">
        <div class="toast-header">
          <strong class="me-auto">Notification</strong>
          <button type="button" class="btn-close" @click="hideToast" aria-label="Close"></button>
        </div>
        <div class="toast-body">
          {{ message }}
        </div>
      </div>
    </div>
  </template>
  
  <script setup>
  import { ref } from 'vue';
  
  const message = ref('');
  const showToast = ref(false);
  
  const showToastMessage = (msg) => {
    message.value = msg;
    showToast.value = true;
    setTimeout(() => {
      hideToast();
    }, 3000); // Hide the toast after 3 seconds
  };
  
  const hideToast = () => {
    showToast.value = false;
  };
  </script>
  
  <style scoped>
  /* Optional: Add custom styles for the toast */
  </style>
  