import Vue from 'vue'
import App from './App.vue'
import router from './router'
import './registerServiceWorker'

Vue.config.productionTip = false

new Vue({
  data: {
    user: '',
    friends: []
  },
  router,
  render: h => h(App)
}).$mount('#app')
