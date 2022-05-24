/**
 * First we will load all of this project's JavaScript dependencies which
 * includes Vue and other libraries. It is a great starting point when
 * building robust, powerful web applications using Vue and Laravel.
 */

/**
 * Next, we will create a fresh Vue application instance and attach it to
 * the page. Then, you may begin adding components to this application
 * or customize the JavaScript scaffolding to fit your unique needs.
 */



require('./bootstrap');
window.Vue = require('vue').default;

import "../css/app.css"
import { createApp } from "vue"
import VueAxios from 'vue-axios';
import axios from 'axios';

const app = createApp({

});

app.component('campaign-component', require('./components/CampaignComponent.vue').default);
app.component('creative-component', require('./components/CreativeComponent.vue').default);

app.use(VueAxios, axios);
app.mount('#app');