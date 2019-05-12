import Vue from 'vue';
import Vuex from 'vuex';

Vue.use(Vuex);

import contacts from './modules/contacts';

const debug = process.env.NODE_ENV !== 'production';

export default new Vuex.Store({
    modules: {
        contacts
    },
    strict: debug
})