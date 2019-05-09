<template>
  <div class="landing">
    <div>
      <div class="bottomLeftGreyBlob"></div>
      <div class="bottomLeftGreenBlob"></div>
      <div class="bottomLeftPinkBlob"></div>
    </div>
    <div class="heroText">
      <h1>Friendtimacy</h1>
      <p>We help you to keep your important relationships strong and happy</p>
    </div>
  </div>
</template>

<script>
// @ is an alias to /src
import HelloWorld from '@/components/HelloWorld.vue'

export default {
  name: 'landing',
  components: {
    HelloWorld
  }
}
</script>

<style lang="stylus">
.landing
  width 100%
  display flex
  flex-direction row

  div
    width 50%

  .heroText
    display flex
    flex-direction column
    align-items grid-start
    font-weight 700
    font-size 35px
    padding-top 100px

    h1
      margin 0

.bottomLeftGreyBlob
  z-index 3
  background-image url('.././assets/blob-shape3.svg')
  width 400px
  height 400px
  position absolute
  bottom 0
  left 0
  background-size contain
  background-repeat no-repeat
  transform rotate(77deg)

.bottomLeftGreenBlob
  z-index 1
  background-image url('.././assets/blob-shape4.svg')
  width 400px
  height 400px
  position absolute
  bottom -91px
  left -76px
  background-size contain
  background-repeat no-repeat
  transform rotate(77deg)

.bottomLeftPinkBlob
  z-index 2
  background-image url('.././assets/blob-shape5.svg')
  width 600px
  height 600px
  position absolute
  bottom -91px
  left -76px
  background-size contain
  background-repeat no-repeat

</style>
