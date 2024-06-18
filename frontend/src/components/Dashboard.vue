<template>
  <div class="homepage">
    <div class="welcome-container">
      <!-- <img src="https://virtualbarcodereader.orpalis.com/img/content/Visual_header_home.gif" alt="Barcode Scanner GIF" class="banner-image"> -->
      <h1 class="header">Welcome to Bookyay-demo</h1>
      
      <!-- Carousel or scrolling posters section -->
      <div class="posters-container">
        <div class="poster-wrapper">
          <div v-for="(poster, index) in posters" :key="index" class="poster" @click="redirectToLogin">
            <img :src="poster.image" :alt="'Concert Poster ' + (index + 1)">
            <div class="poster-overlay">
              <p>Click to Book</p>
            </div>
          </div>
        </div>
      </div>

  
      <!-- Buttons for login and register -->
      <div class="auth-buttons">
        
        <router-link to="/login" class="button">Login</router-link>
        <router-link to="/register" class="button">Register</router-link>
      </div>
    </div>
      <h2 class="sub-header">Explore and Book Your Favorite Concerts</h2>
      <p class="description">
        Discover upcoming concerts, book tickets conveniently, 
        and enjoy seamless entry using our QR Ticket Booking System. 
        Whether you're a music enthusiast or just looking for a fun night out, we have something for everyone!
      </p>
    
  </div>
</template>

<script>
export default {
  name: 'Homepage',
  data() {
    return {
      posters: [ // Sample posters data
        { image: 'https://static.promediateknologi.id/crop/0x0:0x0/0x0/webp/photo/p2/01/2023/11/03/F95m-ZSaQAAW8fT-3228084999.jpg' },
        { image: 'https://media.karousell.com/media/photos/products/2023/6/21/cold_play_malaysia_concert_202_1687310359_38d9eece_progressive.jpg' },
        { image: 'https://images.lifestyleasia.com/wp-content/uploads/sites/5/2024/01/10170711/Snapinsta.app_401095539_17939237780745883_6301259909790717595_n_1080.jpg' },
        { image: 'https://static.promediateknologi.id/crop/0x0:0x0/0x0/webp/photo/p2/01/2023/11/03/F95m-ZSaQAAW8fT-3228084999.jpg' },
        { image: 'https://media.karousell.com/media/photos/products/2023/6/21/cold_play_malaysia_concert_202_1687310359_38d9eece_progressive.jpg' },
        { image: 'https://images.lifestyleasia.com/wp-content/uploads/sites/5/2024/01/10170711/Snapinsta.app_401095539_17939237780745883_6301259909790717595_n_1080.jpg' },
        { image: 'https://static.promediateknologi.id/crop/0x0:0x0/0x0/webp/photo/p2/01/2023/11/03/F95m-ZSaQAAW8fT-3228084999.jpg' },
        { image: 'https://media.karousell.com/media/photos/products/2023/6/21/cold_play_malaysia_concert_202_1687310359_38d9eece_progressive.jpg' },
        { image: 'https://images.lifestyleasia.com/wp-content/uploads/sites/5/2024/01/10170711/Snapinsta.app_401095539_17939237780745883_6301259909790717595_n_1080.jpg' },
        { image: 'https://static.promediateknologi.id/crop/0x0:0x0/0x0/webp/photo/p2/01/2023/11/03/F95m-ZSaQAAW8fT-3228084999.jpg' },
        { image: 'https://media.karousell.com/media/photos/products/2023/6/21/cold_play_malaysia_concert_202_1687310359_38d9eece_progressive.jpg' },
        { image: 'https://images.lifestyleasia.com/wp-content/uploads/sites/5/2024/01/10170711/Snapinsta.app_401095539_17939237780745883_6301259909790717595_n_1080.jpg' }
      ]
    };
  },
  methods: {
    redirectToLogin() {
      this.$router.push('/login');
    }
  }
}
</script>

<style scoped>
/* Your existing styles for the dashboard page */
.homepage {
  display: flex;
  flex-direction: column;
  align-items: center;
  justify-content: center;
  text-align: center;
  color: #333333; /* Changed text color for better contrast */
  padding: 0px;
  background-image: url('https://static.vecteezy.com/system/resources/previews/022/778/224/non_2x/stage-shows-empty-dark-blue-purple-pink-background-illustration-ai-generative-free-photo.jpg'); 
  background-size: cover;
  background-position: center;
  margin-top: 100px;
}

.banner-image {
  width: 100%; /* Reduced image size */
  max-width: 100px;
  margin-bottom: 10px;
}

