<template>
  <div class="concert-info">
    <img src="https://images.lifestyleasia.com/wp-content/uploads/sites/5/2024/01/10170711/Snapinsta.app_401095539_17939237780745883_6301259909790717595_n_1080.jpg" alt="Concert 3 Poster" class="concert-poster">
    <h2 class="concert-title">Tom Jones Ages & Stages Tour</h2>
    <p class="concert-text1">The Tom Jones Ages & Stages Tour marks a milestone in the legendary career of one of music's most iconic performers. Named after his acclaimed album "Ages & Stages," this tour showcases Tom Jones's enduring talent, charisma, and timeless appeal as he takes audiences on a journey through the various stages of his remarkable career.

With a career spanning over six decades, Tom Jones has established himself as a true music icon, known for his powerful voice, dynamic stage presence, and electrifying live performances. From his early hits like "It's Not Unusual" and "What's New Pussycat?" to later classics such as "Delilah" and "Sex Bomb," Jones has captivated audiences around the world with his soulful interpretations and undeniable charm.

The Ages & Stages Tour offers fans a rare opportunity to experience the full breadth of Jones's musical legacy, as he performs a diverse selection of songs from throughout his career. From beloved classics to hidden gems, each performance is a testament to Jones's remarkable versatility and enduring appeal.

But the Ages & Stages Tour is more than just a retrospective of past hits—it's a celebration of Jones's continued relevance and vitality as an artist. With his timeless style and magnetic stage presence, Jones proves that age is just a number as he continues to captivate audiences of all ages with his electrifying performances.

As one of the most anticipated tours of the year, the Tom Jones Ages & Stages Tour promises to be a thrilling celebration of music, nostalgia, and the enduring legacy of one of music's true legends. With its unforgettable performances, infectious energy, and timeless appeal, this tour is sure to leave a lasting impression on fans old and new alike.</p>
    <p class="concert-text">Dates: Thu, June 10, 2024</p>
    <p class="concert-text">Location: Europe, North America, Asia</p>
    <p class="concert-text">Associated Album: Ages & Stages</p>
    <p class="concert-text">Attendance: 5.2 million</p>
    <p class="concert-text">No. of Shows: 120</p>
    <p class="concert-text">Producer: Global Entertainment</p>
    <button @click="bookTicket" class="book-ticket-button">Book Ticket</button>
    <button @click="bookThroughWhatsApp" class="whatsapp-booking-button">Book through WhatsApp</button>
  </div>
</template>

<script>
export default {
  methods: {
    bookTicket() {
      this.$router.push('/ticketbooking');
    },
    bookThroughWhatsApp() {
      window.open('https://wa.me/0104691403', '_blank');
    }
  }
}
</script>

<style scoped>
/* Add your scoped styles for the concert1 page */
.concert-info {
  margin: 50px;
  padding: 20px;
  border: 1px solid #ffffff;
  border-radius: 5px;
  color: #ffffff; /* Set text color to white */
}

.concert-poster {
  width: 100%;
  height: auto;
  margin-bottom: 20px;
}

.concert-title {
  color: #ffffff; /* Set title text color to white */
  text-align: center;
}

.concert-text1 {
  color: #ffffff; /* Set text color to white */
  font-size: 16px;
  justify-content: center;
  text-align: center;
}
.concert-text {
  color: #ffffff; /* Set text color to white */
  font-size: 16px;
  justify-content: center;
  
}

.book-ticket-button, .whatsapp-booking-button {
  padding: 10px 20px;
  font-size: 16px;
  margin-right: 10px; /* Add margin between buttons */
  background-color:  #8c00ff;
  color: #ffffff;
  border: none;
  border-radius: 5px;
  cursor: pointer;
  transition: background-color 0.3s ease;
}

.book-ticket-button:hover, .whatsapp-booking-button:hover {
    background: #03e9f4;
    color: #010101;
    box-shadow: 0 0 5px #03e9f4,
                0 0 25px #03e9f4;
     -webkit-box-reflect:below 1px linear-gradient(transparent, #0005);
}

@media (max-width: 768px) {
.concert-info {
  margin: 50px;
  margin-top: 70px;
  padding: 10px;
  border: 1px solid #ffffff;
  border-radius: 5px;
  color: #ffffff; /* Set text color to white */
}

.concert-text {
  color: #ffffff; /* Set text color to white */
  font-size: 12px;
  justify-content: center;
  margin-top: 10px;
}

.concert-text1 {
  color: #ffffff; /* Set text color to white */
  font-size: 12px;
  justify-content: center;
  margin-bottom: 50px;
}
.book-ticket-button, .whatsapp-booking-button {
  padding: 10px 20px;
  font-size: 12px;
  margin-right: 10px; /* Add margin between buttons */
  background-color:  #8c00ff;
  color: #ffffff;
  border: none;
  border-radius: 5px;
  cursor: pointer;
  transition: background-color 0.3s ease;
}

}

</style>
