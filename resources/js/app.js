require('./bootstrap');

require('alpinejs');

import Vue from 'vue';
import VueRouter from 'vue-router';
import {routes} from './routes';
import 'bootstrap'
import 'bootstrap/dist/css/bootstrap.min.css'
import App from './components/app'

import Vuex from 'vuex'

Vue.use(Vuex)

import VueMaterial from 'vue-material'
import 'vue-material/dist/vue-material.min.css'
import 'vue-material/dist/theme/default.css'

Vue.use(VueMaterial)

Vue.use(VueRouter);

import store from './store'

const router = new VueRouter({
    mode: 'history',
    routes
})

const app = new Vue({
    store,
    router,
    components:{App}
}).$mount('#app');
