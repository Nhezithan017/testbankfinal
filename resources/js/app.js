/**
 * First we will load all of this project's JavaScript dependencies which
 * includes Vue and other libraries. It is a great starting point when
 * building robust, powerful web applications using Vue and Laravel.
 */

require('./bootstrap');
window.$ = require('jquery');
window.JQuery = require('jquery');
window.Vue = require('vue');

import Vue from 'vue';
import Vuetify from 'vuetify';

Vue.use(Vuetify);

import vSelect from 'vue-select';
Vue.component('v-select', vSelect);
import DepartmentEditor from './components/Department/Department.vue';

import BootstrapVue from 'bootstrap-vue';

Vue.use(BootstrapVue)


// import VueRouter from 'vue-router';
// import { routes } from './routes';


// Vue.use(VueRouter);


//  const router = new VueRouter({
//     mode: 'history',
//     base: 'dept-editor',
//     routes
// });

/**
 * The following block of code may be used to automatically register your
 * Vue components. It will recursively scan this directory for the Vue
 * components and automatically register them with their "basename".
 *
 * Eg. ./components/ExampleComponent.vue -> <example-component></example-component>
 */

// const files = require.context('./', true, /\.vue$/i);
// files.keys().map(key => Vue.component(key.split('/').pop().split('.')[0], files(key).default));


// Vue.component('courses-all', require('./components/Department/Department.vue').default);
Vue.component('department-editor', require('./components/DepartmentEditor.vue').default);


// Vue.component('add-user', require('./components/User/AddUser.vue').default);


/**
 * Next, we will create a fresh Vue application instance and attach it to
 * the page. Then, you may begin adding components to this application
 * or customize the JavaScript scaffolding to fit your unique needs.
 */


const app = new Vue({
    el: '#app',
    
});
