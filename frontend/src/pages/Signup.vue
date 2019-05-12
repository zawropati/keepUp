<template>
  <div class="signup" v-if="!submitted">
    <input type="text" id="firstName" v-model="firstName" placeholder="First name">
    <input type="text" id="lastName" v-model="lastName" placeholder="Last name">
    <input type="text" id="email" v-model="email" placeholder="Email">
    <input type="password" id="userPassword" v-model="userPassword" placeholder="Password">
    <button @click="signUpUser">Sign up <img class="arrow" src='../assets/arrow-right-solid.svg'> </button>
  </div>
  <div v-else>
    <p>One step closer to nurture your relationships. You can find the Log in button in the right upper corner.</p>
  </div>
</template>

<script>
export default {
  data(){
    return {
      email: '',
      userPassword: '',
      firstName: '',
      lastName:'',
      submitted: false
    }
  },
  methods: {
    signUpUser(){
      let formData = new FormData()
      formData.append('firstName', this.firstName)
      formData.append('lastName', this.lastName)
      formData.append('email', this.email)
      formData.append('userPassword', this.userPassword)
      fetch('/friends/backend/api/api-signup.php', {
        method: 'POST',
        body: formData
      })
      .then(res => res.json())
      .then(json => {
        this.submitted=true
        console.log(json)
      }).catch(error => {

        console.log(error)
      })
    }
  },
}
</script>

<style lang="stylus">
@import '.././assets/global.stylus.styl'

.signup
  display flex
  flex-direction column
  padding-top 100px

  input
    padding 15px
    width 300px
    margin-bottom 30px
    border-radius 25px
    border 3px white solid
    background-color white
    outline none
    box-shadow 3px 6px 19px -10px #ccc
    color #565051

  button
    padding 15px
    margin-bottom 20px
    // border-radius 25px
    background-color transparent
    border none
    color #565051
    font-weight bold
    width 50%
    align-self center
    cursor pointer

    .arrow
      width 20px
      position relative
      top 8px
      left 3px
      color white

::placeholder
  color #565051

</style>
