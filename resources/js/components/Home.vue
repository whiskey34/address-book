<script setup>
import TableContact from  '@/components/TableContact.vue';

</script>

<template>
    <nav class="navbar navbar-expand-lg bg-body-tertiary">
        <div class="container-fluid">
            <a class="navbar-brand" href="#">ADDRESS BOOK</a>
            <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
                <span class="navbar-toggler-icon"></span>
            </button>
            <div class="collapse navbar-collapse" id="navbarSupportedContent">
                <ul class="navbar-nav me-auto mb-2 mb-lg-0">
                    <li class="nav-item">
                        <!-- <a class="nav-link active" aria-current="page" href="/">Home</a> -->
                        <RouterLink class="nav-link active" aria-current="page" :to="{name: 'home'}">Home</RouterLink>

                    </li>
                    <!-- <li class="nav-item">
                        <a class="nav-link" href="/about">About</a>
                        <RouterLink class="nav-link" :to="{ name: 'about' }">About</RouterLink>
                    </li> -->
                    
                    
                    
                </ul>
                
            </div>
        </div>
    </nav>
    <div class="container-fluid">


        <h1 class="text-center mt-3">Welcome To My Address Book</h1>
        

        <TableContact />
    </div>
</template>