<template>
<div v-if="$root.user">
<div class="friendTop flexWrapper">
  <div>
    <div class="friendBlob"></div>
            <img class="friendAvatar" v-if="friend.image_url !=='' && !friend.image_url.includes('http')" :src="`/uploads/${friend.image_url}`">
          <img class="friendAvatar"  v-if="friend.image_url !=='' && friend.image_url.includes('http')" :src="friend.image_url">
         <br>
         <label for="file-upload" class="custom-file-upload">
            Change avatar
          </label>
      <input id="file-upload" class="input-button" placeholder="Change avatar" type="file"  @change="uploadImage"> 
  </div>
  <div>
      <h1 id="friendName">{{friend.first_name}} {{friend.last_name}}</h1>
  </div>
</div>
<div class="flexWrapper">
  <div v-if="!isEditClicked" class="friend">
    <div class="friendAbout">
       <!-- <img class="avatar" v-if="friend.image_url==''" src="../assets/dummy.png"> -->
                 <h1>Details</h1>
                 <img class="friendIcon" src="https://img.icons8.com/dotty/80/000000/friends.png">

      <div>
        <p>Phone: {{friend.phone}}</p>
        <p>Email: {{friend.email}}</p>
        <p>Address: {{friend.address}}</p>
      </div>
      <p>Workplace: {{friend.workplace}}</p>
      <div>
        <p></p>
        <p>Birthdate: {{friend.birthdate}}</p>
        <p>Category: {{friend.category_name}}</p>
      </div>
    <button @click.prevent="isEditClicked = true">Edit</button>
    </div>
  </div>
  <div v-if="isEditClicked" class="friend">
    <div class="friendAbout">
        <div class="flexWrapper">
        <div>
        <label>First name</label>
        <input class="friend-input" type="text" v-model="friend.first_name" placeholder="First name">
        <label>Last name</label>
        <input class="friend-input" type="text" v-model="friend.last_name" placeholder="Last name">
        <label>Email</label>
        <input class="friend-input" type="text" v-model="friend.email" placeholder="Email">
        <label>Birthdate</label>
        <input class="friend-input" type="date" v-model="friend.birthday" placeholder="Birthday">
        </div>
        <div>
        <label>Address</label>
        <input class="friend-input" type="text" v-model="friend.address" placeholder="Address">
        <label>Phone number</label>
        <input class="friend-input" type="text" v-model="friend.phone" placeholder="Phone number">
        <label>Workplace</label>
        <input class="friend-input" type="text" v-model="friend.workplace" placeholder="Workplace">
        <label>Category</label>
        <select v-model="friend.category_fk">
          <option value="1">Family</option>
          <option value="2">Work</option>
          <option value="3">Friends</option>
        </select>
        </div>
        </div>
        <button class="friendBtn" @click="saveFriendData(friend)">Save</button>
    </div>
  </div>

  <div class="friend">
        <div class="friendAbout">
          <h1>Note</h1>
          <img class="friendIcon" src="https://img.icons8.com/dotty/80/000000/novel.png">
          <div v-if="!isEditNoteClicked">
          <p class="friendNote">{{friend.note}}</p>
          <button @click="isEditNoteClicked = true">Edit note</button>
          </div>
        <div v-if="isEditNoteClicked">
          <textarea class="editTextarea" v-model="friend.note"/>
          <button @click="editFriendNote(friend)">Save</button>

        </div>
        </div>
        </div>
  <div class="friend">

        <div class="friendAbout">
          <h1>Stay in touch</h1>
          <img class="friendIcon" src="https://img.icons8.com/wired/64/000000/trust.png">
          <div v-if="!isEditFrequencyClicked">
          <p v-if="friend.frequency_fk == '1'">Daily</p>
          <p v-if="friend.frequency_fk == '2'">Weekly</p>
          <p v-if="friend.frequency_fk == '3'">Monthly</p>
          <p v-if="friend.frequency_fk == '4'">Yearly</p>
          <p v-if="friend.frequency_fk == '5'">Never</p>
          <button @click="isEditFrequencyClicked = true">Edit preferences</button>
          </div>
          <div v-if="isEditFrequencyClicked">
          <select v-model="friend.frequency">
          <option value="1">Daily</option>
          <option value="2">Weekly</option>
          <option value="3">Monthly</option>
          <option value="4">Yearly</option>
          <option value="5">Never</option>
        </select>
          <button @click="editPreferences(friend)">Save</button>
          </div>
        </div>
  </div>
          <div class="friend">

        <div class="friendAbout">
          <h1>Memories</h1>
          <img class="friendIcon" src="https://img.icons8.com/wired/64/000000/event-accepted.png">
          <div v-if="!isAddMemoryClicked" v-for="memory in memories">
            <span>{{memory.date}} </span>
            <span>{{memory.name}} </span>
            <img class="closeIcon" @click="deleteFriendMemory(memory)" src="https://img.icons8.com/dotty/80/000000/cancel.png">
          </div>
          <br>
            <button v-if="!isAddMemoryClicked" @click="isAddMemoryClicked = true">Add</button>
            <div v-if="isAddMemoryClicked">
              <input class="friend-input"  v-model="memoryName" placeholder="name">
              <input class="friend-input" v-model="memoryDate" type="date"/>
            <button @click="addMemory(friend)">Add</button>
            </div>
        </div>
          </div>
  </div>
  <div class="bottomFriendBlob"></div>
