
<template>
  <div class="qr-scanner-container">
    <!-- Upload QR code from device -->
    <input type="file" accept="image/*" @change="readQRFromFile" class="upload-button">
    <!-- QR code information -->
    <div class="qr-info">
      <h2>QR Code Information</h2>
      <template v-if="qrData">
        <div class="qr-data-container">
          <div v-if="parsedBookingInfo" class="booking-info">
            <div class="poster-container">
              <img :src="parsedBookingInfo.poster" alt="Concert Poster" class="poster">
            </div>
            <div class="details-container">
              <h5>Concert Tickets</h5>
              <p><strong>Concert Name:</strong> {{ parsedBookingInfo.concertName }}</p>
              <p><strong>Name:</strong> {{ parsedBookingInfo.name }}</p>
              <p><strong>Phone Number:</strong> {{ parsedBookingInfo.phoneNumber }}</p>
              <p><strong>Selected Seat:</strong> {{ parsedBookingInfo.selectedSeat }}</p>
            </div>
          </div>
          <p v-else class="white-text">No booking information available</p>
        </div>
      </template>
    </div>
    <!-- Additional Info -->
    <div class="additional-info">
      <h3 class="white-text">How to Use:</h3>
      <p class="white-text">1. Click the button above to choose a file.</p>
      <p class="white-text">2. Select an image containing a QR code.</p>
      <p class="white-text">3. The QR code information will be displayed below.</p>
    </div>
  </div>
</template>
<script>
import jsQR from 'jsqr';
export default {
  name: "QRScannerFile",
  data() {
    return {
      qrData: null, // Variable to store scanned QR code data
      parsedBookingInfo: null // Variable to store parsed booking information
    };
  },
  methods: {
    // Method to read QR code from file
    readQRFromFile(event) {
      const file = event.target.files[0];
      if (!file) return;
      const reader = new FileReader();
      reader.onload = (e) => {
        this.qrData = e.target.result;
        this.parseQRData(e.target.result);
      };
      reader.readAsDataURL(file);
    },
    // Method to parse QR code data
    parseQRData(data) {
      const img = new Image();
      img.onload = () => {
        const canvas = document.createElement('canvas');
        const ctx = canvas.getContext('2d');
        canvas.width = img.width;
        canvas.height = img.height;
        ctx.drawImage(img, 0, 0, img.width, img.height);
        const imageData = ctx.getImageData(0, 0, img.width, img.height);
        const code = jsQR(imageData.data, imageData.width, imageData.height);
        if (code) {
          this.qrData = code.data;
          // Parse JSON data from QR code
          try {
            const bookingInfo = JSON.parse(code.data);
            // Update component's data properties to store the parsed information
            this.parsedBookingInfo = bookingInfo;
          } catch (error) {
            console.error('Error parsing JSON from QR code:', error);
          }
        } else {
          console.log('QR code not found');
          this.qrData = null;
          this.parsedBookingInfo = null;
        }
      };
      img.src = data;
    }
  }
};
</script>
<style scoped>
.qr-scanner-container {
  display: flex;
  flex-direction: column;
  align-items: center;
  justify-content: center;
  height: 100vh;
}
.upload-button {
  margin-bottom: 20px;
}
.qr-info {
  width: 100%;
  text-align: center;
  display: flex;
  flex-direction: column;
  align-items: center;
  justify-content: center; /* Center vertically */
}
.qr-info h2 {
  font-size: 24px;
  margin-bottom: 20px;
  color: rgb(255, 255, 255);
}
.qr-info .qr-data-container {
  background-image: url('https://www.clker.com/cliparts/L/7/v/y/9/u/blank-ticket-hi.png');
  background-color: #ffe600;
  padding: 20px;
  border-radius: 15px;
  margin-bottom: 25px;
  box-shadow: 0px 0px 10px rgba(255, 255, 255, 0.2);
  max-width: 900px; /* Set the maximum width as needed */
  width: 100%; /* Ensure the container takes full width within its parent */
  background-size: cover; /* Cover the entire container while maintaining aspect ratio */
  background-position: center; /* Center the background image */
  background-repeat: no-repeat; /* Prevent the image from repeating */
}

.qr-info h5 {
  font-size: 24px;
  text-align: left;
  color: rgb(0, 0, 0);
}

.booking-info {
  display: flex;
  align-items: center;
}
.poster-container {
  margin-right: 20px;
}
.poster {
  max-width: 200px;
  height: auto;
  border-radius: 5px;
}
.details-container {
  text-align: left;
  flex-grow: 1;
  font-size: 20px;
  color: rgb(0, 0, 0);
}
.details-container p {
  margin: 5px 0;
}
.additional-info {
  text-align: center;
  margin-top: 20px;
  
}
.additional-info h3 {
  font-size: 20px;
  color: rgb(255, 255, 255);
}
.additional-info p {
  font-size: 18px;
  margin-bottom: 10px;
  color: rgb(255, 255, 255);
}
.white-text {
  color: rgb(255, 255, 255);
}

/* Media Query for Mobile */
@media (max-width: 768px) {
  .qr-scanner-container {
  display: flex;
  flex-direction: column;
  align-items: center;
  justify-content: center;
  margin-top: 75px;
  height: 100vh;
}
.upload-button {
  margin-bottom: 20px;
}
.qr-info {
  width: 100%;
  text-align: center;
  display: flex;
  flex-direction: column;
  align-items: center;
  justify-content: center; /* Center vertically */
}
.qr-info h2 {
  font-size: 20px;
  margin-bottom: 20px;
  color: rgb(255, 255, 255);
}
.qr-info .qr-data-container {
  background-color: #ffe600;
  padding: 10px;
  border-radius: 15px;
  margin-bottom: 25px;
  box-shadow: 0px 0px 10px rgba(255, 255, 255, 0.2);
  height: 400px;
  max-width: 200px; /* Set the maximum width as needed */
  width: 100%; /* Ensure the container takes full width within its parent */
  display: flex;
  flex-direction: row;
  align-items: center;
  
}

.qr-info .qr-data-container .poster {
  width: 100px; /* Adjust the width as needed */
  height: auto;
  margin-bottom: 0px;
  border-radius: 5px;
}

.qr-info h5 {
  font-size: 20px;
  text-align: center;
  margin-top: 5px;
  margin-bottom: 5px;
  color: rgb(0, 0, 0);
}

.booking-info {
  display: flex;
  flex-direction: column;
  align-items: center;
  justify-content: center;
  margin-top: 20px;
}
.details-container {
  text-align: center;
  margin-left: 2px;
  font-size: 18px;
  color: rgb(0, 0, 0);
}
.details-container p {
  margin: 5px 0;
}
.additional-info {
  text-align: center;
  margin-top: 20px;
}
.additional-info h3 {
  font-size: 18px;
  color: rgb(255, 255, 255);
}
.additional-info p {
  font-size: 18px;
  margin-bottom: 10px;
  color: rgb(255, 255, 255);
}
.white-text {
  color: rgb(255, 255, 255);
}

.poster {
  max-width: 150px;
  height: auto;
  border-radius: 5px;
  margin-bottom: 2px;
}

}
</style>