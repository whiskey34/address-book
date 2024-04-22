<template>
    <div class="container">
        <div class="row">
            <div class="col-md-6 col-left">
                <div class="images-home">
                    <h1>YellowBook</h1>
                    <img src="../../assets/logo.svg" alt="img-logo">
                </div>
            </div>
            <div class="col-md-6 col-right">
                <div class="card">
                    <div class="card-body">
                        <h3>YellowBook</h3>
                        <p>1 (234) 567-891</p>
                        <p>1 (234) 567-891</p>

                        <h3>Add To Contact</h3>
                        <button class="btn btn-success">ADD Now</button>
                    </div>
                </div>
            </div>
        </div>
    </div>
</template>

<script setup></script>

<style scoped>
.container {
    margin-top: 30px;
}

.col-left {
    padding: 20px;
}
.col-right {
    padding: 20px;
}

.images-home h1{
    color: #FFD700;
    text-align: center;
}
.images-home img {
    max-width: 100%;
    height: auto;
}

.card {
    border-radius: 24px;
    background-color: #36454F;
    color: white;
    padding: 30px;
}

.card-body {
    justify-content: center;
    align-items: center;
    text-align: center;
}

@media (max-width: 991px)
{
    .col-left {
        padding: 20px;
        min-height: 100px;
    }
    .col-right {
        padding: 20px;
        min-height: 100px;

    }

    .card {
        border-radius: 24px;
        background-color: #36454F;
        color: white;
        padding: 30px;
        min-height: 100px;
    }
}

@media (max-width: 1199px)
{
    .col-left {
        padding: 20px;
        min-height: 100px;
    }
    .col-right {
        padding: 20px;
        min-height: 100px;

    }

    .card {
        border-radius: 24px;
        background-color: #36454F;
        color: white;
        padding: 30px;
        min-height: 100px;
    }
}
</style>