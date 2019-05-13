<template>
    <form>
    <input v-model="firstName" type="text" class="form-control"  placeholder="First name" />
    <input v-model="lastName" type="text" class="form-control"  placeholder="Last name" />
    <input v-model="email" type="text" class="form-control"  placeholder="Email" />
    <input v-model="password" type="password" class="form-control"  placeholder="Password" />
    <input v-model="confirmPassword" type="password" class="form-control" placeholder="Confirm password" />
        <button class="custom-btn" @click.prevent="postUser()">
            Sign up
        </button>
    </form>	
</template>
<script>

export default {
  name: 'signup',
  components: {
  },
  http: {
    root: 'http://localhost:8080/friends/backend/',
    headers: {
    }
  },
  data() {
    return {
        firstName: "",
        lastName: "",
        email: "",
        password: "",
        confirmPassword: "",
        signUpApiUrl: "api/api-signup.php"
    }
  },
  mounted() {
  },
  methods:{
    postUser() {
        var that = this;
        this.$http.post(this.signUpApiUrl, {
            firstName: this.firstName, 
        })
        .then(function (response) {
             
        })
        .catch(function (error) {
            alert("Request failed, check console");
            console.log(error);
        })
    },
  }
}
</script>
