<template>
  <div v-if="$root.user" class="settingsBox">
    <div class="editUserBox">
      <h1>User settings </h1>
        <input type="text" v-model="firstName" placeholder="First name">
        <input type="text" v-model="lastName" placeholder="Last name">
        <input type="text" v-model="email" placeholder="Email">
        <input type="password" v-model="password" placeholder="Password">
        <button @click="saveUserData()"> Save changes </button>
        <div v-if="modalIsOpen == true || errorModal == true" @click="modalIsOpen = false" class="greyLayer">
        </div>
        <div v-if="modalIsOpen == true" class="modalContainer">
        <div class="modal">
            <img class="closeIcon" @click="modalIsOpen = false" src="https://img.icons8.com/dotty/80/000000/cancel.png">
            <img src="https://img.icons8.com/wired/64/000000/save-all.png">
            <h1> Changes were saved! </h1>
        </div> 
    </div>
    <div v-if="errorModal == true" class="modalContainer">
        <div class="modal">
            <img class="closeIcon" @click="errorModal = false" src="https://img.icons8.com/dotty/80/000000/cancel.png">
          <img src="https://img.icons8.com/dotty/80/000000/box-important.png">
            <h1> {{message}} </h1>
        </div> 
    </div>
    </div>   
    </div>
  </div>
</template>

<script>
export default {
  data(){
    return {
      modalIsOpen: false,
      errorModal: false,
      firstName:'',
      lastName:'',
      email:'',
      password:'',
      userObj:{},
      message: ""
    }
  },
  created(){
  },
  methods:{
    saveUserData(){
      this.userObj = {
        firstName: this.firstName,
        lastName: this.lastName,
        email: this.email,
        password: this.password
      }
      fetch('/api/api-update-user.php', {
        method: 'POST',
        contentType: 'application/JSON',
        credentials: 'include',
        body: JSON.stringify(this.userObj)
      })
      .then(res => res.json())
      .then(json => {
        this.message = json.message
        if(json.status == 1){
            this.modalIsOpen = true
            this.firstName = ""
            this.lastName = ""
            this.email = ""
            this.password = ""
        }else{
            this.errorModal = true
        }
      }).catch(error => {
        console.log(error)
      })
    },

  }
}
</script>

<style lang="stylus" scoped>
.modal
    text-align center

h1
  color: black
  font-weight 500

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


.settingsBox 
  margin-top 5em
  text-align center

</style>
