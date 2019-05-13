<template>
  <div v-if="$root.user" class="dashboard">
    <div class="panel">
      <button @click="sortingCategory = 1" :class="{activeButton: sortingCategory==1}">Friends</button>
      <button @click="sortingCategory = 2" :class="{activeButton: sortingCategory==2}">Family</button>
      <button @click="sortingCategory = 3" :class="{activeButton: sortingCategory==3}">Work</button>
      <button @click="sortingCategory = 4" :class="{activeButton: sortingCategory==4}">All</button>
      <button  @click="openModal" title="Add friend"><img class="plus" src='../assets/plus-solid.svg'></button>
    </div>
    <div v-if="modalIsOpen==true && !isSubmitted" class="greyLayer">
    </div>
    <div v-if="modalIsOpen==true && !isSubmitted" class="modalContainer">
      <div class="modal">
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
        <button @click="addFriend"> Add friend<img class="arrow" src='../assets/arrow-right-solid.svg'> </button>
      </div>
    </div>
    <div class="dashboardInner">
      <div @click="goToFriend(friend)" v-for="friend in $root.friends" v-if="friend.category_fk==sortingCategory || sortingCategory==4" class="friendContainer">
        <img :src="friend.image_url">
        <div class="name">{{friend.first_name}} {{friend.last_name}}</div>
        <div>blahjgjyfkgvhj</div>
      </div>
    </div>
  </div>
</template>

<script>
export default {
  data(){
    return {
      modalIsOpen: false,
      firstName:'',
      lastName:'',
      email:'',
      birthday:'',
      address:'',
      phoneNumber:'',
      workplace:'',
      category: 1,
      isSubmitted: false,
      sortingCategory: 4
    }
  },
  created(){
    this.getAllFriends()
  },
  methods:{
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
    },
    goToFriend(friend){
      console.log(friend)
      this.$router.push(`friend/${friend.id}`);
    },
    openModal(){
      this.modalIsOpen=true
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
      fetch('/friends/backend/api/api-add-friend.php', {
        method: 'POST',
        body: formData
      })
      .then(res => res.json())
      .then(json => {
        this.isSubmitted=true
        this.getAllFriends()
        console.log(json)
      }).catch(error => {

        console.log(error)
      })
    }
  }
}
</script>

<style lang="stylus">
@import '.././assets/global.stylus.styl'

.panel
  margin-top 80px
  display flex
  flex-direction row
  justify-content space-between

  button
    border none
    background transparent
    cursor pointer
    outline none

  .activeButton
    text-decoration underline

    .plus
      width 20px

.dashboardInner
  z-index 0
  display flex
  flex-direction column
  width 700px

.friendContainer
  display flex
  flex-direction row
  align-items center
  padding-bottom 20px
  padding-left 70px
  cursor pointer

  img
    width 80px
    height 80px
    object-fit cover
    border-radius 50%
    margin-right 40px

  .name
    margin-right 40px

.greyLayer
  position fixed
  top 0
  left 0
  width 100%
  height 100%
  background-color black
  opacity 0.7
  z-index 1

.modalContainer
  z-index 2

.modal
  z-index 2
  display flex
  flex-flow row wrap
  align-items center
  justify-content space-around
  padding 50px
  background-color tint(brandPink,90%)
  position fixed
  left 300px
  width 500px
  overflow auto
  height 70vh

  input
    padding 15px
    width 200px
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
