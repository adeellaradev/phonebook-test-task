<template>
    <div class="d-flex justify-content-between align-items-center">
        <div class="d-flex align-items-center gap-4">
            <img
                :src="getImageUrl"
                alt="profile-image"
                width="50px"
                height="50px"
            />
            <div class="text-start">
                <h4 class="name">{{ contact.name }}</h4>
                <h6 class="status">{{ contact.phone_number }}</h6>
            </div>
        </div>
        <div>
            <a :href="editURL"><span class="text-white px-3"><i class="bi bi-pen"></i></span></a>
            <span class="text-danger" @click="deleteContact"><i class="bi bi-trash"></i></span>
        </div>
    </div>
    <hr class="my-2"/>
</template>

<script>
import image from "../../../../public/assets/avatar.png";
import Swal from 'sweetalert2';

export default {
    name: "ContactList",
    props: ['contact'],
    computed: {
        editURL() {
            return "/contacts/" + this.contact.id;
        }, getImageUrl() {
            return this.contact.image != null ? "storage/"+ this.contact.image : image;
        },
    },
    methods: {

        async deleteContact(contactId) {
            // Show SweetAlert2 confirmation dialog
            const result = await Swal.fire({
                title: 'Are you sure?',
                text: "You won't be able to revert this!",
                icon: 'warning',
                showCancelButton: true,
                confirmButtonColor: '#3085d6',
                cancelButtonColor: '#d33',
                confirmButtonText: 'Yes, delete it!',
                cancelButtonText: 'Cancel',
                width: '300px',
            });

            if (result.isConfirmed) {
                try {
                    const contactId = this.contact.id;
                    await axios.delete(`/contacts/${contactId}`, {
                        headers: {
                            'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').getAttribute('content'),
                        }
                    });
                    window.location.reload();
                } catch (error) {
                    console.error('Error deleting contact:', error);
                    Swal.fire(
                        'Error!',
                        'There was an error deleting the contact.',
                        'error'
                    );
                }
            }
        }
    }
}
</script>

<style scoped>

</style>
