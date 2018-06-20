require('./bootstrap');

window.Vue = require('vue');

import VueRouter from 'vue-router';
import Vuex from 'vuex';
import VuexStore from './states';
import routes from './routes';

Vue.use(VueRouter);
Vue.use(Vuex);

const router = new VueRouter({
    routes
});

router.beforeEach((to, from, next) => {
  let requiresAuth = to.meta.requiresAuth || false; 
  
  if(requiresAuth){
        return window.axios.get('/api/v1/users/me').then((res) => {
            if(res.data.id === undefined) {
                return next ({path: 'login'});
            }
            return next();
        });
  }
  return next();
});

const store = new Vuex.Store(VuexStore)

const app = new Vue({
    el: '#app',
    template: '<div><router-view class="container"></router-view></div>',
    router,
    store
});
