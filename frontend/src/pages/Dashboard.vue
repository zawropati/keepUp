<template>
  <div v-if="$root.user" class="dashboard">
    <div @click="goToFriend(friend)" v-for="friend in $root.friends" class="friendContainer">
      <img :src="friend.image_url">
      <div class="name">{{friend.first_name}} {{friend.last_name}}</div>
      <div>blahjgjyfkgvhj</div>
    </div>
  </div>
</template>

<script>
export default {
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
    }
  }
}
</script>

<style lang="stylus">
.dashboard
  display flex
  flex-direction column
  padding-top 80px
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

</style>
