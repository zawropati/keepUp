<template>
  <div v-if="$root.user" class="friend">
    <div class="friendAbout">
      <img :src="friend.image_url">
      <p>{{friend.first_name}} {{friend.last_name}}</p>
      <div>
        <p>{{friend.phone_number}}</p>
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
  </div>
</template>

<script>
export default {
  data () {
    return {
      friend: {}
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
