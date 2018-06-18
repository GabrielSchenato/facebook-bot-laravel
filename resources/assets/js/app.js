require('./bootstrap');

window.Vue = require('vue');

import VueRouter from 'vue-router';
import routes from './routes';

Vue.use(VueRouter);
const router = new VueRouter({
    routes
});

router.beforeEach((to, from, next) => {
  let requiresAuth = to.meta.requiresAuth || false; 
  
  if(requiresAuth){
        alert("Autenticação");
        return next({path: 'login'});
  }
  return next();
});

const app = new Vue({
    el: '#app',
    template: '<div><router-view class="container"></router-view></div>',
    router
});
