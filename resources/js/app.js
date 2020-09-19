/**
 * First we will load all of this project's JavaScript dependencies which
 * includes Vue and other libraries. It is a great starting point when
 * building robust, powerful web applications using Vue and Laravel.
 */

require('./bootstrap');

window.Vue = require('vue');


import Vuetify from 'vuetify';
import 'vuetify/dist/vuetify.min.css';
import router from './router';
import Vuelidate from 'vuelidate'





Vue.use(Vuetify);
Vue.use(Vuelidate);
/**
 * The following block of code may be used to automatically register your
 * Vue components. It will recursively scan this directory for the Vue
 * components and automatically register them with their "basename".
 *
 * Eg. ./components/ExampleComponent.vue -> <example-component></example-component>
 */

// const files = require.context('./', true, /\.vue$/i)
// files.keys().map(key => Vue.component(key.split('/').pop().split('.')[0], files(key).default))

// Vue.component('example-component', require('./components/ExampleComponent.vue').default);
// Vue.component('store-edit', require('./components/store/StoreEdit.vue').default);
Vue.component('store-image', require('./components/store/storeTopImage.vue').default);
Vue.component('store-item', require('./components/store/storeItem.vue').default);
Vue.component('store-edit', require('./components/store/storeEdit.vue').default);
Vue.component('Header', require('./components/topPage/Header.vue').default);
Vue.component('top-image', require('./components/topPage/topImage.vue').default);
Vue.component('top-newstores', require('./components/topPage/newStores.vue').default);
Vue.component('top-howuse', require('./components/topPage/howUse.vue').default);
Vue.component('Footer', require('./components/topPage/Footer.vue').default);
Vue.component('storeitem-component', require('./components/StoreItemComponent.vue').default);
// Vue.component('form-component', require('./components/form.vue').default);

/**
 * Next, we will create a fresh Vue application instance and attach it to
 * the page. Then, you may begin adding components to this application
 * or customize the JavaScript scaffolding to fit your unique needs.
 */

const app = new Vue({
    el: '#app',
    vuetify: new Vuetify(),
    router,
    Vuelidate,
    
});

