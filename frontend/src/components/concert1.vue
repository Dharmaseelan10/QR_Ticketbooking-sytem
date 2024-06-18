<template>
  <div class="concert-info">
    <img src="https://static.promediateknologi.id/crop/0x0:0x0/0x0/webp/photo/p2/01/2023/11/03/F95m-ZSaQAAW8fT-3228084999.jpg" alt="Concert 1 Poster" class="concert-poster">
    <h2 class="concert-title">Ed Sheeran: + - = ÷ × Tour</h2>
    <p class="concert-text1">Ed Sheeran, the acclaimed British singer-songwriter, has carved out a unique niche in the contemporary music landscape with his distinctive blend of heartfelt storytelling and infectious melodies. Born in Halifax, West Yorkshire, Sheeran rose to prominence with his debut album "+", pronounced "Plus", which showcased his remarkable ability to craft deeply personal yet universally relatable songs. His sophomore effort, "x" (pronounced "Multiply"), catapulted him to global superstardom, featuring chart-topping hits like "Thinking Out Loud" and "Photograph." Sheeran's music often explores themes of love, longing, and self-discovery, drawing listeners in with its sincerity and emotional depth.

One of Sheeran's most remarkable talents is his ability to connect with his audience on a profoundly personal level. Whether he's performing in sold-out arenas or intimate venues, his performances exude an authenticity that resonates with fans of all ages. His soulful voice, coupled with his masterful guitar playing, creates an intimate atmosphere that invites listeners to join him on a journey of reflection and introspection.

In addition to his solo work, Sheeran has collaborated with some of the biggest names in the music industry, further cementing his status as a powerhouse talent. His collaborations with artists like Beyoncé, Taylor Swift, and Eminem have yielded some of the most memorable and successful songs of recent years, showcasing his versatility as a musician.

Beyond his musical talents, Sheeran is also known for his philanthropic efforts and down-to-earth demeanor. He has used his platform to raise awareness for various charitable causes, including homelessness and mental health, demonstrating a commitment to making a positive impact on the world beyond the realm of music.

As Sheeran continues to evolve as an artist, his music remains a source of comfort, inspiration, and joy for millions of fans around the globe. With each new release, he continues to push the boundaries of his craft, solidifying his status as one of the most influential and beloved artists of his generation.</p>
    <p class="concert-text">Date: Saturday, 30th March 2024</p>
    <p class="concert-text">Location: Bukit Jalil National Stadium</p>
    <p class="concert-text">Special Guest: Calum Scott</p>
    <p class="concert-text">Presented by: UOB</p>
    <p class="concert-text">Promoted by: AEG Presents and PR Worldwide</p>
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
