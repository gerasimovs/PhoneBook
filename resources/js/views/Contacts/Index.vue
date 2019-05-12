<template>
    <b-table 
        :data="data" 
        :loading="inProcess"

        hoverable
        mobile-cards>
        
        <template slot="empty">
            <section class="section">
                <div class="content has-text-grey has-text-centered">
                    <p>
                        <b-icon
                            icon="frown-o"
                            size="is-large">
                        </b-icon>
                    </p>
                    <p>Nothing here.</p>
                </div>
            </section>
        </template>

        <template slot-scope="props">
            <b-table-column label="ID" width="40" numeric>
                {{ props.row.id }}
            </b-table-column>
            
            <b-table-column label="First Name">
                {{ props.row.first_name }}
            </b-table-column>
            
            <b-table-column label="Last Name">
                {{ props.row.last_name }}
            </b-table-column>
            
            <b-table-column label="Phone" centered>
                <b-button size="is-small" @click="phoneDialog(props.row.id)">Добавить телефон</b-button>
            </b-table-column>

            <b-table-column label="Gender">
                <template v-if="parseInt(props.row.gender) === 1">Male</template>
                <template v-else-if="parseInt(props.row.gender) === 2">Female</template>
                <template v-else>N/a</template>
            </b-table-column>

            <b-table-column label="Actions">
                <router-link class="button is-info" :to="{ name: 'contacts.edit', params: { 'contact_id': props.row.id }}">
                    <b-icon icon="edit" size="is-small"></b-icon>
                    <span>Edit</span>
                </router-link>
                <b-button type="is-danger" icon-left="trash" @click.prevent="deleteContact(props.row.id)">
                    <span>Delete</span>
                </b-button>
            </b-table-column>
        </template>
    </b-table>
</template>

<script>
import { mapState, mapActions } from 'vuex';

export default {
    name: 'ContactsIndex',
    computed: mapState({
        data: state => state.contacts.all,
        inProcess: state => state.contacts.inProcess,
    }),
    methods: {
        ...mapActions('contacts', [
            'deleteContact',
        ]),
        phoneDialog: function(id) {
            this.$dialog.prompt({
                message: 'What\'s phone number?',
                inputAttrs: {
                    placeholder: 'e.g. +7 (999) 999-99-99',
                },
                onConfirm: (value) => this.$toast.open('In developing!')
            })
        }
    },
    created () {
        this.$store.dispatch('contacts/getAllContacts')
    },
}
</script>
