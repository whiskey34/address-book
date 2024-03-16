<script>
import { Modal } from "bootstrap";
import axios from  'axios';
// import ModalEdit from '@/components/ModalEdit.vue';


export default {
    name:"TableContact",
    // components: {
    //   ModalEdit,
    // },
    data(){
      return {
        uniqueModal:null,
        contacts: [],
        searchQuery: '',
        newContact: {
          name: '',
          phone: '',
          email: '',
          address: ''
        },
        editedContact: {},
        // selectedContact: null,
      };
    },
    mounted() {
      this.fetchContacts();
    },
    
    methods:
    {
      showUniqueModal() {
        this.uniqueModal = new Modal(document.getElementById("addModal"), { backdrop: 'static' });
        // this.uniqueModal = new Modal(document.getElementById("editModal"),{ keyboard: false });
        this.uniqueModal.show();
        },
      closeUniqueModal() {
        this.uniqueModal.hide();
      },
      fetchContacts() {
        axios.get('/api/contacts')
          .then(response => {
            this.contacts = response.data;
          })
          .catch(error => {
            console.error('Error fetching contacts:', error);
          });
      },
      search() {
        // Search logic
      },

      updateContact() {
        
        // console.log('Form submitted');
        axios.put(`/api/contacts/edit/${this.editedContact.id}`, this.editedContact)
          .then(response => {
            console.log('Contact updated successfully:', response.data);
            this.fetchContacts(); // Refresh the contact list
            this.closeUniqueModal(); // Close the modal
          })
          .catch(error => {
            console.error('Error updating contact:', error);
          });
      },

      deleteContact(id) {
        if (confirm("Are you sure you want to delete this contact?")) {
            axios.delete(`/api/contacts/drop/${id}`)
                .then(response => {
                    console.log(response.data);
                    this.fetchContacts(); 
                })
                .catch(error => {
                    console.error('Error deleting contact:', error);
                });
        }
      },

      saveContact() {
        // console.log('Form submitted');
        axios.post('/api/contacts/add', this.newContact)
          .then(response => {
            console.log('Contact saved successfully:', response.data);
            
            this.fetchContacts(); 
            this.clearForm(); 
            this.closeUniqueModal(); // Close the modal using Vue's data binding
          })
          .catch(error => {
            console.error('Error saving contact:', error);
            
          });
        
      },
      clearForm() {
        // Clear form fields
        this.newContact = {
          name: '',
          phone: '',
          email: '',
          address: ''
        };
      }
    },


};
</script>

<template>
    <div class="container">
        <div class="md-auto mt-3 row align-items-center">
          <div class="col-auto">
            <button class="btn btn-primary d-inline-block" data-bs-toggle="modal" data-bs-target="#addModal">Add New Contact</button>
          </div>
          
          <div class="col">
            <form class="d-flex justify-content-end">
              <input class="form-control me-2 custom-search" type="search" placeholder="Search" aria-label="Search">
            </form>
          </div>
        </div>

        <!-- table -->
        <div class="contact-table mt-3">
            <div class="row justify-content-center">
                <div class="col-md-12">
                    <table class="table table-hover table-bordered">
                        <thead>
                            <tr>
                                <th>#</th>
                                <th>Name</th>
                                <th>Phone</th>
                                <th>Email</th>
                                <th>Address</th>
                                <th>Action</th>
                            </tr>
                        </thead>
                        <tbody>
                            <tr v-for="(contact, index) in contacts" :key="contact.id">
                                <td>{{ index + 1 }}</td>
                                <!-- <td>{{ contact.id }}</td> -->
                                <td>{{ contact.name }}</td>
                                <td>{{ contact.phone }}</td>
                                <td>{{ contact.email }}</td>
                                <td>{{ contact.address }}</td>
                                <td>
                                  <button type="button" class="btn btn-warning" data-bs-toggle="modal" data-bs-target="#editModal">Edit</button> |
                                  <button type="button" class="btn btn-danger" @click="deleteContact(contact.id)">Delete</button>
                                </td>
                            </tr>
                        </tbody>
            
                    </table>
                </div>
            </div>
        </div>
    </div>

     <!-- Modal component -->
    <div class="modal fade" id="addModal" tabindex="-1" aria-labelledby="addModalLabel" aria-hidden="true">
      <div class="modal-dialog">
        <div class="modal-content">
          <div class="modal-header">
            <h1 class="modal-title fs-5" id="exampleModalLabel">Add New Contact</h1>
            <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
          </div>
          <form @submit.prevent="saveContact">
            <div class="modal-body">
                <div class="mb-3">
                  <label for="name" class="col-form-label">Name:</label>
                  <input type="text" class="form-control" id="name" v-model="newContact.name" required>
                </div>
                <div class="mb-3">
                  <label for="phoneNum" class="col-form-label">Phone Number:</label>
                  <input type="text" class="form-control" id="phoneNum" v-model="newContact.phone" required>
                </div>
                <div class="mb-3">
                  <label for="email" class="col-form-label">Email:</label>
                  <input type="text" class="form-control" id="email" v-model="newContact.email" required>
                </div>
                <div class="mb-3">
                  <label for="address" class="col-form-label">Address:</label>
                  <textarea class="form-control" id="address" v-model="newContact.address" required></textarea>
                </div>
              
            </div>
            <div class="modal-footer">
              <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
              <button type="submit" class="btn btn-primary">Save</button>
            </div>
          </form>
        </div>
      </div>
    </div>

    <!-- Update Modal -->
    <div class="modal fade" id="editModal" tabindex="-1" aria-labelledby="editModalLabel" aria-hidden="true">
      <div class="modal-dialog">
        <div class="modal-content">
          <div class="modal-header">
            <h1 class="modal-title fs-5" id="editModalLabel">Edit Contact</h1>
            <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
          </div>
          <form @submit.prevent="updateContact">
            <div class="modal-body">
              <div class="mb-3">
                <label for="name" class="col-form-label">Name:</label>
                <input type="text" class="form-control" id="name" v-model="Contacts.name">
              </div>
              <div class="mb-3">
                <label for="phoneNum" class="col-form-label">Phone Number:</label>
                <input type="text" class="form-control" id="phoneNum" v-model="Contacts.phone">
              </div>
              <div class="mb-3">
                <label for="email" class="col-form-label">Email:</label>
                <input type="text" class="form-control" id="email" v-model="Contacts.email">
              </div>
              <div class="mb-3">
                <label for="address" class="col-form-label">Address:</label>
                <textarea class="form-control" id="address" v-model="Contacts.address"></textarea>
              </div>
            </div>
            <div class="modal-footer">
              <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cancel</button>
              <button type="submit" class="btn btn-primary">Save changes</button>
            </div>
          </form>
        </div>
      </div>
    </div>

</template>

<style scoped>
.custom-search {
        width: 300px;
    }
</style>