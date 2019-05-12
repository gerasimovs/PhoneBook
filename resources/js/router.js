const PageTitle = 'PhoneBook SPA';
import Vue from 'vue';
import VueRouter from 'vue-router'

Vue.use(VueRouter);

import ContactsIndex from './views/Contacts/Index';
import ContactsCreate from './views/Contacts/Create';
import ContactsShow from './views/Contacts/Show';
import ContactsEdit from './views/Contacts/Edit';

const router = new VueRouter({
    linkActiveClass: 'is-active',
    mode: 'history',
    base: '/',

    // routes
    routes: [
        {
            path: '/',
            name: 'contacts.index',
            component: ContactsIndex,
        },
        {
            path: '/create',
            name: 'contacts.create',
            component: ContactsCreate,
            meta: {
                title: 'Contact create'
            },
        },
        {
            path: '/:contact_id',
            name: 'contacts.show',
            component: ContactsShow,
            meta: {
                title: 'Contact show'
            },
        },
        {
            path: '/:contact_id/edit',
            name: 'contacts.edit',
            component: ContactsEdit,
            meta: {
                title: 'Contact edit'
            },
        },
        {
            path: '*',
            redirect: '/',
        }
    ],
});

router.beforeEach((to, from, next) => {
    if (to.hasOwnProperty('meta') && to.meta.hasOwnProperty('title')) {
        document.title = to.meta.title + ' - ' + PageTitle;
    } else {
        document.title = PageTitle;
    }
    next();
});

export default router;