require('./bootstrap');

window.Vue = require('vue');

import Vue from 'vue';


import VueSweetalert2  from 'vue-sweetalert2' ;
import 'sweetalert2/dist/sweetalert2.min.css' ;

Vue.use(VueSweetalert2);

import example from './components/ExampleComponent.vue';
import ListaTareas from './components/ListaTareas.vue';

Vue.component('example-component', example);
Vue.component('lista-tareas',ListaTareas);





const app = new Vue({
    el: '#app',
});