</div>
</div>
</template>

<script>
export default {
  data () {
    return {
      isEditClicked: false,
      isEditNoteClicked: false,
      isAddMemoryClicked: false,
      isEditFrequencyClicked: false,
      friend: {},
      friendID: "",
      friendObj: {},
      noteObj: {},
      memories: {},
      memoryDate: "",
      memoryName: "",
      vres: ""
    }
  },
  created(){
    this.getOneFriend()
    this.getMemories()
  },
  methods:{
    getOneFriend(){
      fetch(`/api/api-get-one-friend.php?friendID=${this.$route.params.id}`, {
        method: 'GET',
        credentials: 'include'
      })
      .then(res => res.json())
      .then(json => {
        this.friend = json.data[0]
        this.friendID = this.friend.friend_fk 
      }).catch(error => {

        console.log(error)
      })
    },
    saveFriendData(friend){
      this.isEditClicked = false
      this.friendObj = {
        id: friend.friend_fk,
        firstName: friend.first_name,
        lastName: friend.last_name,
        email: friend.email,
        birthdate: friend.birthday,
        address: friend.address,
        phoneNumber: friend.phone,
        workplace: friend.workplace,
        category: friend.category_fk
      }
      fetch('/api/api-update-friend.php', {
        method: 'POST',
        contentType: 'application/JSON',
        credentials: 'include',
        body: JSON.stringify(this.friendObj)
      })
      .then(res => res.json())
      .then(json => {
        this.getOneFriend()
      }).catch(error => {
        console.log(error)
      })
    },
    editFriendNote(friend){
      this.isEditNoteClicked = false
      this.noteObj = {
        friendID: friend.friend_fk,
        note: friend.note
      }
      fetch('/api/api-update-notes.php', {
        method: 'POST',
        contentType: 'application/JSON',
        credentials: 'include',
        body: JSON.stringify(this.noteObj)
      })
      .then(res => res.json())
      .then(json => {
      }).catch(error => {
        console.log(error)
      })
    },
    getMemories(){
      fetch(`/api/api-get-friend-memories.php?friendID=${this.$route.params.id}`, {
        method: 'GET',
        credentials: 'include'
      })
      .then(res => res.json())
      .then(json => {
        //check if its 1
        this.memories = json.data
      }).catch(error => {
        console.log(error)
      })
  },
  addMemory(friend){
      this.isAddMemoryClicked = false
      this.memoryObj = {
        friendID: friend.friend_fk,
        date: this.memoryDate,
        name: this.memoryName
      }
      fetch('/api/api-add-memories.php', {
        method: 'POST',
        contentType: 'application/JSON',
        credentials: 'include',
        body: JSON.stringify(this.memoryObj)
      })
      .then(res => res.json())
      .then(json => {
        this.getMemories()
      }).catch(error => {
        console.log(error)
      })
    },
    uploadImage(e){
      let data = new FormData();
      data.append('fileToUpload', event.target.files[0]); 
      data.append('friendID', this.friendID); 
      let config = {
        header : {
          'Content-Type' : 'image/png'
        }
      }
      fetch('/api/api-add-image.php', {
        method: 'POST',
        contentType: 'image/png',
        credentials: 'include',
        body: data
      })
      .then(res => res.json())
      .then(json => {
        this.getOneFriend()
      }).catch(error => {
        console.log(error)
      })

    },
    deleteFriendMemory(memory){
      let formData = new FormData()
      formData.append('memoryID', memory.id)
      fetch('/api/api-delete-memory.php', {
        method: 'POST',
        credentials: 'include',
        body:formData
      })
      .then(res => res.json())
      .then(json => {
        this.getMemories()
      }).catch(error => {
        console.log(error)
      })
    },
    editPreferences(friend){
      this.isEditFrequencyClicked = false
      let formData = new FormData()
      formData.append('friendID', friend.friend_fk)
      formData.append('stayInTouchFrequency', friend.frequency)
      fetch('/api/api-update-stay-in-touch.php', {
        method: 'POST',
        credentials: 'include',
        body:formData
      })
      .then(res => res.json())
      .then(json => {
        this.getOneFriend()
      }).catch(error => {
        console.log(error)
      })

    }
  }
}

