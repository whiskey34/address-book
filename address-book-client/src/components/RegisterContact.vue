<script setup>
import axios from 'axios';
import { ref } from 'vue';
import { useRouter } from 'vue-router';

const fullName = ref('');
const phoneNum = ref('');
const email = ref('');
const Address = ref('');
const City = ref('');

const router = useRouter();



const registerForm = async () => {

    try {
        
        const response = await axios.post('http://localhost:8000/api/contacts', {
            name: fullName.value,
            phone: phoneNum.value,
            email: email.value,
            address: Address.value,
            city: City.value,
        // Add other fields here

        });
        console.log('Contact added successfully:', response.data);
        router.push('/contact');
        
        
    } catch (error) {
        console.error('Error adding contact:', error);
        // Handle error response

        if (error.response && error.response.data && error.response.data.errors) {
            errorList.value = error.response.data.errors;
        } else {
            // Handle other types of errors
            alert('An error occurred while submitting the form. Please try again later.');
        }
    }
};
</script>

<template>
    <div class="container">
        <div class="row">
            <div class="card mt-3">
                <div class="card-header">
                    <h2 class="card-title">New Register Contact Form</h2>
                    <p class="card-text">Please fill contact info correctly.</p>
                   
                </div>
                <div class="card-body">
                    

                    <form @submit.prevent="registerForm">
                        <div class="mb-3">
                            <label for="fullName" class="form-label">Full Name</label>
                            <input type="text" v-model="fullName" class="form-control" id="fullName" required>
                            
                        </div>
                        <div class="mb-3">
                            <label for="phoneNum" class="form-label">Phone Number</label>
                            <input type="text" v-model="phoneNum" class="form-control" id="phoneNum" required>
                            
                        </div>
                        <div class="mb-3">
                            <label for="email" class="form-label">Email address</label>
                            <input type="email" v-model="email" class="form-control" id="email" aria-describedby="emailHelp" required>
                            <div id="emailHelp" class="form-text">We'll never share your email with anyone else.</div>
                        </div>
                        <div class="mb-3">
                            <label for="Address" class="form-label">Address</label>
                            <textarea name="Address" v-model="Address" class="form-control" id="Address" cols="30" rows="10" aria-describedby="addressHelp" required></textarea>
                            <div id="addressHelp" class="form-text">We'll never share your address with anyone else.</div>
                        </div>
                        <div class="mb-3">
                            <label for="City" class="form-label">City</label>
                            <input type="text" v-model="City" class="form-control" id="City" required>
                        </div>
                        <div class="col-auto text-end">
                            <button type="submit" class="btn btn-primary">Submit</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
        

        
    </div>
</template>

<style scoped></style>