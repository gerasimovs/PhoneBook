/**
 * Mocking client-server processing
 */
const _data = [
    { 'id': 1, 'first_name': 'Jesse', 'last_name': 'Simmons', 'created_at': '2016-10-15 13:43:27', 'gender': 'Male' },
    { 'id': 2, 'first_name': 'John', 'last_name': 'Jacobs', 'created_at': '2016-12-15 06:00:53', 'gender': 'Male' },
    { 'id': 3, 'first_name': 'Tina', 'last_name': 'Gilbert', 'created_at': '2016-04-26 06:26:28', 'gender': 'Female' },
    { 'id': 4, 'first_name': 'Clarence', 'last_name': 'Flores', 'created_at': '2016-04-10 10:28:46', 'gender': 'Male' },
    { 'id': 5, 'first_name': 'Anne', 'last_name': 'Lee', 'created_at': '2016-12-06 14:38:38', 'gender': 'Female' }
];

import axios from 'axios';

export default {
    getContacts: function(callback) {
        setTimeout(() => callback(_data), 2500)
    },

    createContacts: function(contacts, callback, errorCallback) {
        setTimeout(() => {
            // simulate random checkout failure.
            (Math.random() > 0.5 || navigator.userAgent.indexOf('PhantomJS') > -1)
                ? callback()
                : errorCallback()
        }, 2500)
    }
}