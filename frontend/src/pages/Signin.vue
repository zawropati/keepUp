<template>
  <div class="signin">
    <input type="text" id="email" v-model="email" placeholder="Email">
    <input type="password" id="userPassword" v-model="userPassword" placeholder="Password">
    <button @click="signInUser">Sign in <img class="arrow" src='../assets/arrow-right-solid.svg'></button>
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
.signin
  display flex
  flex-direction column
  padding-top 150px

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
