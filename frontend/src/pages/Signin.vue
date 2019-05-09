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
        this.getAllFriends()
        console.log(json)
      }).catch(error => {

        console.log(error)
      })
    },
    getAllFriends(){
      fetch('/friends/backend/api/api-get-all-friends.php', {
        method: 'GET',
        credentials: 'include'
      })
      .then(res => res.json())
      .then(json => {
        console.log(json)
        //check if its 1
        this.$root.friends = json.data
      }).catch(error => {

        console.log(error)
      })
    }

  }
}
</script>

<style lang="stylus">

</style>
