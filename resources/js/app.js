require('./bootstrap');

import Vue from 'vue';
import Buefy from 'buefy';

import App from './views/App.vue'
import router from './router';
import store from './store'

Vue.use(Buefy, {
    defaultIconPack: "fa"
});

const app = new Vue({
    render: h => h(App),
    router,
    store,
}).$mount('#app')