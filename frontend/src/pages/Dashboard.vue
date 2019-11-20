<template>
  <div v-if="$root.user">
    <div class="friendBlob"></div>
    <div class="panel">
      <button @click="sortingCategory = 1, showAddFriend = false" :class="{activeButton: sortingCategory==1}">Friends</button>
      <button @click="sortingCategory = 2, showAddFriend = false" :class="{activeButton: sortingCategory==2}">Family</button>
      <button @click="sortingCategory = 3, showAddFriend = false" :class="{activeButton: sortingCategory==3}">Work</button>
      <button @click="sortingCategory = 4, showAddFriend = false" :class="{activeButton: sortingCategory==4}">All</button>
      <button class="addBtn" @click="showAddFriend = true" title="Add friend">Add friend</button>
    </div>
    <div v-if="showAddFriend==true" class="dashboardInner">
      <div class="addFriendContainer">
        <input type="text" v-model="firstName" placeholder="First name">
        <input type="text" v-model="lastName" placeholder="Last name">
        <input type="text" v-model="email" placeholder="Email">
        <input type="date" v-model="birthday" placeholder="Birthday">
        <input type="text" v-model="address" placeholder="Address">
        <input type="text" v-model="phoneNumber" placeholder="Phone number">
        <input type="text" v-model="workplace" placeholder="Workplace">
        <select v-model="category">
          <option value="1">Family</option>
          <option value="2">Work</option>
          <option value="3">Friends</option>
        </select>
        <button @click="addFriend"> Add </button>
    </div>
    </div>
    <div v-else class="emptyFriendContainer">
    </div>
    <div v-if="showAddFriend == false"  class="dashboardInner">
      <div v-for="friend in $root.friends" v-if="friend.category_fk==sortingCategory || sortingCategory==4" class="friendContainer">
          <img @click="goToFriend(friend)" class="dummyAvatar" v-if="friend.image_url==''" src="https://img.icons8.com/dotty/80/000000/teenager-female.png">
          <img @click="goToFriend(friend)" class="friendAvatar" v-if="friend.image_url !=='' && !friend.image_url.includes('http')" :src="`/uploads/${friend.image_url}`">
          <img @click="goToFriend(friend)" class="friendAvatar" v-if="friend.image_url !=='' &&friend.image_url.includes('http')" :src="friend.image_url">        
          <div @click="goToFriend(friend)" class="name">{{friend.first_name}} {{friend.last_name}}</div>
          <img class="dashboardIcon" src="https://img.icons8.com/ios/50/000000/overtime.png">
        <p> <span>{{friend.frequency}}</span> </p> 
        <button id="deleteFriendBtn" @click="openDeleteModal(friend)">Delete</button>
      </div>
      <div v-else  class="emptyFriendContainer">
      </div>
        <div v-if="confirmModal" @click="confirmModal = false" class="greyLayer"></div>
        <div v-if="confirmModal" class="modal">
            <img class="closeIcon" @click="confirmModal = false" src="https://img.icons8.com/dotty/80/000000/cancel.png">
          <img src="https://img.icons8.com/dotty/80/000000/box-important.png">
            <h1> Are you sure you want to delete the user? <br> This action will be irreversible </h1>
            <button id="deleteFriendBtn" @click="deleteFriend()">Confrim</button>
        </div> 
    </div>
   <div class="bottomFriendBlob"></div>
  </div>
</template>

