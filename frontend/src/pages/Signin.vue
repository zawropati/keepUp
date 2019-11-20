<template>
  <div class="signin">
    <input type="text" id="email" v-model="email" placeholder="Email">
    <input type="password" id="userPassword" v-model="userPassword" placeholder="Password">
    <button @click="signInUser">Sign in</button>
    <div v-if="errorModal == true" @click="errorModal = false" class="greyLayer"></div>
    <div v-if="errorModal == true" class="modalContainer">
        <div class="modal">
            <img class="closeIcon" @click="errorModal = false" src="https://img.icons8.com/dotty/80/000000/cancel.png">
          <img src="https://img.icons8.com/dotty/80/000000/box-important.png">
            <h1> {{message}} </h1>
        </div> 
    </div>
  </div>
</template>

<script>
export default {
  data(){
    return {
      email: '',
      userPassword: '',
      message: '',
      errorModal: false
    }
  },
  methods: {
    signInUser(){
      let formData = new FormData()
      formData.append('email', this.email)
      formData.append('userPassword', this.userPassword)
      fetch('/api/api-signin.php', {
        method: 'POST',
        body: formData,
        credentials: 'include'
      })
      .then(res => res.json())
      .then(json => {
        this.$root.user = json.data
        if(json.status == 0){
          this.message = json.message
          this.errorModal = true
        }
        if(json.status == 1){
          this.$router.push('/dashboard')
        }
      }).catch(error => {
        console.log(error)
      })
    }
  }
}
</script>

<style lang="stylus">
.signin
  margin-top 15em
  text-align center

input
  margin-bottom 0.5em
  margin-right 1em
  display: block
  padding 15px
  font-size: 14px
  border-radius 4px
  width: 25em
  border none
  -webkit-box-shadow: 5px 5px 15px 1px rgba(0,0,0,0.08); 
  box-shadow: 5px 5px 15px 1px rgba(0,0,0,0.08);

button
  padding 15px
  margin-bottom 20px
  background-color transparent
  color #000
  font-size 32px
  cursor pointer
  border-bottom 2px solid black
  border-top none
  border-left none
  border-right none

button:hover
  color: #fff
  transition: 0.2s ease-in
  border-bottom 2px solid #fff
  border-top none
  border-left none
  border-right none


::placeholder
  color #565051

</style>
