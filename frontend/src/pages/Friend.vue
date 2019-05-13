<template>
<div>
  <div v-if="$root.user && !isEditClicked" class="friend">
    <div class="friendAbout">
      <img :src="friend.image_url">
      <p>{{friend.first_name}} {{friend.last_name}}</p>
      <div>
        <p>{{friend.phone}}</p>
        <p>{{friend.email}}</p>
        <p>{{friend.address}}</p>
      </div>
      <p>{{friend.workplace}}</p>
      <div>
        <p></p>
        <p>{{friend.birthdate}}</p>
      </div>
    </div>
    <div class="friendContent">
      <p>{{friend.category_name}}</p>
      <p>{{friend.frequency}}</p>
      <p>{{friend.note}}</p>
    </div>
    <button @click.prevent="isEditClicked = true">edit </button>
  </div>
  <div v-if="$root.user && isEditClicked" class="friend">
      <img :src="friend.image_url">
<input type="text" v-model="friend.first_name" placeholder="First name">
        <input type="text" v-model="friend.last_name" placeholder="Last name">
        <input type="text" v-model="friend.email" placeholder="Email">
        <input type="date" v-model="friend.birthday" placeholder="Birthday">
        <input type="text" v-model="friend.address" placeholder="Address">
        <input type="text" v-model="friend.phone" placeholder="Phone number">
        <input type="text" v-model="friend.workplace" placeholder="Workplace">
        <select v-model="friend.category_fk">
          <option value="1">Family</option>
          <option value="2">Work</option>
          <option value="3">Friends</option>
        </select>
        <button @click="saveFriendData(friend)"> Add friend<img class="arrow" src='../assets/arrow-right-solid.svg'> </button>
  </div>
</div>
</template>

<script>
export default {
  data () {
    return {
      friend: {},
      isEditClicked: false,
      friendArray: [],
      friendObj: {}
    }
  },
  created(){
    this.getOneFriend()
  },
  methods:{
    getOneFriend(){
      fetch(`/friends/backend/api/api-get-one-friend.php?friendID=${this.$route.params.id}`, {
        method: 'GET',
        credentials: 'include'
      })
      .then(res => res.json())
      .then(json => {
        console.log(json)
        //check if its 1
        this.friend = json.data[0]
      }).catch(error => {

        console.log(error)
      })
    },
    saveFriendData(friend){
      this.friendObj = {
        id: friend.friend_fk,
        firstName: friend.first_name,
        lastName: friend.last_name,
        email: friend.email,
        birthday: friend.birthday,
        address: friend.address,
        phoneNumber: friend.phone,
        workplace: friend.workplace,
        category: friend.category_fk
      }
      this.friendArray.push(this.friendObj)
      fetch('/friends/backend/api/api-update-friend.php', {
        method: 'POST',
        contentType: 'application/JSON',
        credentials: 'include',
        body: JSON.stringify(this.friendObj)
      })
      .then(res => res.json())
      .then(json => {
        //console.log(json)
        this.friendArray = []
        //check if its 1
      }).catch(error => {

        console.log(error)
      })
    }
  }
}

</script>

<style lang="stylus">

.friend
  display flex
  flex-direction column
  justify-content center

  .friendAbout
    width 30%

  .friendContent
    width 70%

</style>
