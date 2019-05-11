<template>
  <div class="signin">
    <input type="text" id="email" v-model="email" placeholder="Email">
    <input type="password" id="userPassword" v-model="userPassword" placeholder="Password">
    <button @click="signInUser">Sign in</button>
  </div>
</template>

<script>
export default {
  data(){
    return {
      email: '',
      userPassword: ''
    }
  },
  methods: {
    signInUser(){
      let formData = new FormData()
      formData.append('email', this.email)
      formData.append('userPassword', this.userPassword)
      fetch('/friends/backend/api/api-signin.php', {
        method: 'POST',
        body: formData,
        credentials: 'include'
      })
      .then(res => res.json())
      .then(json => {
        this.$root.user = json.data
        this.$router.push('/dashboard')
        console.log(json)
      }).catch(error => {

        console.log(error)
      })
    }
  }
}
</script>

<style lang="stylus">

</style>
