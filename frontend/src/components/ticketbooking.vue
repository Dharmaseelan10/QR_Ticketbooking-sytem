<template>
  <div class="ticket-booking">
    <div class="form-container">
      <h2>Book Ticket</h2>
      <select v-model="selectedConcert" @change="selectConcert" class="select-concert">
        <option value="">Choose Concert</option>
        <option v-for="concert in concerts" :value="concert.id" :key="concert.id">{{ concert.name }}</option>
      </select>
      <div v-if="selectedPoster" class="concert-poster">
        <img :src="selectedPoster" alt="Concert Poster">
      </div>
      <div v-if="selectedConcert" class="booking-form">
        <label for="name">Name:</label>
        <input type="text" id="name" v-model="name">
        <label for="phoneNumber">Phone Number:</label>
        <input type="text" id="phoneNumber" v-model="phoneNumber">
        <label for="seat">Choose Seat:</label>
        <select v-model="selectedSeat" class="select-seat">
          <option v-for="seat in availableSeats" :value="seat" :key="seat">{{ seat }}</option>
        </select>
        <button @click="bookTicket" class="book-button">Book Ticket</button>
        <button @click="resetForm" class="book-another-button">Book Another Ticket for this Concert</button>
      </div>
      <div v-if="successMessage" class="success-message">
        {{ successMessage }}
      </div>
      <div v-if="errorMessage" class="error-message">
        {{ errorMessage }}
      </div>
      <div id="qrCode" class="qr-container" v-if="qrData"></div>

      <div v-if="qrData">
        <p>QR code successfully saved in device</p>
      </div>
    </div>
  </div>
</template>


<script>
import axios from 'axios';
import QRCode from 'qrcodejs2';

export default {
  data() {
    return {
      concerts: [
        { 
          id: 1, 
          name: 'Concert 1 (30th March 2024) Ed Sheeran Tour', 
          image: 'https://static.promediateknologi.id/crop/0x0:0x0/0x0/webp/photo/p2/01/2023/11/03/F95m-ZSaQAAW8fT-3228084999.jpg',
          concertName: 'Ed Sheeran Tour',
          buttonText: 'Book Tickets',
          seats: Array.from({ length: 10 }, (_, i) => i + 1)
        },
        { 
          id: 2, 
          name: 'Concert 2 (31st March 2024) Music of the Spheres World Tour', 
          image: 'https://media.karousell.com/media/photos/products/2023/6/21/cold_play_malaysia_concert_202_1687310359_38d9eece_progressive.jpg',
          concertName: 'Music of the Spheres World Tour',
          buttonText: 'Book Tickets',
          seats: Array.from({ length: 10 }, (_, i) => i + 1)
        },
        { 
          id: 3, 
          name: 'Concert 3 (10th June 2024) Tom Jones Ages & Stages Tour', 
          image: 'https://images.lifestyleasia.com/wp-content/uploads/sites/5/2024/01/10170711/Snapinsta.app_401095539_17939237780745883_6301259909790717595_n_1080.jpg',
          concertName: 'Tom Jones Ages & Stages Tour',
          buttonText: 'Book Tickets',
          seats: Array.from({ length: 10 }, (_, i) => i + 1)
        }
      ],
      selectedConcert: '',
      selectedPoster: '',
      name: '',
      phoneNumber: '',
      selectedSeat: '',
      successMessage: '',
      qrData: '',
      errorMessage: '',
      userId: null,
      availableSeats: []  // Initializing availableSeats to ensure it's defined
    };
  },

  mounted() {
    this.fetchUserId(); // Call this method when the component mounts
  },
  methods: {

    fetchUserId() {
      this.userId = localStorage.getItem('userId'); // Fetch userId from localStorage
      if (!this.userId) {
        console.error("User not logged in"); // Log error or handle as required
      }
    },

    selectConcert() {
      const selected = this.concerts.find(concert => concert.id === parseInt(this.selectedConcert));
      if (selected) {
        this.selectedPoster = selected.image;
        this.fetchSeats(selected.id);
      }
    },
    fetchSeats(concertId) {
      axios.get(`${process.env.VUE_APP_BACKEND_URL}getBookedSeats.php?concertId=${concertId}`)
        .then(response => {
          const bookedSeatsArray = response.data.bookedSeats;
          this.availableSeats = this.calculateAvailableSeats(bookedSeatsArray, this.concerts.find(concert => concert.id === concertId).seats);
        })
        .catch(error => {
          this.errorMessage = 'Failed to fetch booked seats. Please try again later.';
        });
    },
    calculateAvailableSeats(bookedSeats, allSeats) {
      return allSeats.filter(seat => !bookedSeats.includes(seat));
    },
  bookTicket() {
  console.log("User ID:", this.userId); 
  const selected = this.concerts.find(concert => concert.id === parseInt(this.selectedConcert));
  if (selected) {
    const bookingInfo = {
      concertId: selected.id,
      concertName: selected.concertName,
      poster: this.selectedPoster,
      name: this.name,
      phoneNumber: this.phoneNumber,
      selectedSeat: this.selectedSeat,
      userId: this.userId // Ensure you have userId defined or fetched
    };
    
    axios.post(`${process.env.VUE_APP_BACKEND_URL}bookticket.php`, bookingInfo)
        
    
      .then(response => {
        
        this.successMessage = response.data.message;
        this.qrData = JSON.stringify(bookingInfo); // Assuming you want to encode this info
        this.$nextTick(() => {
          new QRCode('qrCode', {
            text: this.qrData,
            width: 250,
            height: 250,
            colorDark: "#000000",
            colorLight: "#ffffff"
          });

          this.$nextTick(() => {
            this.saveQRCode(selected.concertName, this.selectedSeat, this.name);
          }); 

          this.$nextTick(() => {
            let qrCodeElement = document.getElementById('qrCode'); // Correctly defining qrCodeElement
            const canvas = qrCodeElement.querySelector('canvas');
            const context = canvas.getContext('2d');
            const borderSize = 10; // Size of the border
            const width = canvas.width + borderSize * 2;
            const height = canvas.height + borderSize * 2;

            // Create a new canvas
            let newCanvas = document.createElement('canvas');
            newCanvas.width = width;
            newCanvas.height = height;
            let newContext = newCanvas.getContext('2d');

            // Fill new canvas with white background
            newContext.fillStyle = '#ffffff';
            newContext.fillRect(0, 0, width, height);

            // Draw the original QR code on the new canvas, centered
            newContext.drawImage(canvas, borderSize, borderSize);

            // Replace old canvas with new canvas
            qrCodeElement.innerHTML = '';
            qrCodeElement.appendChild(newCanvas);
          });
        });
      })
      .catch(error => {
        this.errorMessage = error.response ? error.response.data.error : 'Failed to book ticket. Please try again later.';
      });
  }
},

saveQRCode(concertName, seat, userName,) {
  let qrCodeElement = document.getElementById('qrCode');
  let originalCanvas = qrCodeElement.querySelector('canvas');
  if (originalCanvas) {
    const borderSize = 10;
    const width = originalCanvas.width + borderSize * 2;
    const height = originalCanvas.height + borderSize * 2;

    let newCanvas = document.createElement('canvas');
    newCanvas.width = width;
    newCanvas.height = height;
    let newContext = newCanvas.getContext('2d');

    newContext.fillStyle = '#ffffff';
    newContext.fillRect(0, 0, width, height);
    newContext.drawImage(originalCanvas, borderSize, borderSize);

    const dataUrl = newCanvas.toDataURL('image/png');
    
console.log(concertName,this.userId,seat);
    // Send QR code data to the backend to save it
    axios.post(`${process.env.VUE_APP_BACKEND_URL}saveQRCode.php`, {
      image: dataUrl,
      filename: `${concertName.replace(/\s+/g, '_')}_${this.selectedSeat}_${userName.replace(/\s+/g, '_')}.png`,
      name: this.name,
      phoneNumber: this.phoneNumber,
      userId: this.userId,
      selectedSeat: this.selectedSeat,
      concertName:concertName,
    });

    // Download QR code on the client side
    const data = atob(dataUrl.substring('data:image/png;base64,'.length)),
          asArray = new Uint8Array(data.length);
    for (let i = 0, len = data.length; i < len; ++i) {
      asArray[i] = data.charCodeAt(i);
    }
    const blob = new Blob([asArray.buffer], { type: 'image/png' });
    const url = URL.createObjectURL(blob);
    const link = document.createElement('a');
    link.href = url;
    link.download = `${concertName.replace(/\s+/g, '_')}_${seat}_${userName.replace(/\s+/g, '_')}.png`;
    document.body.appendChild(link);
    link.click();
    document.body.removeChild(link);
  }
},

    resetForm() {
      this.selectedConcert = '';
      this.selectedPoster = '';
      this.name = '';
      this.phoneNumber = '';
      this.selectedSeat = '';
      this.successMessage = '';
      this.qrData = '';
      this.errorMessage = '';
    }
  }
};
</script>

