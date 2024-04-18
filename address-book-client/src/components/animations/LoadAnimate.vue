<template>
    <tr>
        <td colspan="7" class="loading-container">
          <div class="loading-spinner"></div>
          <p class="load-text">Loading...</p>
        </td>
    </tr>
  </template>
  
  <style scoped>
  .loading-container {
    /* display: flex;
    flex-direction: column; */
    /* align-items: center;
    justify-content: center; */
    text-align: center;
    height: 100px; /* Adjust height as needed */
  }
  
  .loading-spinner {
    display: inline-block;
    border: 4px solid rgba(51, 137, 126, 0.1);
    border-left-color: #33897E;
    border-radius: 50%;
    width: 40px;
    height: 40px;
    animation: spin 1s linear infinite;
  }

  .load-text {
    text-align: center;
  }
  
  @keyframes spin {
    to {
      transform: rotate(360deg);
    }
  }
  </style>
  