.welcome-container {
  max-width: 1200px;
  margin-bottom: 30px;
  margin-top: 30px;
}

.header {
  font-size: 36px;
  font-weight: bold;
  margin-bottom: 20px;
  margin-top: -20px;
  color: #ffffff;
  background: none; /* Remove the background color */
  color: #ffffff; /* Set text color */
  text-shadow: 0 0 5px #000000;
}

.sub-header {
  font-size: 28px;
  font-weight: bold;
  margin-top: 0px;
  margin-bottom: 0;
  color: #ffffff;
  background: none; /* Remove the background color */
  color: #ffffff; /* Set text color */
  text-shadow: 0 0 5px #000000;
}

.description {
  font-size: 20px;
  color: #ffffff;
  background: none; /* Remove the background color */
  text-shadow: 0 0 5px #000000;
  max-width: 1000px; /* Set a max-width to prevent text from becoming too wide */
  margin: 0 auto; /* Center the description text */
  padding: 0 20px; /* Add padding for better readability */
  box-sizing: border-box; /* Ensure padding doesn't affect the width */
  word-wrap: break-word; /* Break words to prevent overflow */
  overflow-wrap: break-word; /* Ensure proper word wrapping */
  text-align: center; /* Align text to the left */
}

.posters-container {
  overflow: hidden; /* Hide overflowing posters */
}

.poster-wrapper {
  display: flex;
  animation: movePosters 20s linear infinite; /* Animation for moving posters */
}

@keyframes movePosters {
  0% {
    transform: translateX(0);
  }
  100% {
    transform: translateX(-50%); /* Move posters from left to right */
  }
}

.poster {
  position: relative;
  margin: 0 10px;
  cursor: pointer;
}

.poster img {
  width: 200px;
  height: 300px;
  object-fit: cover;
  border-radius: 10px;
  box-shadow: 0 4px 6px rgba(0, 0, 0, 0.1);
  transition: transform 0.4s ease;
}

.poster:hover img {
  transform: scale(1.05);
}

.poster-overlay {
  position: absolute;
  top: 0;
  left: 0;
  width: 100%;
  height: 100%;
  background-color: rgba(0, 0, 0, 0.5);
  display: flex;
  align-items: center;
  justify-content: center;
  border-radius: 10px;
  opacity: 0;
  transition: opacity 0.3s ease;
}

.poster:hover .poster-overlay {
  opacity: 1;
}

.poster-overlay p {
  color: #fff;
  font-size: 18px;
  font-weight: bold;
}

@import url('https://fonts.googleapis.com/css2?family=Raleway:wght@400;700&display=swap');

.button {
  padding: 10px 20px;
  background-color: #8c00ff;
  color: #ffffff;
  font-weight: bold;
  border: none;
  border-radius: 5px;
  letter-spacing: 4px;
  overflow: hidden;
  transition: 0.5s;
  margin-top: 10px;
  cursor: pointer;
  text-decoration: none;
  margin-right: 10px; /* Add margin-right for spacing between buttons */
}

.auth-buttons {
  margin-top: 0px;
  margin-bottom: 5px;
  padding: 20px;
}

.button:hover {
  background: #03e9f4;
  color: #010101;
  box-shadow: 0 0 5px #03e9f4, 0 0 25px #03e9f4;
  -webkit-box-reflect: below 1px linear-gradient(transparent, #0005);
}

/* Media Query for Mobile */
@media (max-width: 768px) {
  
  body {
    overflow: hidden; /* Hide scrollbar */
  }

  .homepage {
    display: flex;
    flex-direction: column;
    align-items: center;
    justify-content: center;
    text-align: center;
    color: #333333;
    padding: 0px;
    margin-top: 50px;
    margin-left: 0px;
    overflow: hidden; /* Hide scrollbar */
  }

  .auth-buttons {
    margin-top: 10px;
    padding: 20px;
  }

  .header {
    font-size: 22px; /* Adjust font size for smaller screens */
    margin-bottom: 30px;
    margin-top: -10px;
  }

  .sub-header {
    font-size: 18px; /* Adjust font size for smaller screens */
    margin-top: 0px;
    max-width: 900px;
  }

  .description {
    font-size: 14px; /* Adjust font size for smaller screens */
    max-width: 400px; /* Set a max-width to prevent text from becoming too wide */
    text-align: center;
    margin-top: 5px;
  }

  .welcome-container {
    max-width: 380px;
  }

  .poster img {
    transition: transform 10.5s ease;
  }
}
</style>