<style scoped>
.ticket-booking {
  margin: 20px;
}

.form-container {
  max-width: 410px;
  margin: 100px auto;
  padding: 20px;
  background-color:#0000007a;
  /* background-image: url('https://media.istockphoto.com/id/967486898/vector/studio-black-mockup.jpg?s=612x612&w=0&k=20&c=YN9LpbeGu-Kb1uTchJE6EKUqaSDRsEH7vqSkcVwVTOg='); */
  border-radius: 10px;
  box-shadow: 0 0 10px rgba(0, 0, 0, 0.1);
  border-radius: 5px;
  box-shadow: 0 2px 4px rgba(0, 0, 0, 0.1);
  color: #000000; /* Text color */
}

p {
        color: white;
    }

h2 {
  text-align: center;
  margin-bottom: 20px;
  color: #ffffff; /* Text color */
} 


.select-concert,
.select-seat {
  width: 100%;
  margin-bottom: 10px;
  padding: 8px;
  border: 1px solid #555555; /* Adjust border color */
  border-radius: 5px;
  background-color: #ffffff; /* Adjust background color */
  color: #000000; /* Text color */
}

.concert-poster img {
  width: 100%;
  height: auto;
  margin-top: 10px;
  border: 1px solid #ffffff; /* Adjust border color */
  border-radius: 5px;
}

.booking-form label {
  display: block;
  margin-bottom: 5px;
  color: #ffffff; /* Text color */
}

.booking-form input,
.booking-form select {
  width: 98%;
  padding: 8px;
  margin-bottom: 10px;
  border: 1px solid #555555; /* Adjust border color */
  border-radius: 5px;
  background-color: #ffffff; /* Adjust background color */
  color: #000000; /* Text color */
}

.book-button,
.book-another-button {
  width: 100%;
  padding: 10px;
  background-color: #007bff;
  color: #ffffff;
  border: none;
  border-radius: 5px;
  cursor: pointer;
}

.book-another-button {
  margin-top: 10px;
  background-color: #28a745;
  margin-bottom: 10px;
}

.success-message {
  margin-top: 10px;
  color: #28a745;
  font-weight: bold;
  text-align: center;
}

.qr-container {
  display: block;
  margin-top: 20px;
  margin-left: auto;
  margin-right: auto;
  
  background-color: #ffffff; /* White background */
  width: 260px; /* Since your QR code is 250px + 5px padding on each side */
  height: 260px; /* Same as width */
}


</style>
