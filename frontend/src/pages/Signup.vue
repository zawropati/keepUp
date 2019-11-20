<template>
  <div class="signup" v-if="!submitted">
    <input type="text" id="firstName" v-model="firstName" placeholder="First name">
    <input type="text" id="lastName" v-model="lastName" placeholder="Last name">
    <input type="text" id="email" v-model="email" placeholder="Email">
    <input type="password" id="userPassword" v-model="userPassword" placeholder="Password">
    <button @click="signUpUser">Sign up </button>
    <div v-if="errorModal == true" @click="errorModal = false" class="greyLayer"></div>
    <div v-if="errorModal == true" class="modalContainer">
        <div class="modal">
            <img class="closeIcon" @click="errorModal = false" src="https://img.icons8.com/dotty/80/000000/cancel.png">
          <img src="https://img.icons8.com/dotty/80/000000/box-important.png">
            <h1> {{message}} </h1>
        </div> 
    </div>
  </div>
  <div class="successMessage" v-else>
    <h1>One step closer to nurture your relationships. You can find the Log in button in the right upper corner.</h1>
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
      submitted: false,
      errorModal: false,
      message: ''
    }
  },
  methods: {
    signUpUser(){
      let formData = new FormData()
      formData.append('firstName', this.firstName)
      formData.append('lastName', this.lastName)
      formData.append('email', this.email)
      formData.append('userPassword', this.userPassword)
      fetch('/api/api-signup.php', {
        method: 'POST',
        body: formData
      })
      .then(res => res.json())
      .then(json => {
        if(json.status == 0){
          this.message = json.message
          this.errorModal = true
        }else{
          this.submitted=true
        }
      }).catch(error => {
        console.log(error)
      })
    }
  },
}
</script>

<style lang="stylus">
@import '.././assets/global.stylus.styl'
.successMessage
  padding 10em 15em

.signup
  text-align center
  margin-top 10em

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
