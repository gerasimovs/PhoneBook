<template>
    <div>
        <h5>Edit contact #{{ $route.params.contact_id }}</h5>
        <contact-form
            :contact="data"
            v-on:submit-contact="editContact($event)"
            v-if="data"
        ></contact-form>
        <b-loading :is-full-page="false" :active.sync="inProcess" :can-cancel="false"></b-loading>
    </div>
</template>

<script>
import { mapState, mapActions } from 'vuex';
import ContactForm from './_form';

export default {
    components: {
        ContactForm
    },
    computed: mapState({
        data: state => state.contacts.selected,
        inProcess: state => state.contacts.inProcess,
    }),
    methods: mapActions('contacts', [
        'findContact',
        'editContact'
    ]),
    created: function() {
        this.findContact(
            this.$route.params.contact_id
        );
    }
}
</script>
