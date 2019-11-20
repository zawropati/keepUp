<template>
  <div id="app">
    <div v-if="this.$route.name !== 'signin'" class="topRightBlob1"></div>
    <!-- <div v-if="this.$route.name !== 'signin'" class="topRightBlob2"></div> -->

    <div id="nav">
      <div class="logoContainer">
        <router-link to="/">
          <img class="logoImg" src="https://img.icons8.com/small/50/000000/handshake-heart.png">
          <p class="logo">KeepUp</p>
        </router-link>
      </div>
      <div class="navRight">
        <!-- <div v-if="!$root.user"><router-link to="/aboutus">About us</router-link></div> -->
        <div v-if="!$root.user"><router-link to="/signup">Sign up</router-link></div>
        <div v-if="!$root.user"><router-link to="/signin">Sign in</router-link></div>
        <div v-if="$root.user" @click="signout"><router-link to="/">Sign out</router-link></div>
        <div v-if="$root.user"><router-link to="/dashboard">Friends</router-link></div>
        <div v-if="$root.user"><router-link to="/settings">Settings</router-link></div>
      </div>
    </div>
    <div v-if="beforeLogin">
      <div class="blob">
        <svg xmlns:xlink="http://www.w3.org/1999/xlink" version="1.1" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 310 350">
          <path d="M156.4,339.5c31.8-2.5,59.4-26.8,80.2-48.5c28.3-29.5,40.5-47,56.1-85.1c14-34.3,20.7-75.6,2.3-111  c-18.1-34.8-55.7-58-90.4-72.3c-11.7-4.8-24.1-8.8-36.8-11.5l-0.9-0.9l-0.6,0.6c-27.7-5.8-56.6-6-82.4,3c-38.8,13.6-64,48.8-66.8,90.3c-3,43.9,17.8,88.3,33.7,128.8c5.3,13.5,10.4,27.1,14.9,40.9C77.5,309.9,111,343,156.4,339.5z"/>
        </svg>
      </div>
      <div class="blob3">
        <svg viewBox="0 0 600 600" xmlns="http://www.w3.org/2000/svg">
          <g transform="translate(300,300)">
            <path d="M182,-133C222.8,-94,233.8,-19.1,213.5,40.3C193.2,99.7,141.7,143.6,98.6,139.2C55.4,134.8,20.5,82.3,-40.8,61.6C-102.2,41,-190,52.2,-207.4,31.4C-224.8,10.7,-171.8,-42,-125.5,-82.3C-79.2,-122.5,-39.6,-150.3,15.5,-162.6C70.6,-175,141.3,-172,182,-133Z" />
          </g>
        </svg>
      </div>
    </div>
    <router-view class="router-view"/>
  </div>
</template>

<script>
export default {
  data(){
    return {
      beforeLogin: false
    }
  },
 watch: {
    '$route' (to, from) {
      this.checkWhichRoute()
    }
 },
  created(){
    //this.checkWhichRoute()
    this.getCurrentUser()
    this.checkWhichRoute()
  },
  mounted(){
  },
  methods: {
    getCurrentUser(){
      fetch('/api/api-get-current-user.php', {
        method: 'GET'
      })
      .then(res => res.json())
      .then(json => {
        if(json.status = 1){
          this.$root.user = json.data
        }
        console.log(json)
      }).catch(error => {
        console.log(error)
      })
    },
    signout(){
      fetch('/api/api-signout.php', {
        method: 'GET'
      })
      .then(res => res.json())
      .then(json => {
        this.$root.user = ''
        console.log(json)
      }).catch(error => {
        console.log(error)
      })
    },
    checkWhichRoute(){
      console.log(this.$route.path)
      if(this.$route.path == '/' || this.$route.path ==  '/aboutus' || this.$route.path == '/signup' ||  this.$route.path == '/signin' ||  this.$route.path == '/settings' ){
        this.beforeLogin = true
      }else{
        this.beforeLogin = false
      }
    }
  }
}
</script>


