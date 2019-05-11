<template>
  <div v-if="$root.user" class="friend">
    FRIEND
  </div>
</template>

<script>
export default {
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
        // this.$root.friends = json.data
      }).catch(error => {

        console.log(error)
      })
    }
  }
}

</script>

<style lang="stylus">

</style>
