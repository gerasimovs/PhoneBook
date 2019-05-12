<template>
    <div>
        <b-field label="First Name">
            <b-input placeholder="e.g Alex" v-model="first_name"></b-input>
        </b-field>

        <b-field label="Last Name">
            <b-input placeholder="e.g Smith" v-model="last_name"></b-input>
        </b-field>

        <b-field label="First Name">
            <div class="control is-clearfix">
                <b-radio v-model="gender" native-value="1">Male</b-radio>
                <b-radio v-model="gender" native-value="2">Female</b-radio>
            </div>
        </b-field>

        <b-field>
            <b-button type="is-primary" @click="submitContact()">
                <span v-if="id">Save</span>
                <span v-else>Create</span>
            </b-button>
        </b-field>
    </div>
</template>

<script>
export default {
    name: 'ContactsForm',
    props: {
        contact: Object,
    },
    data: function () {
        return {
            id: null,
            first_name: null,
            last_name: null,
            gender: null,
        }
    },
    methods: {
        submitContact: function() {
            this.$emit('submit-contact', {
                id: this.id,
                first_name: this.first_name,
                last_name: this.last_name,
                gender: this.gender,
            });
        }
    },
    created: function () {
        if (this.contact) {
            this.id = this.contact.id || null;
            this.first_name = this.contact.first_name || null;
            this.last_name = this.contact.last_name || null;
            this.gender = this.contact.gender || null;
        }
    }
}
</script>