<style scoped lang="stylus">

</style>
<style>
.blob {
  position: absolute;
  top: -12em;
  transform: rotate(45deg);
  left: -650px;
  fill: #009465;
  width: 80vmax;
  z-index: -1;
  animation: move 5s ease-in;
}
.blob2 {
  position: absolute;
  top: -200px;
  fill: #2660A4;
  transform: rotate(45deg);
  /* right: -5em; */
  width: 80vmax;
  z-index: -1;
  animation: move 5s ease-in ;
}
.blob3 {
  position: absolute;
  fill: #9C95DC;
  /* top: -800px; */
  left: -45em;
  width: 120vmax;
  height: 120vh;
  z-index: -1;
  transform: rotate(-135deg);
  transform-origin: 70%;  
  animation: move 5s ease-in ;
}


/* @keyframes move {
  0%   { transform: translate(10px, -600px); }
  25%  { transform: translate(10px, -300px) }
  /* 78%  { transform: scale(1.3) translate(0vw, 50vh) rotate(-20deg); }
  80%  { transform: scale(1.3) translate(0vw, 50vh) rotate(-20deg); }  
  100% { transform:  translate(10px, -30px); }
} */
.greyLayer {
  position: fixed;
  top: 0;
  left: 0;
  width: 100%;
  height: 100%;
  background-color: #000;
  opacity: 0.7;
  z-index: 1;
}
.modalContainer {
  z-index: 2;
}
.modal {
  background: #EDF7F6;
  border-radius: 0.25em;
  z-index: 2;
  padding: 30px 50px;
  position: absolute;
  left: 30%;
  width: 500px;
  top: 25%;
  overflow: auto;
  border: 5px #F9CA5A solid;
  -webkit-box-shadow: 0px 0px 10px 0px rgba(0,0,0,0.45);
  -moz-box-shadow: 0px 0px 10px 0px rgba(0,0,0,0.45);
  box-shadow: 0px 0px 10px 0px rgba(0,0,0,0.45);
}


body {
  font-family: 'Poppins', sans-serif;
  background: #F7FFF7;
  color: black;
  margin: 0px;
  overflow-x: hidden;
  overflow-y: auto;
}
#app {
  min-height: 100vh;
  display: flex;
  flex-direction: column;
  align-items: center;
  width: 100%;
  margin: 0px 40px 20px 40px;
}
#nav {
  display: flex;
  align-items: center;
  z-index: 10;
  width: 90%;
  padding-top: 35px;
  padding-bottom: 30px;
  font-size: 14px;
  flex: 0;
}
#nav div {
  width: 50%;
}
#nav a {
  color: black;
  text-decoration: none;
}
.logo {
  color: brandPink;
  font-weight: bold;
  letter-spacing: 2px;
}
.navRight {
  display: flex;
  flex-direction: row;
  align-items: space between;
}
.navRight > div {
  text-align: center;
}
.navRight :first-child {
  text-align: left;
}
.navRight :last-child {
  text-align: right;
}
.router-view {
  flex-grow: 1;
}
.topRightBlob1 {
  z-index: 9;
  fill: #f6E27F;
  background-image: url("./assets/newblob.svg");
  width: 400px;
  height: 400px;
  position: absolute;
  top: -80px;
  right: -100px;
  background-size: contain;
  background-repeat: no-repeat;
  transform: rotate(77deg);
  pointer-events: none;
}
.topRightBlob2 {
  background-image: url("./assets/blob-shape2.svg");
  width: 400px;
  height: 400px;
  position: absolute;
  top: -172px;
  right: -113px;
  background-size: contain;
  background-repeat: no-repeat;
  transform: rotate(77deg);
  pointer-events: none;
}

.logoImg{
  float: left;
  width: 40px;
  margin-right: 10px;

}
</style>