</script>
<style lang="stylus" scoped>
.friendNote{
  width: 250px
}
.friendIcon{
  width: 60px
}
.friendBlob{
  position absolute
}
#friendName{
  font-size 2.5em
  letter-spacing 0.04em
}

.friendTop{
  margin-bottom 1em
}
.friendBlob
  background-image url('../assets/friendBlob.svg')
  width: 550px;
  height: 400px;
  left: -70px
  top: 30px  
  position: absolute;
  background-size: contain;
  background-repeat: no-repeat;
  transform: rotate(77deg);
  pointer-events: none;
  z-index -2

.bottomFriendBlob
  background-image url('../assets/greenFriendBlob.svg')
  width: 650px;
  height: 500px;
  right: -200px
  bottom: -100px  
  position: absolute;
  background-size: contain;
  background-repeat: no-repeat;
  transform: rotate(270deg);
  pointer-events: none;
  z-index -2

button, .custom-file-upload {
  background transparent
  border none
  color black
  // border-radius 50px
  padding 4px
  border-bottom 2px solid black
  // text-decoration underline
  // -webkit-box-shadow: 10px 10px 14px 1px rgba(00,00,00,0.2)
  // box-shadow: 10px 10px 14px 1px rgba(00,00,00,0.2)
  font-size 14px
  cursor pointer

}
</style>
<style lang="stylus">
input[type="file"] {
    display: none;
}  

label{
  font-size 12px
  margin 2px

}
.friend-input, select{
  margin-bottom 0.5em
  margin-right 1em
  display: block
  padding 10px
  font-size: 14px
  border-radius 4px
  width: 140px
  border none
  -webkit-box-shadow: 5px 5px 15px 1px rgba(0,0,0,0.08); 
  box-shadow: 5px 5px 15px 1px rgba(0,0,0,0.08);
}

.input-button{
  border: none
  background transparent
}
.closeIcon{
  width 32px
  float right
  // background-color #f05539
  // border-radius: 50%;
  cursor pointer
}
.editTextarea
  height 200px
  width 80%
  font-size 14px

.arrow
  width 20px
  position relative
  top 8px
  left 3px
  color white

.box
  border-radius 1em
  background-color rgba(0,0,0,0.4)
  -webkit-box-shadow: 5px 5px 15px 1px rgba(0,0,0,0.24); 
  box-shadow: 5px 5px 15px 1px rgba(0,0,0,0.24);
  padding 1em
  margin 0.5em
  width 300px
  height 350px

.friendAvatar
  border-radius: 50%;
  margin-right: 40px;
  width: 150px;
  height: 150px;
  object-fit: cover;

.friendBtn
  display inline-block

.flexWrapper
  display flex
  flex-direction row

.friend
  display flex
  flex-direction row
  justify-content center
  width 80%
  border-right 1px solid rgba(0,0,0,0.2)
  padding-left 1em

  .friendAbout
    width 350px

  .friendContent
    width 70%

</style>
