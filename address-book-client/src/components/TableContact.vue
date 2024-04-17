

<template>
    <div class="container mt-3">
        <!-- <h1>table contact</h1> -->

        <div class="d-flex justify-content-between align-items-center mb-3">
            <RouterLink class="btn btn-primary" to="/contact/register">Add New</RouterLink>
            
            <!-- search form -->
            <form class="d-flex ms-auto">
                <input class="form-control me-2" id="searchBar" type="search" placeholder="Search" v-model="searchInput" aria-label="Search">
            </form>

            <div class="btn-group">
                <button type="button" class="btn btn-secondary">Sort</button>
                <button type="button" class="btn btn-secondary dropdown-toggle dropdown-toggle-split" data-bs-toggle="dropdown" aria-expanded="false">
                    <span class="visually-hidden">Toggle Dropdown</span>
                </button>
                <ul class="dropdown-menu">
                    <li><a class="dropdown-item" href="#">Asc</a></li>
                    <li><a class="dropdown-item" href="#">Desc</a></li>
                </ul>
            </div>
        </div>

        <table class="table table-hover" id="contactTable">
            <thead class="table-success">
                <tr>
                    <th scope="col">#</th>
                    <th scope="col">Name</th>
                    <th scope="col">Phone</th>
                    <th scope="col">Email</th>
                    <th scope="col">Address</th>
                    <th scope="col">City</th>
                    <th scope="col">Action</th>
                </tr>
            </thead>
            <tbody>
                <tr  v-for="(contact, index) in filteredContacts" :key="contact.id" :class="{ 'fade-in': contactVisible[index] }">
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
        </table>
        <div>
            <nav aria-label="Page navigation example">
                <ul class="pagination">
                    <li class="page-item" v-for="page in pagination.last_page" :key="page">
                        <button class="page-link" :class="{ 'is-active': page === pagination.current_page }" @click="changePage(page)">
                            {{ page }}
                        </button>
                    </li>
                </ul>
            </nav>


        </div>
    </div>

    <EditContact :selectedContact="selectedContact"  @save-data="doEdit" />
    <DeleteContact :deleteContact="deleteContact" @delete-data="doDelete"/>

</template>


<script setup>
import { RouterLink, useRouter } from 'vue-router'
import EditContact from '@/components/EditContact.vue'
import DeleteContact from '@/components/DeleteContact.vue'
import { onMounted } from 'vue';
import { ref, computed, reactive } from 'vue';
import axios from 'axios';
import { Form, Field, useResetForm } from 'vee-validate';


let editModal;
let delModal;

const searchInput = ref('');
const contacts = ref([]);
const pagination = ref({
    current_page: 1,
    last_page: 1,
    per_page: 5,
    // Add other necessary fields
});

const selectedContact = ref({});
const deleteContact = ref({});



onMounted(() => {
    editModal = new bootstrap.Modal(document.getElementById('editModal'));
    delModal = new bootstrap.Modal(document.getElementById('delModal'));
    fetchContacts();
    // successMessage.value = router.currentRoute.value.query.successMessage || '';


})



const fetchContacts = async () => {
    try {
        const response = await axios.get('http://localhost:8000/api/contacts?page=' + pagination.value.current_page);
        if (response.data.success) {
            contacts.value = response.data.data.data.reverse();
            pagination.value.current_page = response.data.data.current_page;
            pagination.value.last_page = response.data.data.last_page;
            // Update other necessary fields
        } else {
            console.error('Error fetching users:', response.data.message);
        }
    } catch (error) {
        console.error('Error fetching users:', error);
    }
};

const editPopup = (contact) => {
    editModal.show();
    selectedContact.value = contact;
    console.log (contact);
    
}

const deletePopup = (contact) => {
    console.log (contact);
    deleteContact.value = contact;
    delModal.show();
}

const doEdit = () => {
    console.log('click has confirm');

    axios.put(`http://localhost:8000/api/contacts/${selectedContact.value.id}`, {
        name: selectedContact.value.name,
        phone: selectedContact.value.phone,
        email: selectedContact.value.email,
        address: selectedContact.value.address,
        city: selectedContact.value.city
    })
    .then(response => {
        console.log(response);
        // handle success
        editModal.hide();
    })
    .catch(error => {
        console.log(error);
        // handle error
    });

    // editModal.hide();
}

const doDelete = () => {
    console.log('click has confirm');
    if (!deleteContact.value) return; // Ensure a contact is selected

    axios.delete(`http://localhost:8000/api/contacts/${deleteContact.value.id}`)
        .then(() => {
            // Delete successful, handle any UI updates or notifications
            console.log('Contact deleted successfully');
        })
        .catch(error => {
            // Handle delete error
            console.error('Error deleting contact:', error);
        })
        .finally(() => {
            // Close the delete modal
            delModal.hide();
        });
}

const changePage = (page) => {
    pagination.value.current_page = page;
    fetchContacts();
};

// for searchInput filter
const filteredContacts = computed(() => {
  const searchQuery = searchInput.value.toLowerCase();
  if (!searchQuery) {
    return contacts.value;
  }
  return contacts.value.filter(
    contact =>
      contact.name.toLowerCase().includes(searchQuery) ||
      contact.email.toLowerCase().includes(searchQuery) ||
      contact.address.toLowerCase().includes(searchQuery) ||
      contact.city.toLowerCase().includes(searchQuery)
  );
});



</script>

<style scoped>
.is-active {
    background-color: #33897E;
    color: white;
}

.not-active {
    color: #33897E;
    background-color: white;
}

.fade-in {
  animation: fadeIn 0.5s ease forwards;
}

@keyframes fadeIn {
  from {
    opacity: 0;
    transform: translateY(20px);
  }
  to {
    opacity: 1;
    transform: translateY(0);
  }
}

</style>

