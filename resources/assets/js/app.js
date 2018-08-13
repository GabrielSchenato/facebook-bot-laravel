require('./bootstrap');

window.Vue = require('vue');

import VueRouter from 'vue-router';
import Vuex from 'vuex';
import VuexStore from './states';
import routes from './routes';
import Loader from './components/Loader';
import Menu from './components/Menu';

Vue.use(VueRouter);
Vue.use(Vuex);

const router = new VueRouter({
    routes
});

const store = new Vuex.Store(VuexStore)

router.beforeEach((to, from, next) => {
  let requiresAuth = to.meta.requiresAuth || false; 
  
  if(requiresAuth){
        return store.dispatch('getCurrentUser').then((res) => {
            if(res.data.id === undefined) {
                return next ({path: 'login'});
            }
            return next();
        });
  }
  return next();
});

const app = new Vue({
    el: '#app',
    components: {
        loader: Loader,
        meuMenu: Menu
    },
    template: `<div><router-view class="container"></router-view><loader></loader><meu-menu></meu-menu></div>`,
    router,
    store
});