import Vue from 'vue'
import App from './App.vue'
import router from './router'

Vue.config.productionTip = false

import "bootstrap/dist/css/bootstrap.min.css";

import { createPinia, PiniaVuePlugin } from 'pinia'
Vue.use(PiniaVuePlugin);
const pinia = createPinia();

new Vue({
  router,
  pinia,
  render: h => h(App),
}).$mount('#app')


