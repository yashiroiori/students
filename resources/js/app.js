import Vue from 'vue';
import { createInertiaApp } from '@inertiajs/inertia-vue';
import { BootstrapVue, IconsPlugin } from 'bootstrap-vue';
// Import Bootstrap an BootstrapVue CSS files (order is important)
// import 'bootstrap/dist/css/bootstrap.css';
import 'bootstrap-vue/dist/bootstrap-vue.css';
// Make BootstrapVue available throughout your project
Vue.use(BootstrapVue);
// Optionally install the BootstrapVue icon components plugin
Vue.use(IconsPlugin);
import Layout from './Template/Layout';
Vue.component('Layout',Layout);

window.Swal = require('sweetalert2');
window.Swal = Swal.mixin({
    customClass: {
        confirmButton: 'btn btn-success ml-1',
        cancelButton: 'btn btn-danger mr-1'
    },
    buttonsStyling: false,
    reverseButtons: true,
    allowOutsideClick: () => !Swal.isLoading(),
});
window.Toast = Swal.mixin({
    toast: true,
    position: 'top',
    showConfirmButton: false,
    timer: 6000,
});
import '@sweetalert2/theme-bootstrap-4/bootstrap-4.scss';

Vue.mixin({
    methods: {
        route: (name, params, absolute) => route(name, params, absolute, Ziggy),
    }
});

createInertiaApp({
    resolve: name => require(`./Pages/${name}`),
    setup({ el, App, props }) {
        new Vue({
            render: h => h(App, props),
        }).$mount(el)
    },
});