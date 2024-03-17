<script>
export default {
    name: 'EditContact',
        data() {
            return {
                contact: {},
            }
        },
        created() {
            axios
                .get(`/api/contacts/${this.$route.params.id}`)
                .then((res) => {
                    this.product = res.data;
                });
        },
        methods: {
            updateContact() {
                axios
                    .patch(`/api/contacts/edit/${this.$route.params.id}`, this.product)
                    .then((res) => {
                        this.$router.push({ name: 'home' });
                    });
            }
        }
    }
</script>

<template>
    <div>
        <h3>Update Contact</h3>
        <form @submit.prevent="updateContact">
            <div class="update-form">
                <div class="mb-3">
                  <label for="name" class="col-form-label">Name:</label>
                  <input type="text" class="form-control" id="name" v-model="Contact.name" required>
                </div>
                <div class="mb-3">
                  <label for="phoneNum" class="col-form-label">Phone Number:</label>
                  <input type="text" class="form-control" id="phoneNum" v-model="Contact.phone" required>
                </div>
                <div class="mb-3">
                  <label for="email" class="col-form-label">Email:</label>
                  <input type="text" class="form-control" id="email" v-model="Contact.email" required>
                </div>
                <div class="mb-3">
                  <label for="address" class="col-form-label">Address:</label>
                  <textarea class="form-control" id="address" v-model="Contact.address" required></textarea>
                </div>
            </div>
            <div class="button-group">
                <RouterLink class="btn btn-secondary" to="/home">Cancel</RouterLink>
                <button type="submit" class="btn btn-primary">Submit</button>
            </div>
        </form>
    </div>
</template>

<style scoped></style>