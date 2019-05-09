<template>
  <div id="app">
    <div v-if="this.$route.name !== 'signin'" class="topRightBlob1"></div>
    <div v-if="this.$route.name !== 'signin'" class="topRightBlob2"></div>
    <div id="nav">
      <div><router-link to="/"><img src='./assets/logo.png' width='30px'></router-link></div>
      <div class="navRight">
        <div><router-link to="/aboutus">About us</router-link></div>
        <div><router-link to="/signup">Sign up</router-link></div>
        <div><router-link to="/signin">Sign in</router-link></div>
      </div>
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
</style>
