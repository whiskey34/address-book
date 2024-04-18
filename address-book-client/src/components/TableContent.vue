<template>
    <tbody>
      <tr v-for="(contact, index) in contacts" :key="contact.id">
        <th scope="row">{{ index + 1 }}</th>
        <td>{{ contact.name }}</td>
        <td>{{ contact.phone }}</td>
        <td>{{ contact.email }}</td>
        <td>{{ contact.address }}</td>
        <td>{{ contact.city }}</td>
        <td>
          <a class="btn btn-warning" @click="editPopup(contact)">Edit</a> |
          <a class="btn btn-danger" @click="deletePopup(contact)">Delete</a>
        </td>
      </tr>
    </tbody>
  </template>
  
  <script setup>
  import { defineProps } from 'vue';
  
  const { contacts, editPopup, deletePopup } = defineProps(['contacts', 'editPopup', 'deletePopup']);
  </script>
  