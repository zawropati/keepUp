<template>
  <div class="signup" v-if="!submitted">
    <input type="text" id="firstName" v-model="firstName" placeholder="First name">
    <input type="text" id="lastName" v-model="lastName" placeholder="Last name">
    <input type="text" id="email" v-model="email" placeholder="Email">
    <input type="password" id="userPassword" v-model="userPassword" placeholder="Password">
    <button @click="signUpUser">Sign up</button>
  </div>
  <div v-else>
    <p>One step closer to nurture your relationships.</p>
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
  padding-top 80px

  input
    padding 10px
    width 300px
    margin-bottom 20px
    border-radius 25px
    border 3px white solid
    background transparent
    outline none

  button
    padding 10px
    margin-bottom 20px
    border-radius 25px
    background-color brandGreen
    border none
    color white
    font-weight bold

</style>
