<template>
    <Layout>
        <div class="p-3 text-start create-form">
            <form @submit.prevent="createContact">
                <div class="row">
                    <div class="col-md-12">
                        <input type="text" class="form-control" id="name" v-model="form.name" placeholder="Name">
                        <span class="text-danger" v-if="errors.name">{{ errors.name }}</span>
                    </div>
                    <div class="col-md-12">
                        <input type="tel" class="form-control" id="phoneNumber" v-model="form.phoneNumber" placeholder="Phone number">
                        <span class="text-danger" v-if="errors.phoneNumber">{{ errors.phoneNumber }}</span>
                    </div>
                    <div class="col-md-12">
                        <input type="file" @change="handleFileUpload" class="form-control" id="image">
                        <span class="text-danger" v-if="errors.image">{{ errors.image }}</span>
                    </div>
                    <div class="col-md-12 mt-2">
                        <button type="submit" class="btn btn-primary" :disabled="processing">
                            {{ processing ? "Processing..." : "Create Contact" }}
                        </button>
                    </div>
                </div>
            </form>
        </div>
    </Layout>
</template>

<script>
import Layout from "../../components/Layout.vue";
import {useForm} from '@inertiajs/vue3'
export default {
    name: "Create",
    components: {Layout},
    data() {
        return {
            form: useForm({
                name: '',
                phoneNumber: '',
                image: null,
            }),
            errors: {},
            processing: false,
        }
    },
    methods: {

        handleFileUpload(event) {
            this.form.image = event.target.files[0];
        },

        createContact() {
            this.processing = true;
            this.form.post('/contacts', {
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
