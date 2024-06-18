<template>
  <div class="register">
  <div class="registration-container">
    <h2>Register</h2>
    <form @submit.prevent="register" class="registration-form">
      <div class="form-group">
        <label for="name" class="form-label">Name:</label>
        <input type="text" id="name" v-model="formData.name" class="form-input" required placeholder="Enter your name">
      </div>
      <div class="form-group">
        <label for="email" class="form-label">Email:</label>
        <input type="email" id="email" v-model="formData.email" class="form-input" required placeholder="Enter your email">
      </div>
      <div class="form-group">
        <label for="phone" class="form-label">Phone Number:</label>
        <input type="text" id="phone" v-model="formData.phoneNumber" class="form-input" required placeholder="Enter your phone number">
      </div>
      <div class="form-group">
        <label for="username" class="form-label">Username:</label>
        <input type="text" id="username" v-model="formData.username" class="form-input" required placeholder="Enter your username">
      </div>
      <div class="form-group">
        <label for="password" class="form-label">Password:</label>
        <input type="password" id="password" v-model="formData.password" class="form-input" required placeholder="Enter your password">
      </div>
      <div class="form-group">
        <label for="confirmPassword" class="form-label">Confirm Password:</label>
        <input type="password" id="confirmPassword" v-model="confirmPassword" class="form-input" required placeholder="Enter your same password">
      </div>
      <button type="submit" class="submit-button">Register</button>
      <router-link v-if="!isAuthenticated" to="/login" class="login-link">Already have an account? Login</router-link>
    </form>

    <!-- Error message -->
    <p v-if="errorMessage" class="error-message">{{ errorMessage }}</p>
    <!-- Success message -->
    <p v-if="registrationSuccess" class="success-message">Registration successful! Please login.</p>
  </div>
</div>
</template>

<script>
import axios from 'axios';

export default {
  name: 'Register',
  data() {
    return {
      formData: {
        name: '',
        email: '',
        phoneNumber: '',
        username: '',
        password: ''
      },
      confirmPassword: '',
      errorMessage: '',
      registrationSuccess: false,
    };
  },
  methods: {
    async register() {
      if (this.formData.password !== this.confirmPassword) {
        this.errorMessage = "Passwords do not match.";
        return;
      }
      try {
        const response = await axios.post(`${process.env.VUE_APP_BACKEND_URL}register.php`, this.formData);

        if (response.data.success) {
          this.registrationSuccess = true;
          this.errorMessage = '';
          // Optionally redirect to login page or automatically log the user in
          this.$router.push('/login');
        } else {
          this.errorMessage = response.data.message;
        }
      } catch (error) {
        this.errorMessage = "Failed to register. Please try again.";
      }
    }
  }
};
</script>



<style scoped>
/* Add styles for your registration form */

.register {
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
  height: 100vh; /* Set height to full viewport height */
}

.registration-container {
  max-width: 400px;
  width: 80%; /* Set the width */
  margin-top: 50px ; /* Add margin to create space between header and form */
  padding: 0px 20px;
  background-color: #000000ce;
  border-radius: 10px;
  box-shadow:  0 0 5px #ffffff;
}


.registration-form {
  width: 100%;
}

h2 {
  text-align: center;
  margin-bottom: 20px; /* Add margin-bottom for spacing from the form */
  color: #ffffff; /* Set text color to contrast with dark background */
}

.form-group {
  display: flex;
  flex-direction: column;
  margin-bottom: 0px;
}

.form-label {
  text-align: left;
  margin-bottom: 5px;
  color: #ffffff;
}

.form-input {
  padding: 10px;
  margin-bottom: 15px;
  border-radius: 5px;
  border: 1px solid #ffffff;
  background-color: rgba(0, 0, 0, 0.529); /* Semi-transparent white background */
  color: #ffffff; /* Set text color to white */
}

.submit-button {
  padding: 10px 20px;
  background-color:  #00c103;
  color: white;
  border: none;
  border-radius: 5px;
  cursor: pointer;
  margin-bottom: 15px;
  border-radius: 5px;
}

.login-link {
  text-align: right;
  color: #ffffff; /* Set text color to contrast with dark background */
  text-decoration: none;
  margin-left: 20px;
}

.login-link:hover{
  color: rgb(0, 89, 255);
    text-shadow: 0 0 5px #000000;
     -webkit-box-reflect:below 1px linear-gradient(transparent, #0005);
}

.error-message {
  color: red;
}

.success-message {
  color: green;
}

button:hover {
  background: #42b983;
    color: #ffffff;
    box-shadow: 0 0 5px #42b983,
                0 0 25px  #42b983;
     -webkit-box-reflect:below 1px linear-gradient(transparent, #0005);
}


@media (max-width: 768px) {
  
.register{

  overflow:none; /* Allow scrollbars */
}
.registration-container {
  max-width: 400px;
  width: 80%; /* Set the width */
  margin-top: -70px ; /* Add margin to create space between header and form */
  padding: 0px 15px;
  background-color: #000000ce;
  border-radius: 10px;
  box-shadow:  0 0 5px #ffffff;
}

.form-group {
  display: flex;
  flex-direction: column;
  margin-bottom: 5px;
}

}
</style>

