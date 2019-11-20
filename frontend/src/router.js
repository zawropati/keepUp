import Vue from 'vue'
import Router from 'vue-router'
import Landing from './pages/Landing.vue'
import Signin from './pages/Signin.vue'
import Signup from './pages/Signup.vue'
import Dashboard from './pages/Dashboard.vue'
import Friend from './pages/Friend.vue'
import Settings from './pages/Settings.vue'

Vue.use(Router)

export default new Router({
  mode: 'history',
  base: process.env.BASE_URL,
  routes: [
    {
      path: '/',
      name: 'landing',
      component: Landing
    },
    {
      path: '/signin',
      name: 'signin',
      component: Signin
    },
    {
      path: '/signup',
      name: 'signup',
      component: Signup
    },
    {
      path: '/dashboard',
      name: 'dashboard',
      component: Dashboard
    },
    {
      path: '/friend/:id',
      name: 'friend',
      component: Friend
    },
    {
      path: '/settings',
      name: 'settings',
      component: Settings
    }
  ]
})
