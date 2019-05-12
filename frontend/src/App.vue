<template>
  <div id="app">
    <div v-if="this.$route.name !== 'signin'" class="topRightBlob1"></div>
    <div v-if="this.$route.name !== 'signin'" class="topRightBlob2"></div>
    <div id="nav">
      {{$root.user}}
      <div><router-link to="/"><p class="logo">FriendTimacy</p></router-link></div>
      <div class="navRight">
        <div v-if="!$root.user"><router-link to="/aboutus">About us</router-link></div>
        <div v-if="!$root.user"><router-link to="/signup">Sign up</router-link></div>
        <div v-if="!$root.user"><router-link to="/signin">Sign in</router-link></div>
        <div v-if="$root.user" @click="signout"><router-link to="/">Sign out</router-link></div>
      </div>
    </div>
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
  created(){
    this.getCurrentUser()
  },
  methods: {
    getCurrentUser(){
      fetch('/friends/backend/api/api-get-current-user.php', {
        method: 'GET'
      })
      .then(res => res.json())
      .then(json => {
        if(json.status = 1){
          this.$root.user = json.data
        }
        console.log(json)
      }).catch(error => {
        console.log(error)
      })
    },
    signout(){
      fetch('/friends/backend/api/api-signout.php', {
        method: 'GET'
      })
      .then(res => res.json())
      .then(json => {
        this.$root.user = ''
        console.log(json)
      }).catch(error => {
        console.log(error)
      })
    }
    // getServerStuff () {
    //   fetch('http://localhost:8080/friends/backend/api/test.php')
    //   .then(res => res.json())
    //   .then(json => {
    //     this.$root.serverStuff = json
    //     console.log(json)
    //   }).catch(error => {
    //     console.log(error)
    //   })
    // },
    // setServerStuff(){
    //   let formData = new FormData()
    //   formData.append('name', this.name)
    //   formData.append('lover', this.lover)
    //   fetch('http://localhost:8080/friends/backend/api/set.php', {
    //     method: 'POST',
    //     body: formData
    //   })
    //   .then(res => res.json())
    //   .then(json => {
    //     console.log(json)
    //   }).catch(error => {
    //     console.log(error)
    //   })
    // }
  }
}
</script>


<style lang="stylus">
@import './assets/global.stylus.styl'

body
  font-family 'Poppins', sans-serif
  background-color tint(brandPink,90%)
  color brandGrey
  margin 0px

#app
  min-height 100vh
  display flex
  flex-direction column
  align-items center
  margin 0px 40px 20px 40px

#nav
  display flex
  align-items center
  z-index 10
  width 90%
  padding-top 35px
  padding-bottom 30px
  font-size 14px
  flex 0

  div
    width 50%

  a
    color brandGrey
    text-decoration none
    &.router-link-exact-active
      color brandPink

.logo
  color brandPink
  margin 0px
  font-weight bold
  letter-spacing 2px

.navRight
  display flex
  flex-direction row
  align-items space between

  > div
    text-align center

  :first-child
    text-align left

  :last-child
    text-align right

.router-view
  flex-grow 1

.topRightBlob1
  z-index 9
  background-image url('./assets/blob-shape.svg')
  width 400px
  height 400px
  position absolute
  top -179px
  right -127px
  background-size contain
  background-repeat no-repeat
  transform rotate(77deg)
  pointer-events none

.topRightBlob2
  background-image url('./assets/blob-shape2.svg')
  width 400px
  height 400px
  position absolute
  top -172px
  right -113px
  background-size contain
  background-repeat no-repeat
  transform rotate(77deg)
  pointer-events none

</style>