<script>
export default {
  data(){
    return {
      showAddFriend: false,
      firstName:'',
      lastName:'',
      email:'',
      birthday:'',
      address:'',
      phoneNumber:'',
      workplace:'',
      category: 1,
      confirmModal: false,
      sortingCategory: 4,
      friendID: ''
    }
  },
  created(){
    this.getAllFriends()
  },
  methods:{
    getAllFriends(){
      fetch('/api/api-get-all-friends.php', {
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
    },
    goToFriend(friend){
      console.log(friend)
      this.$router.push(`friend/${friend.friend_fk}`);
    },
    openModal(){
      this.modalIsOpen=true
    },
    closeModal(){
      this.modalIsOpen=false
    },
  addFriend(){
      let formData = new FormData()
      formData.append('firstName', this.firstName)
      formData.append('lastName', this.lastName)
      formData.append('email', this.email)
      formData.append('birthday', this.birthday)
      formData.append('address', this.address)
      formData.append('phoneNumber', this.phoneNumber)
      formData.append('workplace', this.workplace)
      formData.append('category', this.category)
      fetch('/api/api-add-friend.php', {
        method: 'POST',
        body: formData
      })
      .then(res => res.json())
      .then(json => {
        this.showAddFriend=false
        this.getAllFriends()
        this.sortingCategory=4
        console.log(json)
      }).catch(error => {
        console.log(error)
      })
    },
    openDeleteModal(friend){
      this.confirmModal = true
      this.friendID = friend.friend_fk
    },
  deleteFriend(){
      let formData = new FormData()
      formData.append('friendID', this.friendID)
      fetch('/api/api-delete-friend.php', {
        method: 'POST',
        body: formData
      })
      .then(res => res.json())
      .then(json => {
        this.getAllFriends()
        this.confirmModal = false
        console.log(json)
      }).catch(error => {

        console.log(error)
      })
    }
  }
}
</script>

<style scoped>
.friendBlob {
  background-image: url("../assets/friendBlob.svg");
  width: 550px;
  height: 400px;
  left: -70px;
  top: 30px;
  position: absolute;
  background-size: contain;
  background-repeat: no-repeat;
  transform: rotate(77deg);
  pointer-events: none;
  z-index: -2;
}
.bottomFriendBlob {
  background-image: url("../assets/greenFriendBlob.svg");
  width: 650px;
  height: 500px;
  right: -200px;
  bottom: -100px;
  position: absolute;
  background-size: contain;
  background-repeat: no-repeat;
  transform: rotate(270deg);
  pointer-events: none;
  z-index: -2;
}

h1{
  font-weight: 500;
}
.blob2{
  position: fixed;
  width: 1000px;
  margin-top: 5em;
  margin-left: -10em;
  transform: rotate(180deg);
  transition: 2s ease-in;
}
.close-icon{
  width: 32px;
  float: right;
  right: 2em; 
  cursor: pointer;
}
.panel {
  position: absolute;
  width: 40em;
  display: flex;
  padding: 1em;
  flex-direction: row;
  background:#9C95DC;
  border-radius: 0.25em;
  z-index: 0;
  margin: 0 auto;
  box-shadow: 5px 5px 15px 1px rgba(0,0,0,0.08);
}
.panel button {
  margin: 0 auto;
  border: none;
  background: transparent;
  cursor: pointer;
  outline: none;
  color:white;
  margin-bottom: 0px;
  font-size: 1em;
  padding: 0em 1em;
}
.panel .activeButton {
border-bottom: 2px solid white;}
.panel .activeButton .plus {
  width: 20px;
}
.dashboard{
  padding: 1em 2em;
  flex-direction: row;
  justify-content: space-between;

}
.dashboardInner{
  overflow: auto;
  border-radius: 0.25em;
  /* border-left: 1px solid rgba(0,0,0,0.15);
  border-right: 1px solid rgba(0,0,0,0.15);
  border-bottom: 1px solid rgba(0,0,0,0.15); */
  margin-top: 4em;
}

.addFriendContainer{
  text-align: center;
  display: flex;
  padding: 0 1em;
  flex-direction: column;
  align-items: center;
  justify-content: space-around;
  cursor: pointer;
  width: 40em;
}

.dashboardIcon{
  width: 35px;
  margin: 8px;
}
.emptyFriendContainer{
  width: 40em;
  padding: 0 1em;
}
.friendContainer {
  overflow: auto;
  display: flex;
  padding: 1em;
  flex-direction: row;
  align-items: center;
  justify-content: space-around;
  cursor: pointer;
  margin-bottom: 1em;
  width: 40em;  
  color: black;
  background:rgba(246, 226, 127, 0.76);  

}
.friendContainer .friendAvatar {
  width: 80px;
  height: 80px;
  object-fit: cover;
  border-radius: 50%;
  margin-right: 50px;
}
.friendContainer .name {
  margin-right: 40px;
  width: 120px;
}
button:hover{
  color:#000;
  border-bottom: 2px solid #000;
}

.modal{
  margin-top: -100px;
  text-align: center;
  z-index: 7;
}
.modal button {
  padding: 15px;
  font-size: 24px;
  background-color: transparent;
  border: none;
  color: #000;
  font-weight: bold;
  width: 100%;
  margin: 0 auto;
  cursor: pointer;
}

.dummyAvatar{
  margin-left: 0.5em;
  margin-right: 3.5em;
}
#deleteFriendBtn{
    padding: 5px;
    margin-bottom: 0px;
    background: transparent;
    border: none;
    color: #000;
    border-bottom: 2px solid #000;
    font-size: 16px;
    cursor: pointer;
}
</style>
