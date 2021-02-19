import VueRouter from 'vue-router';
import App from './components/App';
import Api from './mixins/api.js';

/**
 * First we will load all of this project's JavaScript dependencies which
 * includes Vue and other libraries. It is a great starting point when
 * building robust, powerful web applications using Vue and Laravel.
 */
require('./bootstrap');

window.Vue = require('vue');

Vue.use(VueRouter);

const router = new VueRouter({
    mode: 'history',
    routes: [
        {
            path: '/',
            name: 'home',
            component: App,
        }
    ]
});

new Vue({
    el: '#app',
    router: router,
    data() {
        return {
            showModal: {
                addProduct: false,
                login: false
            },
            isLoggedIn: localStorage.getItem('access_token') || null,
            token: localStorage.getItem('access_token') || '',
        }
    },
    methods: {
        logout() {
            var $this = this;
            this.api('/api/logout')
                .setAuth(this.token)
                .post(function(response) {
                    localStorage.removeItem('access_token');
                    $this.isLoggedIn = false;
                }, function(error) {
                    localStorage.removeItem('access_token');
                    $this.isLoggedIn = false;
                });
        }
    },
    watch: {
        token: function(value) {
            localStorage.setItem('access_token', value);
        }
    },
    mixins: [Api]
});
