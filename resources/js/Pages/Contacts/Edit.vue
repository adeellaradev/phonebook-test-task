<template>
    <Layout>
        <div class="p-3 create-form">
            <form @submit.prevent="updateContact">
                <div class="row">
                    <div class="col-md-12">
                        <input type="text" class="form-control" id="name" v-model="form.name">
                        <span class="text-danger" v-if="errors.name">{{ errors.name }}</span>
                    </div>
                    <div class="col-md-12">
                        <input type="text" class="form-control" id="phoneNumber" v-model="form.phoneNumber">
                        <span class="text-danger" v-if="errors.phoneNumber">{{ errors.phoneNumber }}</span>
                    </div>
                    <div class="col-md-12">
                        <input type="file" @change="handleFileUpload" class="form-control" id="image">
                        <span class="text-danger" v-if="errors.image">{{ errors.image }}</span>
                        <br>
                        <img v-if="form.imageUrl" :src="form.imageUrl" alt="" class="img-thumbnail" height="100px"
                             width="100px">
                    </div>
                    <div class="col-md-12 mt-2">
                        <input type="hidden" v-model="form.id">
                        <button type="submit" class="btn btn-info" :disabled="processing">
                            {{ processing ? "Processing..." : "Update Contact" }}
                        </button>
                    </div>
                </div>
            </form>
        </div>
    </Layout>
</template>

<script>
import Layout from "../../components/Layout.vue";
import {useForm} from "@inertiajs/vue3";
import image from "../../../../public/assets/avatar.png";

export default {
    name: "Edit",
    props: ['contact'],
    components: {Layout},
    data() {
        return {
            form: useForm({
                id: this.contact.id,
                name: this.contact.name,
                phoneNumber: this.contact.phone_number,
                image: null,
                imageUrl: this.contact.image != null ? "/storage/"+ this.contact.image : null,
            }),
            errors: {},
            processing: false,
        }
    },
    computed:{

    },
    methods: {

        handleFileUpload(event) {
            this.form.image = event.target.files[0];
        },

        updateContact() {
            this.processing = true;
            this.form.post('/contacts/update', {
                onSuccess: () => {
                    window.location.href = "/"
                },
                onError: (errors) => {
                    console.log(errors)
                    this.errors = errors;
                },
                onFinish: () => {

                    this.processing = false;
                },

            })
        }
    }
}
</script>

<style scoped>

</style>
