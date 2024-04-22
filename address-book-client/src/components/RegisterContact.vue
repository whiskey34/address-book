<script setup>
import axios from 'axios';
import { ref, computed } from 'vue';
import { useRouter } from 'vue-router';
import { Form, Field } from 'vee-validate';
import * as Yup from 'yup'
import { toast } from 'vue3-toastify'
import 'vue3-toastify/dist/index.css';

const fullName = ref('');
const phoneNum = ref('');
const email = ref('');
const Address = ref('');
const City = ref('');

const router = useRouter();
const errorList = ref([]);

const successNotify = () => {
  toast("data successfully added !", {
    autoClose: 1000,
    theme: "auto",
    type: "success",
    position: "bottom-right",
    dangerouslyHTMLString: true
  }); // ToastOptions
};

const errorNotify = () => {
  toast("Failed to add data!", {
    autoClose: 2000,
    theme: "auto",
    type: "error",
    position: "bottom-right",
    dangerouslyHTMLString: true
  }); // ToastOptions
};

const schema = Yup.object().shape({
    fullName: Yup.string()
        .required(' Name is required'),
    phoneNum: Yup.string()
        .required('Phone Number is required'),
    email: Yup.string()
        .required('Email is required'),
    Address: Yup.string()
        .required('Address is required'),
    city: Yup.string()
        .required('City is required'),
    
});

const isFormValid = computed(() => {
    return (
        fullName.value.trim() !== '' &&
        phoneNum.value.trim() !== '' &&
        email.value.trim() !== '' &&
        Address.value.trim() !== '' &&
        City.value.trim() !== ''
    );
});

const registerForm = async () => {
    try {
        const formData = {
            name: fullName.value,
            phone: phoneNum.value,
            email: email.value,
            address: Address.value,
            city: City.value,
            // Add other fields here
        };
        // console.log('Form Data:', formData);
        const response = await axios.post('https://yellowbook.portogarage.my.id/api/contacts', formData);

        // console.log('Contact added successfully:', response.data);
        successNotify();
        router.push('/contact');
        // if (response.status === 200) {
        //     successNotify();
        //     router.push('/contact');
        // }
    } catch (error) {
        console.error('Error adding contact:', error);
        // Handle error response
        errorNotify();
        if (error.response && error.response.data && error.response.data.errors) {
            errorList.value = error.response.data.errors;
        } else {
            // Handle other types of errors
            alert('An error occurred while submitting the form. Please try again later.');
            // router.push('/contact');
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
                    

                    <Form :validation-schema="schema" v-slot="{ errors }">

                        <div class="mb-3">
                            <label for="fullName" class="form-label">Full Name</label>
                            <Field type="text" name="fullName" v-model="fullName" class="form-control" id="fullName" :class="{ 'is-invalid': errors.fullName }"/>
                            <div class="invalid-feedback">{{errors.fullName}}</div>
                        </div>
                        <div class="mb-3">
                            <label for="phoneNum" class="form-label">Phone Number</label>
                            <Field type="text" name="phoneNum" v-model="phoneNum" class="form-control" id="phoneNum" aria-describedby="emailHelp" :class="{ 'is-invalid': errors.phoneNum }"/>
                            <div class="invalid-feedback">{{errors.phoneNum}}</div>
                            <div id="phoneNumHelp" class="form-text">Minimun is 10 digits and maximum is 13 digits.</div>
                        </div>
                        <div class="mb-3">
                            <label for="email" class="form-label">Email address</label>
                            <Field type="email" name="email" v-model="email" class="form-control" id="email" aria-describedby="emailHelp" :class="{ 'is-invalid': errors.email }"/>
                            <div class="invalid-feedback">{{errors.email}}</div>
                            <div id="emailHelp" class="form-text">We'll never share your email with anyone else.</div>
                        </div>
                        <div class="mb-3">
                            <label for="Address" class="form-label">Address</label>
                            <Field name="Address" v-model="Address" class="form-control" id="Address" cols="30" rows="10" aria-describedby="addressHelp" :class="{ 'is-invalid': errors.Address }"/>
                            <div class="invalid-feedback">{{errors.Address}}</div>
                            <div id="addressHelp" class="form-text">We'll never share your address with anyone else.</div>
                        </div>
                        <div class="mb-3">
                            <label for="City" class="form-label">City</label>
                            <Field type="text" name="city" v-model="City" class="form-control" id="City" :class="{ 'is-invalid': errors.city }"/>
                            <div class="invalid-feedback">{{errors.city}}</div>
                        </div>
                        <div v-if="isFormValid" class="col-auto text-end">
                            <button type="button" @click="registerForm" class="btn btn-primary">Submit</button>
                        </div>
                        <div v-else class="col-auto text-end">
                            <button type="button" class="btn btn-primary" disabled>Submit</button>
                        </div>
                    </Form>
                </div>
            </div>
        </div>
        

        
    </div>
</template>

<style scoped></style>