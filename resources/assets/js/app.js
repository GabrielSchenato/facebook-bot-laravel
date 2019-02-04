require('./bootstrap');

window.Vue = require('vue');

import VueRouter from 'vue-router';
import Vuex from 'vuex';
import VuexStore from './states';
import VueAxios from 'vue-axios';
import VueAuth from '@websanova/vue-auth';
import auth from './auth';
import axios from 'axios';
import routes from './routes';
import Loader from './components/Loader';
import Menu from './components/Menu';

Vue.use(VueRouter);
Vue.use(VueAxios, axios);
Vue.use(Vuex);

axios.defaults.baseURL = `${process.env.MIX_APP_URL}/api`

const router = new VueRouter({
    routes
});

Vue.router = router;

const store = new Vuex.Store(VuexStore);

Vue.use(VueAuth, auth);

const menu = new Vue({
    el: '#menu',
    components: {
        meuMenu: Menu
    },
    template: `<div><meu-menu></meu-menu></div>`,
    router,
    store
});
const app = new Vue({
    el: '#app',
    components: {
        loader: Loader,
        meuMenu: Menu
    },
    template: `<div><router-view class="container"></router-view><loader></loader></div>`,
    router,
    store
});

