<template>
  <div id="app">
    <div id="nav">
      <router-link to="/"><img src='./assets/logo.png' width='30px'></router-link>
      <router-link to="/aboutus">About us</router-link>
      <router-link to="/signup">Sign up</router-link>
      <router-link to="/signin">Sign in</router-link>
    </div>
    <!-- <button @click="getServerStuff">
        Get
      </button>
      <button @click="setServerStuff">
        Post
      </button>
      <input type="text" v-model="name">
      <input type="text" v-model="lover"> -->
    <router-view class="router-view"/>
  </div>
</template>

<script>
export default {
  data(){
    return {
      name: '',
      lover: ''
    }
  },
  methods: {
    getServerStuff () {
      fetch('http://localhost:8080/friends/backend/api/test.php')
      .then(res => res.json())
      .then(json => {
        this.$root.serverStuff = json
        console.log(json)
      }).catch(error => {
        console.log(error)
      })
    },
    setServerStuff(){
      let formData = new FormData()
      formData.append('name', this.name)
      formData.append('lover', this.lover)
      fetch('http://localhost:8080/friends/backend/api/set.php', {
        method: 'POST',
        body: formData
      })
      .then(res => res.json())
      .then(json => {
        console.log(json)
      }).catch(error => {
        console.log(error)
      })
    }
  }
}
</script>


<style lang="stylus">
@import './assets/global.stylus.styl'

body
  font-family 'Poppins', sans-serif
  background-color tint(brandPink,90%)
  color brandGrey

#app
  display grid
  grid-template-columns repeat(12, 1fr)
  grid-template-rows repeat(10, 1fr)

#nav
  grid-column-start 2
  grid-column-end 12
  grid-row-start 1
  grid-row-end 2
  display grid
  grid-template-columns repeat(12, 1fr)
  justify-items center
  align-items center
  :nth-child(1)
    grid-column-start 1
    grid-column-end 3
  a
    color brandGrey
    text-decoration none
    &.router-link-exact-active
      color brandPink

.router-view
  grid-column-start 2
  grid-column-end 12
  grid-row-start 2
  grid-row-end 10
</style>
