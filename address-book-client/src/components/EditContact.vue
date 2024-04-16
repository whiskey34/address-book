<script setup>
import { Form, Field } from 'vee-validate';
import * as Yup from 'yup'
import axios from 'axios';
import { ref, defineProps } from 'vue';

// Define props
const props = defineProps({
  selectedContact: Object, // Prop to receive the contact data
});



const schema = Yup.object().shape({
    fullName: Yup.string()
        .required(' Name is required'),
    phoneNum: Yup.string()
        .required('Phone Number is required'),
    email: Yup.string()
        .required('Email is required'),
    address: Yup.string()
        .required('Address is required'),
    city: Yup.string()
        .required('City is required'),
    
});

function onSubmit(values) {
    // display form values on success
    // alert('SUCCESS!! :-)\n\n' + JSON.stringify( null, 4));
    console.log ('Data has success update!')
}
</script>

<template>

    <div class="modal fade" id="editModal" tabindex="-1" aria-labelledby="eeditModalLabel" aria-hidden="true">
        <div class="modal-dialog" >
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="editModalLabel">Edit Contact Form</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <Form action="" @submit="onSubmit" :validation-schema="schema" v-slot="{ errors }">
                    <div class="modal-body">
                        
                        <div class="mb-3">
                            <label for="fullName" class="form-label">Full Name</label>
                            <Field  name="fullName" v-model="selectedContact.name"  type="text" class="form-control" :class="{ 'is-invalid': errors.fullName }" />
                            <div class="invalid-feedback">{{errors.fullName}}</div>
                        </div>
                        <div class="mb-3">
                            <label for="phoneNum" class="form-label">Phone Number</label>
                            <Field name="phoneNum" v-model="selectedContact.phone" type="text" class="form-control" :class="{ 'is-invalid': errors.phoneNum }" />
                            <div class="invalid-feedback">{{errors.phoneNum}}</div>
                        </div>
                        <div class="mb-3">
                            <label for="email" class="form-label">Email address</label>
                            <Field name="email" v-model="selectedContact.email" type="email" class="form-control" :class="{ 'is-invalid': errors.email }" />
                            <div class="invalid-feedback">{{errors.email}}</div>
                        </div>
                        <div class="mb-3">
                            <label for="address" class="form-label">Address</label>
                            <Field name="address" v-model="selectedContact.address" type="text" class="form-control" :class="{ 'is-invalid': errors.address }"/>
                            <div class="invalid-feedback">{{errors.address}}</div>

                        </div>
                        <div class="mb-3 col-5">
                            <label for="city" class="form-label">City</label>
                            <Field name="city" v-model="selectedContact.city" type="text" class="form-control" :class="{ 'is-invalid': errors.city }"/>
                            <div class="invalid-feedback">{{errors.city}}</div>
                        </div>
                        
                    
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                        <button type="submit" class="btn btn-warning" @click="$event => ($emit('save-data'))">Save changes</button>
                        <!-- <button type="submit" class="btn btn-warning">Save changes</button> -->
                    </div>
                </Form>
            </div>
        </div>
    </div>
</template>

<style scoped></style>