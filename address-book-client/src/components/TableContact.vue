<template>
    <div class="container mt-3">
      <div class="d-flex justify-content-between align-items-center mb-3">
        <RouterLink class="btn btn-primary" to="/contact/register">Add New</RouterLink>
  
        <!-- Search form -->
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
        <Suspense>
          <template #default>
            <LazyTableContent :contacts="filteredContacts" :editPopup="editPopup" :deletePopup="deletePopup" />
          </template>
          <template #fallback>
            <tbody>
              <!-- <tr>
                <td colspan="7" class="load-text" >Loading...</td>
              </tr> -->
              <LoadAnimate />
            </tbody>
          </template>
        </Suspense>
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

    <!-- <button class="btn btn-primary" @click="notify">Show Toast</button> -->
    <!-- <ToastNotif v-if="showToast" message="This is a toast message!" /> -->
  
    <EditContact :selectedContact="selectedContact" @save-data="doEdit" />
    <DeleteContact :deleteContact="deleteContact" @delete-data="doDelete" />

    
</template>
  
<script setup>
import { RouterLink } from 'vue-router'
import EditContact from '@/components/EditContact.vue'
import DeleteContact from '@/components/DeleteContact.vue'
import { ref, onMounted, computed } from 'vue';
import axios from 'axios';
import { defineAsyncComponent } from 'vue';
import LoadAnimate from '@/components/animations/LoadAnimate.vue'
import { toast } from 'vue3-toastify'
import 'vue3-toastify/dist/index.css';


const editModal = ref(null);
const delModal = ref(null);
const searchInput = ref('');
const contacts = ref([]);
const pagination = ref({
current_page: 1,
last_page: 1,
per_page: 5,
});
const LazyTableContent = defineAsyncComponent(() => import('@/components/TableContent.vue').then(module => {
return new Promise(resolve => {
    setTimeout(() => {
    resolve(module);
    }, 3000); // 3 seconds delay
});
}));

const selectedContact = ref({});
const deleteContact = ref({});

// for Edit Toast Notify
const successEditNotify = () => {
  toast("data successfully Updated. ", {
    autoClose: 1000,
    theme: "colored",
    type: "success",
    position: "bottom-right",
    dangerouslyHTMLString: true
  }); // ToastOptions
};

const failEditNotify = () => {
  toast("data failed to Update. ", {
    autoClose: 1000,
    theme: "colored",
    type: "error",
    position: "bottom-right",
    dangerouslyHTMLString: true
  }); // ToastOptions
};

// for Delete Toast Notify
const successDeleteNotify = () => {
  toast("data successfully Deleted. ", {
    autoClose: 1000,
    theme: "colored",
    type: "success",
    position: "bottom-right",
    dangerouslyHTMLString: true
  }); // ToastOptions
};

const failDeleteNotify = () => {
  toast("data failed to Delete. ", {
    autoClose: 1000,
    theme: "colored",
    type: "error",
    position: "bottom-right",
    dangerouslyHTMLString: true
  }); // ToastOptions
};

onMounted(() => {
  editModal.value = new bootstrap.Modal(document.getElementById('editModal'));
  delModal.value = new bootstrap.Modal(document.getElementById('delModal'));
  fetchContacts();
});

const fetchContacts = async () => {
try {
    const response = await axios.get('http://localhost:8000/api/contacts?page=' + pagination.value.current_page);
    if (response.data.success) {
    contacts.value = response.data.data.data.reverse();
    pagination.value.current_page = response.data.data.current_page;
    pagination.value.last_page = response.data.data.last_page;
    } else {
    console.error('Error fetching contacts:', response.data.message);
    }
} catch (error) {
    console.error('Error fetching contacts:', error);
}
};

const editPopup = (contact) => {
selectedContact.value = contact;
editModal.value.show();
};

const deletePopup = (contact) => {
deleteContact.value = contact;
delModal.value.show();
};

const doEdit = () => {
axios.put(`http://localhost:8000/api/contacts/${selectedContact.value.id}`, {
    name: selectedContact.value.name,
    phone: selectedContact.value.phone,
    email: selectedContact.value.email,
    address: selectedContact.value.address,
    city: selectedContact.value.city
})
.then(response => {
    console.log(response);
    editModal.value.hide();
    successEditNotify();
    fetchContacts();
})
.catch(error => {
    console.error('Error editing contact:', error);
    failEditNotify();
});
};

const doDelete = () => {
if (!deleteContact.value) return; // Ensure a contact is selected
axios.delete(`http://localhost:8000/api/contacts/${deleteContact.value.id}`)
    .then(() => {
    // Handle delete success
    console.log('Contact deleted successfully');
    fetchContacts();
    successDeleteNotify();
    })
    .catch(error => {
      console.error('Error deleting contact:', error);
      failDeleteNotify();
    })
    .finally(() => {
      delModal.value.hide();
    });
};

const changePage = (page) => {
pagination.value.current_page = page;
fetchContacts();
};

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

/* .load-text {
text-align: center;
} */
</style>
  