<script setup>
import { ref, defineProps } from 'vue';

const props = defineProps({
  deleteContact: Object, // Prop to receive the contact data
});

</script>

<template>
    <div class="modal fade" id="delModal" tabindex="-1" aria-labelledby="delModalLabel" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h1 class="modal-title fs-5" id="delModalLabel">Delete Contact</h1>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    Are you sure wants to delete this contact ? ...
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cancel</button>
                    <button type="submit" class="btn btn-danger" @click="$event => ($emit('delete-data'))">Delete</button>
                    <!-- <button type="button" class="btn btn-danger" @click="confirmDelete">Delete</button> -->
                </div>
            </div>
        </div>
    </div>
</template>

<style scoped></style>