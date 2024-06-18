<template>
  <nav class="navbar">
    <div class="logo" @click="navigate('/')">
      <img src="data:image/png;base64,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" alt="Site Logo">
      <span class="app-name">Bookyay-demo</span>
    </div>
    <div class="nav-links">
      <!-- Show Concerts dropdown menu -->
      <div v-if="showloginLink" class="dropdown">
        <button class="nav-button dropdown-btn">Concerts ⇓</button>
        <div class="dropdown-content">
          <router-link to="/ticket" class="dropdown-item">All concerts</router-link>
          <router-link to="/concert1" class="dropdown-item">Ed Sheeran: + - = ÷ × Tour</router-link>
          <router-link to="/concert2" class="dropdown-item">Music of the Spheres World Tour</router-link>
          <router-link to="/concert3" class="dropdown-item">Tom Jones Ages & Stages Tour</router-link>
        </div>
      </div>
      
      <!-- Show Scan Ticket dropdown menu -->
      <div v-if="showloginLink" class="dropdown">
        <button class="nav-button dropdown-btn">Scan Tickets ⇓</button>
        <div class="dropdown-content">
          <router-link to="/QRScan" class="dropdown-item">Scan Ticket</router-link>
          <router-link to="/QRScanner" class="dropdown-item">Camera Scanning</router-link>
          <router-link to="/QRScannerFile" class="dropdown-item">Choose from device</router-link>
          <router-link to="/QRScannerMachine" class="dropdown-item">QR Machine</router-link>
        </div>
      </div>

      <!-- Other navigation links -->
      <router-link v-if="showloginLink" to="/ticketbooking" class="nav-button">Book Ticket</router-link>
      <router-link v-if="showloginLink" to="/user-qrcode" class="nav-button">Profile</router-link>
      <router-link v-if="showloginLink" to="/" class="nav-button">Logout</router-link>
      

      <router-link v-if="showSignInLink" to="/login" class="nav-button">SignIn</router-link>
      
    </div>
  </nav>
</template>


<script>
export default {
  name: 'Navbar',
  data() {
    return {
      showLogoutIcon: false,
      showSignInIcon: false
    };
  },
  computed: {
    // Conditionally show the Concerts link based on the current route
    showloginLink() {
      // Define an array of paths where you want to show the Sign In link
      const allowedPaths = ['/ticket', '/ticketbooking', '/user-qrcode', '/QRScan', '/QRScanner', '/QRScannerMachine', '/QRScannerFile', '/concert1','/concert2', '/concert3', '/Chatbot' ];
      // Return true if the current route is included in the allowed paths
      return allowedPaths.includes(this.$route.path);
    },
   
    // Conditionally show the Sign In link based on the current route
    showSignInLink() {
      // Define an array of paths where you want to show the Sign In link
      const allowedPaths = [ '/', '/login','/register' ];
      // Return true if the current route is included in the allowed paths
      return allowedPaths.includes(this.$route.path);
    },
  },
  methods: {
    navigate(route) {
      // Programmatically navigate to the specified route
      this.$router.push(route);
    }
  }
}
</script>

<style scoped>
/* Your existing styles for navbar */

.navbar {
  position: fixed; /* Set navbar position to fixed */
  top: 0; /* Position it at the top */
  left: 0; /* Position it at the left */
  right: 0; /* Position it at the right */
  z-index: 1000; /* Ensure it stays on top */
  display: flex;
  justify-content: space-between;
  align-items: center;
  padding: 10px 20px;
  background-color: #00000095;
  box-shadow:  0 0 5px #ffffff;       
}

.logo {
  display: flex;
  align-items: center;
  cursor: pointer;
}

.logo img {
  height: 40px;
  width: auto;
  margin-right: 10px;
  border-radius: 80%;
}

.app-name {
  font-size: 25px;
  color: white;
  font-weight: bold;
  text-shadow: 0 0 5px #000000;
}

.app-name:hover{
  color: rgb(255, 255, 255);
  text-shadow: 0 0 5px #ffffff, /* Add shadow effect */
               0 0 25px #03e9f4;
}

.nav-links {
  display: flex;
  align-items: center;
}

.nav-button {
  margin-left: 20px;
  color: white;
  background-color: transparent;
  border: none;
  cursor: pointer;
  transition: color 0.3s ease;
  text-decoration: none; /* Remove underline */
  font-weight: bold;
}

.nav-button:hover {
  background: none; /* Remove the background color */
  color: #ffffff; /* Set text color */
  text-shadow: 0 0 5px #03e9f4, /* Add shadow effect */
               0 0 25px #03e9f4,
               0 0 50px #03e9f4,
               0 0 200px #03e9f4;
}

.logout-icon,
.sign-in-icon {
  height: 30px; /* Adjust size as needed */
  width: 30px; /* Adjust size as needed */
  border-radius: 50%;
  cursor: pointer;
}

.nav-button:hover .logout-icon,
.nav-button:hover .sign-in-icon {
  background: none; /* Remove the background color */
  color: #ffffff; /* Set text color */
  text-shadow: 0 0 5px #03e9f4, /* Add shadow effect */
               0 0 25px #03e9f4,
               0 0 50px #03e9f4,
               0 0 200px #03e9f4;
}

/* Dropdown styles */
.dropdown {
  position: relative;
}

.dropdown-btn {
  background-color: #00000000;
  border: none;
  cursor: pointer;
  color: white;
}

.dropdown-content {
  display: none;
  position: absolute;
  background-color: #00000095;
  min-width: 160px;
  z-index: 1;
}

.dropdown-content .dropdown-item {
  color: white;
  padding: 12px 16px;
  text-decoration: none;
  display: block;
  background-color: #00000095;
}

.dropdown-content .dropdown-item:hover {
  background-color: #555;
}

.dropdown:hover .dropdown-content {
  display: block;
}

/* Media Query for Mobile */
@media (max-width: 768px) {
  .navbar {
    padding: 10px; /* Adjust padding for smaller screens */
  }

  .app-name {
    font-size: 15px; /* Adjust font size for smaller screens */
  }

  .nav-button {
    margin-left: 10px; /* Adjust spacing for smaller screens */
    font-size: 10px; /* Adjust font size for smaller screens */
  }

  .logo img {
    height: 30px; /* Adjust logo size for smaller screens */
  }

  .dropdown-content {
  display: none;
  position: absolute;
  background-color: #00000095;
  min-width: 160px;
  z-index: 1;
  font-size: 12px;
}

}
</style>
