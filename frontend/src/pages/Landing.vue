<template>
  <div class="landing">
    <div v-if="animationEnded" class="title" >
      <p>When you can't keep up.<br> Let us help you. </p>
    </div>
    <div class="heroText" >
      <h1>KeepUp</h1>
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
  },
  data(){
    return{
      animationEnded: false
    }
  },
  mounted(){
    this.showText()
  },
  methods:{
    showText(){
      setTimeout(() => {
        this.animationEnded =true        
      }, 3000);
    }

  }
}
</script>

<style lang="stylus">
@import url('https://fonts.googleapis.com/css?family=Poppins:700');

.landing
  width 100%
  display flex
  flex-direction row
  text-align center

.title
  display flex
  flex-direction column
  color transparent
  font-size 45px
  padding 3em 10em
  margin-left 2em
  position absolute
  text-shadow: #000 0px 0px 1px;
  -webkit-font-smoothing: antialiased;
  animation: fadeOnce 2s;

  
.heroText
  display flex
  flex-direction column
  font-size 45px
  padding-top 3em
  margin 0 auto
  -webkit-animation: fadein 3s; /* Safari, Chrome and Opera > 12.1 */
  -moz-animation: fadein 3s; /* Firefox < 16 */
  -ms-animation: fadein 3s; /* Internet Explorer */
  -o-animation: fadein 3s; /* Opera < 12.1 */
  animation: fadein 3s;
  opacity: 0;


  @keyframes fadein {
    0%   { opacity:0; }
    50%  { opacity:1; }
    100% { opacity:0; }
  }

  /* Firefox < 16 */
  @-moz-keyframes fadein {
    0%   { opacity:0; }
    50%  { opacity:1; }
    100% { opacity:0; }
  }

  /* Safari, Chrome and Opera > 12.1 */
  @-webkit-keyframes fadein {
    0%   { opacity:0; }
    50%  { opacity:1; }
    100% { opacity:0; }
  }

  /* Internet Explorer */
  @-ms-keyframes fadein {
    0%   { opacity:0; }
    50%  { opacity:1; }
    100% { opacity:0; }
  }

  @keyframes fadeOnce {
    0%   { opacity:0; }
    100% { opacity:1; }
  }

  /* Firefox < 16 */
  @-moz-keyframes fadeOnce {
    0%   { opacity:0; }
    100% { opacity:1; }
  }

  /* Safari, Chrome and Opera > 12.1 */
  @-webkit-keyframes fadeOnce {
    0%   { opacity:0; }
    100% { opacity:1; }
  }

  /* Internet Explorer */
  @-ms-keyframes fadeOnce {
    0%   { opacity:0; }
    100% { opacity:1; }
  }

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
