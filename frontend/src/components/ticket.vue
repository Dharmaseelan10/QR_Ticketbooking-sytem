<template>
  <div class="ticket">
  <div class="concert-container">
    <h2 class="title">Concert Booking</h2>
    <p class="info">Explore the upcoming concerts and book your tickets.</p>

    <!-- Concert cards -->
    <div class="concert-cards">
      <div v-for="concert in concerts" :key="concert.id" class="concert-card" @click="navigateToConcert(concert.id)">
        <img :src="concert.image" :alt="concert.name" class="concert-image">
        <h3 class="concert-name">{{ concert.concertName }}</h3>
        <button class="concert-button">{{ concert.buttonText }}</button>
      </div>
    </div>
  </div>
</div>
</template>

<script>
export default {
  name: 'Ticket',
  data() {
    return {
      concerts: [
        { 
          id: 1, 
          name: 'Concert 1', 
          image: 'https://static.promediateknologi.id/crop/0x0:0x0/0x0/webp/photo/p2/01/2023/11/03/F95m-ZSaQAAW8fT-3228084999.jpg',
          concertName: 'Ed Sheeran Tour',
          buttonText: 'Explore'
        },
        { 
          id: 2, 
          name: 'Concert 2', 
          image: 'https://media.karousell.com/media/photos/products/2023/6/21/cold_play_malaysia_concert_202_1687310359_38d9eece_progressive.jpg',
          concertName: 'Music of the Spheres World Tour',
          buttonText: 'Explore'
        },
        { 
          id: 3, 
          name: 'Concert 3', 
          image: 'https://images.lifestyleasia.com/wp-content/uploads/sites/5/2024/01/10170711/Snapinsta.app_401095539_17939237780745883_6301259909790717595_n_1080.jpg',
          concertName: 'Tom Jones Ages & Stages Tour',
          buttonText: 'Explore'
        },
      ]
    };
  },
  methods: {
    navigateToConcert(concertId) {
      if (concertId <= 3) {
        this.$router.push(`/concert${concertId}`);
      }
    }
  }
}
</script>

<style scoped>
/* Add your scoped styles for the concert booking page */

body {
  margin: 0; /* Remove default body margin */
  
}

.concert-container {
  display: flex;
  flex-direction: column;
  align-items: center;
  justify-content: center;
  padding-top: 100px; /* Add space from the top */
}


.title {
  font-size: 50px;
  font-weight: bold;
  color: #ffffff; /* Set title color to contrast with white */
  font-family: 'Arial Black', sans-serif;
  margin-bottom: 3px;
  margin-top: 5px;
  color: #ffffff; /* Set text color */
  text-shadow:  0 0 5px #000000;
}

.info {
  font-size: 35px;
  color: #ffffff; /* Set info color to contrast with white */
  font-family: Arial, sans-serif;
  margin-bottom: 0px;
  margin-top: 0px;
  color: #ffffff; /* Set text color */
  text-shadow:  0 0 5px #000000;
}

.concert-cards {
  display: flex;
  justify-content: center;
  gap: 25px;
  margin-top: 30px;
}

.concert-card {
  width: 250px;
  height: 450px; /* Increased height to accommodate button */
  background-color: #ffffff; /* Set card background color to white */
  border-radius: 10px;
  overflow: hidden;
  display: flex;
  flex-direction: column;
  justify-content: space-between; /* Ensures space between image and text */
  align-items: center;
  cursor: pointer;
  transition: transform 0.3s ease;
  box-shadow: 0 4px 8px rgba(0, 0, 0, 0.1); /* Add subtle shadow for depth */
}

.concert-card:hover {
  transform: scale(1.1);
  background: #ffffff;
    color: #ffffff;
    box-shadow: 0 0 5px #ff00fb,
                0 0 25px #d400ff;
}

.concert-image {
  width: 100%;
  height: auto; /* Ensures image maintains aspect ratio */
  object-fit: cover;
  border-radius: 10px 10px 0 0; /* Rounds top corners */
}

.concert-name {
  font-size: 20px;
  color: #333333; /* Set concert name color to contrast with white */
  text-align: center;
  margin-top: 10px;
}

.concert-button {
  padding: 10px 20px;
  background-color: #8c00ff; /* Set button background color to contrast with white */
  color: #ffffff; /* Set button text color to contrast with button background */
  border: none;
  border-radius: 10px 10px 10px 10px; /* Rounds bottom corners */
  cursor: pointer;
  transition: background-color 0.3s ease;
  margin-bottom: 10px;
}

.concert-button:hover{
    background: #03e9f4;
    color: #010101;
    box-shadow: 0 0 5px #03e9f4,
                0 0 25px #03e9f4;
     -webkit-box-reflect:below 1px linear-gradient(transparent, #0005);
}


@media (max-width: 768px) {

  .title {
  font-size: 50px;
  font-weight: bold;
  color: #ffffff; /* Set title color to contrast with white */
  font-family: 'Arial Black', sans-serif;
  margin-bottom: 3px;
  margin-top: -20px;
  color: #ffffff; /* Set text color */
  text-shadow:  0 0 5px #000000;
}

  .info {
  font-size: 35px;
  color: #ffffff; /* Set info color to contrast with white */
  font-family: Arial, sans-serif;
  margin-bottom: 0px;
  margin-top: 0px;
  text-align: center;
  color: #ffffff; /* Set text color */
  text-shadow:  0 0 5px #000000;
}
  
  .concert-cards {
    flex-direction: column; /* Arrange cards from top to bottom */
    align-items: center; /* Center cards horizontally */
    gap: 15px; /* Reduce gap between cards */
  }

  .concert-card {
    width: 200px; /* Decrease card width */
    height: auto; /* Allow card height to adjust based on content */
  }

  .concert-name {
    font-size: 16px; /* Decrease concert name font size */
  }

  .concert-button {
    padding: 8px 16px; /* Decrease button padding */
    font-size: 14px; /* Decrease button font size */
  }
}
</style>
