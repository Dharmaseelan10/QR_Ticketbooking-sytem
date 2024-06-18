<template>
  <div class="qr-scanner-container">
    <!-- Camera feed -->
    <div class="camera-container">
      <video ref="video" class="camera" autoplay playsinline></video>
    </div>
    <!-- QR code information -->
    <div class="qr-info">
      <h2>QR Code Information</h2>
      <template v-if="parsedBookingInfo">
        <div class="qr-data-container">
          <div class="booking-info">
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
        </div>
      </template>
      <p v-else class="white-text">No booking information available</p>
    </div>
    <!-- Additional Info -->
    <div class="additional-info">
      <h3 class="white-text">How to Use:</h3>
      <p class="white-text">1. Ensure that your camera is enabled.</p>
      <p class="white-text">2. Point the camera towards the QR code.</p>
      <p class="white-text">3. The QR code information will be displayed below.</p>
    </div>
    <!-- Refresh button -->
    <button class="refresh-button" @click="restartCamera">Refresh</button>
  </div>
</template>

<script>
import jsQR from 'jsqr';

export default {
  name: "QRScanner",
  data() {
    return {
      parsedBookingInfo: null // Variable to store parsed booking information
    };
  },
  mounted() {
    // Automatically initialize the camera when component is mounted
    this.initCamera();
  },
  methods: {
    async initCamera() {
  try {
    const stream = await navigator.mediaDevices.getUserMedia({ video: { facingMode: 'environment' } });
    if (this.$refs.video) {
      this.$refs.video.srcObject = stream;
      await new Promise((resolve) => {
        this.$refs.video.onloadedmetadata = () => {
          resolve();
        };
      });
      this.$refs.video.play();
      this.$refs.video.onloadedmetadata = null; // Remove the event listener to prevent multiple calls
      this.showCamera = true; // Show the camera feed
      this.scanQRCode();
    } else {
      console.error('Video element not found.');
    }
  } catch (error) {
    console.error('Failed to initialize camera:', error);
    // Provide a more informative message to the user
    alert('Failed to access the camera. Please make sure you have granted permission to access the camera and are using a secure connection (HTTPS).');
  }
},


    // Method to restart camera
    restartCamera() {
      this.parsedBookingInfo = null;
      this.initCamera();
    },

    // Method to scan QR code
    scanQRCode() {
      const video = this.$refs.video;
      const canvas = document.createElement('canvas');
      const ctx = canvas.getContext('2d');
      const width = video.videoWidth;
      const height = video.videoHeight;
      canvas.width = width;
      canvas.height = height;
      ctx.drawImage(video, 0, 0, width, height);
      const imageData = ctx.getImageData(0, 0, width, height);
      const code = jsQR(imageData.data, width, height);
      if (code) {
        this.parsedBookingInfo = JSON.parse(code.data);
        video.pause(); // Pause the video when QR code is found
      } else {
        console.log('QR code not found');
        this.parsedBookingInfo = null;
        requestAnimationFrame(this.scanQRCode);
      }
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
.camera-container {
  position: relative;
  width: 300px; /* Adjust the size of the camera view */
  height: 300px; /* Adjust the size of the camera view */
  overflow: hidden;
  margin-top: 100px;
}
.camera {
  width: 100%;
  height: 100%;
}
.qr-info {
  width: 100%;
  text-align: center;
  display: flex;
  flex-direction: column;
  color: rgb(255, 255, 255);
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
  color: rgb(1, 1, 1);
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
.qr-info p.white-text {
  font-size: 18px;
  color: rgb(255, 255, 255);
}
.additional-info {
  text-align: center;
  margin-top: 20px;
}
.additional-info h3.white-text {
  font-size: 20px;
  color: rgb(255, 255, 255);
}
.additional-info p.white-text {
  font-size: 18px;
  margin-bottom: 10px;
  color: rgb(255, 255, 255);
}
.refresh-button {
  margin-top: 20px;
  padding: 10px 20px;
  font-size: 16px;
  border: 2px solid #007bff;
  border-radius: 5px;
  background-color: transparent;
  color: #8c00ff;
  cursor: pointer;
}
.refresh-button:hover {
  background: #03e9f4;
    color: #010101;
    box-shadow: 0 0 5px #03e9f4,
                0 0 25px #03e9f4;
     -webkit-box-reflect:below 1px linear-gradient(transparent, #0005);
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
