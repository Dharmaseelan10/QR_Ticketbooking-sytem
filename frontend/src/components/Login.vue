<template>
  <div class="login">
  <div class="login-container">
    <h2>Login</h2>
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.4/css/all.min.css" rel="stylesheet">

    <!-- Your login form fields -->
    <form @submit.prevent="login" class="login-form">
      <label for="username">Username:</label>
      <input v-model="username" type="text" id="username" name="username" placeholder="Enter your username">

      <label for="password">Password:</label>
      <input v-model="password" type="password" id="password" name="password" placeholder="Enter your password">

      <button :disabled="isLoggingIn">
        <span v-if="isLoggingIn">Logging in...</span>
        <span v-else>Login</span>
      </button>
      <button1  @click="loginWithFacebook()" name="fbLogin" class="login-with-facebook-btn">
  <i class="fab fa-facebook"></i> Sign in with Facebook
</button1>

<button2 @click="loginWithGoogle()" name="googleLogin" class="login-with-google-btn">
  <i class="fab fa-google"></i> Sign in with Google
</button2>

    </form>

    <!-- Display error message if login fails -->
    <p v-if="errorMessage" class="error-message">{{ errorMessage }}</p>

    <!-- Registration button -->
    <router-link v-if="isAuthenticated" to="/register" class="register-link">Don't have an account? Register here</router-link>
    <router-link v-if="!isAuthenticated" to="/register" class="register-link">Don't have an account? Register here</router-link>
    <!-- <router-link v-if="isAuthenticated" to="/ticket" class="register-link">Go to Ticket Page</router-link> -->
  </div>
</div>
</template>

<script>
import axios from 'axios';

export default {
  name: 'Login',
  data() {
    return {
      username: '',
      password: '',
      errorMessage: '',
      isLoggingIn: false,
      isAuthenticated: false,
    };
  },
  methods: {

    async loginWithFacebook() {
      try {
        console.log("1");
        const response = await axios.get(`${process.env.VUE_APP_BACKEND_URL}facebook_proxy.php`);
        console.log(response);
        console.log(response.data)
        // Handle the response and set isAuthenticated to true if login is successful
        this.isAuthenticated = true;
      } catch (error) {
        console.error('Facebook login failed:', error);
        
        // Handle error
        this.errorMessage = 'Facebook login failed. Please try again.';
      }
    },

    async loginWithGoogle() {
      try {
        
        const response = await axios.get(`${process.env.VUE_APP_BACKEND_URL}login_google.php`);
        console.log(response);
        
        // Handle the response and set isAuthenticated to true if login is successful
        this.isAuthenticated = true;
       
      } catch (error) {
        console.error('Google login failed:', error);
        // Handle error
        this.errorMessage = 'Google login failed. Please try again.';
      }
    },
    

    async login() {
  this.errorMessage = '';
  this.isLoggingIn = true;
  try {
    const response = await axios.post(`${process.env.VUE_APP_BACKEND_URL}login.php`, {
      username: this.username,
      password: this.password
    });
    console.log(response);
    this.isLoggingIn = false;
    if (response.data.success) {
      this.isAuthenticated = true;
      // Store the token and user ID in local storage or Vuex store
      localStorage.setItem('userToken', response.data.token);
      localStorage.setItem('userId', response.data.user_id); // Store user ID
      this.$router.push('/ticket');  // Redirect to a protected route after login
      

    } else {
      this.errorMessage = response.data.message;
      this.isAuthenticated = false;
    }
  } catch (error) {
    this.isLoggingIn = false;
    this.errorMessage = "Login failed. Please try again.";
  }
}
  },
  
};
</script>


<style scoped>
/* Add styles for your login form */

.login {
  display: flex;
  flex-direction: column;
  align-items: center;
  justify-content: center;
  text-align: center;
  color: #333333; /* Changed text color for better contrast */
  padding: 0px;
  background-image: url('https://www.wallpapertip.com/wmimgs/43-432643_concert-backgrounds.jpg'); 
  background-size: cover;
  background-position: center;
  width: 100vw; /* Set width to full viewport width */
  height: 100vh; /* Set height to full viewport height */
}

.login-container {
  width: 320px; /* Set the width */
  height: auto; /* Set the height */
  max-width: 80%;
  margin: 200px auto; /* Adjust margin for centering on the page and creating space from the navbar */
  padding: 25px;
  background-color: #000000ce;
  border-radius: 10px;
  box-shadow:  0 0 5px #ffffff;

}

h2 {
  text-align: center;
  margin-bottom: 20px; /* Add margin-bottom for spacing from the form */
  color: #ffffff; /* Set text color to contrast with dark background */
  text-shadow:  0 0 5px #000000;
}

.login-form {
  display: flex;
  flex-direction: column;
}

label {
  text-align: left;
  margin-bottom: 15px;
  color: rgb(255, 255, 255); /* Set label text color to contrast with dark background */
}

input[type="text"],
input[type="password"],
button {
  padding: 10px;
  margin-bottom: 15px;
  border-radius: 5px;
  border: 1px solid #ffffff;
  background-color: rgba(0, 0, 0, 0.529); /* Semi-transparent white background */
  color: #ffffff; /* Set text color to white */
}

button {
  padding: 10px 20px;
  background-color: #00c103;
  color: white;
  border: none;
  border-radius: 5px;
  cursor: pointer;
  margin-top: 7px;
}
button1 {
  padding: 10px 20px;
  background-color: #005ef6;
  color: white;
  border: none;
  border-radius: 5px;
  cursor: pointer;
  margin-bottom: 7px;
}

button2 {
  padding: 10px 20px;
  background-color: #ffffff;
  color: rgb(0, 0, 0);
  border: none;
  border-radius: 5px;
  cursor: pointer;
  margin-bottom: 7px;
  margin-top: 7px;
}

button:hover {
  background: #42b983;
    color: #ffffff;
    box-shadow: 0 0 5px #fdfdfd,
                0 0 25px  #ffffff;
     -webkit-box-reflect:below 1px linear-gradient(transparent, #0005);
}

button1:hover {
  background: #005ef6;
    color: #ffffff;
    box-shadow: 0 0 5px #ffffff,
                0 0 25px  #ffffff;
     -webkit-box-reflect:below 1px linear-gradient(transparent, #0005);
}

button2:hover {
  background: #ffffff;
    color: #000000;
    box-shadow: 0 0 5px #ffffff,
                0 0 25px  #ffffff;
     -webkit-box-reflect:below 1px linear-gradient(transparent, #0005);
}

.register-link {
  text-align: center;
  color: #ffffff; /* Set text color to contrast with dark background */
  text-decoration: none;
  margin-top: 0px;
}

.register-link:hover{
  color: rgb(0, 89, 255);
    text-shadow: 0 0 5px #000000;
     -webkit-box-reflect:below 1px linear-gradient(transparent, #0005);
}



.error-message {
  color: red;
  margin-top: 10px;
  text-align: center;

}

@media (max-width: 768px) {

 
.login-container {
  width: 320px; /* Set the width */
  height: auto; /* Set the height */
  max-width: 80%;
  padding: 25px;
  background-color: #000000ce;
  border-radius: 10px;
  box-shadow:  0 0 5px #ffffff;
  margin-top: 100px;
}
}
</style>
