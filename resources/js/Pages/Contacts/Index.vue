<template>
    <Layout>
        <div class="search-div p-3">
            <div class="input-div">
                <input type="text"  v-model="searchQuery" placeholder="search..."/>
            </div>
        </div>
        <div class="contacts">
            <div class="px-3 py-2" v-for="contact in filteredContacts">
                <ContactList :contact="contact" ></ContactList>
            </div>
            <div class="px-3 py-2" v-if="contacts.length===0">
                <p>No Contact Found</p>
            </div>
        </div>
    </Layout>
</template>
<script>
import Layout from "../../components/Layout.vue";
import ContactList from "../../components/contacts/ContactList.vue";

export default {
    name: "Index",
    components: {Layout, ContactList},
    props: ['contacts'],
    data() {
        return {
            searchQuery: ''
        };
    },
    computed:{
        filteredContacts() {
            const query = this.searchQuery.toLowerCase();
            return this.contacts.filter(contact =>
                contact.name.toLowerCase().includes(query) // Adjust based on your contact structure
            );
        }
    },
    methods:{
        reArrangeContacts(contactId){
            // Remove the contact from the local contacts array
            this.contacts = this.contacts.filter(contact => contact.id !== contactId);

        }
    }

}
</script>
