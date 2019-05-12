import axios from 'axios';

let data = [];

export default {
    getContacts: function(callback) {
        axios.get('/api/contacts')
            .then(r => callback(data = r.data.data));
    },

    create: function(contact, callback, errorCallback) {
        const params = new URLSearchParams
        for (let property in contact) {
            params.append(property, contact[property]);
        }

        axios.post('/api/contacts', params)
            .then(r => {
                data.push(r.data.data);
                callback && callback(r.data.data)
            }).catch(e => errorCallback && errorCallback(e));
    },

    edit: function(contact, callback, errorCallback) {
        const params = new URLSearchParams
        for (let property in contact) {
            params.append(property, contact[property]);
        }

        axios.put('/api/contacts/' + contact.id, params)
            .then(r => {
                data.push(r.data.data);
                callback(r.data.data)
            }).catch(e => errorCallback(e));
    },

    show: function(contact, callback, errorCallback) {
        const index = this._getIndex(contact);
        (index >= 0)
            ? callback(data[index])
            : this._show(contact, callback, errorCallback);
    },

    _show: function(contact, callback, errorCallback) {
        axios.get('/api/contacts/' + contact)
            .then(r => {
                data.push(r.data.data);
                callback(r.data.data)
            }).catch(e => errorCallback(e));
    },

    delete: function(contact, callback, errorCallback) {
        axios.delete('/api/contacts/' + contact)
            .then(r => {
                const index = this._getIndex(contact);
                if (index >= 0) {
                    console.log(data);
                    data.splice(index, 1);
                }

                callback(r.data);
            }).catch(e => errorCallback(e));
    },

    _getIndex: function(contact) {
        return data.findIndex(c => parseInt(c.id) === parseInt(contact));
    },
}
