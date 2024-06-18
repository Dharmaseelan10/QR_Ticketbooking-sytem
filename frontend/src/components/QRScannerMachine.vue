<template>
  <div class="qr-scanner-container">
    <!-- Text editor to input scanned QR code data -->
    <textarea v-model="scannedQRData" rows="4" cols="50" class="text-editor" placeholder="Paste your scanned QR code data here..." ref="textInput" @focus="handleFocus"></textarea>
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
    </div>
    <!-- Refresh ticket button -->
    <button @click="refreshTicket" :class="{'valid-button': isValidQRCode, 'invalid-button': !isValidQRCode}" class="refresh-button">{{ buttonMessage }}</button>
  </div>
</template>

<script>
import jsQR from 'jsqr';
export default {
  name: "QRScannerFile",
  data() {
    return {
      scannedQRData: '', // Variable to store scanned QR code data from text editor
      parsedBookingInfo: null, // Variable to store parsed booking information
      isValidQRCode: false // Flag to indicate whether the scanned QR code is valid
    };
  },
  mounted() {
    this.$refs.textInput.focus(); // Focus on the text box when the component is mounted
  },
  watch: {
    scannedQRData(newData) {
      this.parseQRData(newData);
    }
  },
  computed: {
    buttonMessage() {
      return this.isValidQRCode ? 'Valid QR Code' : 'No Valid QR Code detected';
    }
  },
  methods: {
    // Method to parse QR code data
    parseQRData(data) {
      // Parse JSON data from QR code
      try {
        const bookingInfo = JSON.parse(data);
        // Update component's data properties to store the parsed information
        this.parsedBookingInfo = bookingInfo;
        this.isValidQRCode = true; // Set flag to indicate valid QR code
      } catch (error) {
        console.error('Error parsing JSON from QR code:', error);
        this.parsedBookingInfo = null;
        this.isValidQRCode = false; // Set flag to indicate invalid QR code
      }
    },
    // Method to refresh the ticket
    refreshTicket() {
      this.parsedBookingInfo = null; // Clear the parsed booking information
      this.scannedQRData = ''; // Clear the scanned QR code data
      this.isValidQRCode = false; // Reset validity flag
      this.$refs.textInput.focus(); // Focus on the text box after refreshing the ticket
    },
    // Method to handle focus event on textarea
    handleFocus() {
      // Do something when the textarea is focused (optional)
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

.text-editor {
  position: absolute;
  left: -9999px;
}

.qr-info {
  width: 100%;
  text-align: center;
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
  margin-top: 10px;
  margin-bottom: 25px;
  box-shadow: 0px 0px 10px rgba(255, 255, 255, 0.2);
  max-width: 900px; /* Set the maximum width as needed */
  width: 100%; /* Ensure the container takes full width within its parent */
  background-size: cover; /* Cover the entire container while maintaining aspect ratio */
  background-position: center; /* Center the background image */
  background-repeat: no-repeat; /* Prevent the image from repeating */
  display: block; /* Ensure block-level element */
  margin: 0 auto; /* Center horizontally */
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

.refresh-button {
  margin-top: 10px;
  margin-bottom: 10px;
  padding: 10px 20px;
  font-size: 16px;
  border-radius: 5px;
  cursor: pointer;
  display: block; /* Ensure block-level element */
  margin: 0 auto; /* Center horizontally */
  transition: background-color 0.3s ease;
}

.valid-button {
  background-color: green;
  color: white;
}

.invalid-button {
  background-color: red;
  color: white;
}
</style>