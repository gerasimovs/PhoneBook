<template>
    <div>
        <h5>Create contact</h5>
        <contact-form
            v-on:submit-contact="createContact($event)"
        ></contact-form>
        <b-loading :is-full-page="false" :active.sync="inProcess" :can-cancel="false"></b-loading>
    </div>
</template>

<script>
import { mapState, mapActions } from 'vuex';
import ContactForm from './_form';

export default {
    name: 'ContactsCreate',
    components: {
        ContactForm
    },
    computed: mapState({
        inProcess: state => state.contacts.inProcess,
    }),
    methods: mapActions('contacts', [
        'createContact'
    ]),
}
</script>
