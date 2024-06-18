<template>
  <div class="concert-info">
    <img src="https://media.karousell.com/media/photos/products/2023/6/21/cold_play_malaysia_concert_202_1687310359_38d9eece_progressive.jpg" alt="Concert 2 Poster" class="concert-poster">
    <h2 class="concert-title">Music of the Spheres World Tour</h2>
    <p class="concert-text1">The Music of the Spheres World Tour represents a monumental moment in the career of global superstar Ed Sheeran. Named after his highly anticipated fourth studio album, "Music of the Spheres," this tour promises to be a spectacular journey through Sheeran's unparalleled musical universe. Spanning continents and captivating audiences across the globe, the tour showcases Sheeran's extraordinary talent as a performer and songwriter.

The tour's title, "Music of the Spheres," hints at Sheeran's ambition to transcend earthly limitations and explore the celestial realms of creativity and expression. With his trademark blend of heartfelt lyrics, soulful melodies, and infectious rhythms, Sheeran invites audiences to join him on a cosmic adventure through the power of music.

From intimate acoustic sets to electrifying stadium performances, the Music of the Spheres World Tour offers something for fans of all ages and musical tastes. With each show meticulously crafted to create an unforgettable experience, Sheeran and his band deliver performances that are as captivating as they are exhilarating.

But the Music of the Spheres World Tour is more than just a series of concerts—it's a celebration of connection, community, and the universal language of music. As Sheeran takes the stage night after night, he brings people together from all walks of life, uniting them in a shared love of song and celebration.

As one of the most anticipated tours in recent memory, the Music of the Spheres World Tour promises to be a testament to Sheeran's enduring talent, creativity, and passion for music. With its dazzling production, unforgettable performances, and infectious energy, this tour is sure to leave a lasting impression on all who are fortunate enough to experience it.</p>
    <p class="concert-text">Dates: Sunday 31st March 2024</p>
    <p class="concert-text">Location: Asia, Europe, Latin America, North America, Australia</p>
    <p class="concert-text">Associated Album: Music of the Spheres</p>
    <p class="concert-text">Attendance: 7.66 million</p>
    <p class="concert-text">No. of Shows: 176</p>
    <p class="concert-text">Producer: Live Nation</p>
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
