import contacts from '../../api/contacts';
import router from '../../router';

export default {
    namespaced: true,

    // initial state
    state: {
        all: [],
        selected: null,
        inProcess: false,
    },

    // getters
    getters: {},

    // actions
    actions: {
        getAllContacts: function({commit}) {
            commit('setProcess', true);

            contacts.getContacts(data => {
                commit('setContacts', data)
                commit('setProcess', false);
            });
        },
        findContact: function({commit}, contactId) {
            commit('setProcess', true);

            contacts.show(contactId, contact => {
                commit('setProcess', false);
                commit('setSelected', contact);
            }, error => {
                console.log(error);
            });
        },
        createContact: function({commit}, contactData) {
            commit('setProcess', true);

            contacts.create(contactData, result => {
                commit('setProcess', false);
                router.push({path: '/'});
            }, error => {
                console.log(error);
            });
        },
        editContact: function({commit}, contactData) {
            commit('setProcess', true);

            contacts.edit(contactData, result => {
                commit('setProcess', false);
                router.push({path: '/'});
            }, error => {
                console.log(error);
            });
        },
        deleteContact: function({commit}, contactId) {
            commit('setProcess', true);

            contacts.delete(contactId, result => {
                commit('setProcess', false);
                router.push({path: '/'});
            }, error => {
                console.log(error);
            });
        },
    },

    // mutations
    mutations: {
        setContacts (state, data) {
            state.all = data;
        },
        setSelected (state, data) {
            state.selected = data;
        },
        setProcess (state, bool) {
            state.inProcess = bool;
        },
    }
}
