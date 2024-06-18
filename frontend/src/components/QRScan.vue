<template>
  <div class="qr-scan-container">
    <!-- Welcome message -->
    <div class="welcome">
      <h1 class="title">Redeem Your Ticket Now!</h1>
      <h2 class="title">Scan Your Ticket Here</h2>
      <p class="info">Scan your ticket to gain access.</p>
      <p class="info">This scanner will display information about the ticket and allow entry.</p>
    </div>
    
    <!-- QR Scanner buttons -->
    <div class="button-container">
      <router-link to="/QRScanner" class="button qr-button">Scan QR Ticket from Camera</router-link>
      <router-link to="/QRScannerFile" class="button qr-button">Scan QR Ticket from File</router-link>
      <router-link to="/QRScannerMachine" class="button qr-button">Scan QR Ticket from Machine</router-link>
    </div>
  </div>
</template>

<script>
export default {
  name: 'QRScan'
}
</script>

<style scoped>
/* Add your scoped styles for the QR scan page */

.qr-scan-container {
  display: flex;
  margin: 100px auto;
  flex-direction: column;
  align-items: center;
  justify-content: center;
}

.welcome {
  width: 100%;
  padding: 20px;
  text-align: center;
  color: #ffffff; /* Set text color */
  text-shadow: 0 0 5px #f403dc74, /* Add shadow effect */
               0 0 25px #f403dc74;
}

.title {
  font-size: 50px;
  font-weight: bold;
  color: rgb(255, 255, 255);
  font-family: 'Arial Black', sans-serif;
  color: #ffffff; /* Set text color */
  text-shadow:  0 0 5px #000000;
}

.info {
  font-size: 35px;
  color: rgb(255, 255, 255);
  font-family: Arial, sans-serif;
  margin-bottom: 0px;
  margin-top: 0px;
}

.button-container {
  margin-top: 30px;
}

.button {
  display: inline-block;
  padding: 20px 40px;
  background-color: #0518f2;
  color: white;
  text-decoration: none;
  margin: 10px;
  border-radius: 10px;
  font-size: 25px;
  font-weight: bold;
  transition: background-color 0.3s ease;
}

.qr-button {
  background-color:  #8c00ff;
}

.button:hover {
  background: #03e9f4;
    color: #010101;
    box-shadow: 0 0 5px #03e9f4,
                0 0 25px #03e9f4;
     -webkit-box-reflect:below 1px linear-gradient(transparent, #0005);
}
@media (max-width: 768px) {


  .welcome {
  width: 100%;
  padding: 20px;
  text-align: center;
  color: #ffffff; /* Set text color */
  text-shadow: 0 0 5px #f403dc74, /* Add shadow effect */
               0 0 25px #f403dc74;
}

.title {
  font-size: 30px;
  font-weight: bold;
  margin-top: -20px;
  color: rgb(255, 255, 255);
  font-family: 'Arial Black', sans-serif;
  color: #ffffff; /* Set text color */
  text-shadow:  0 0 5px #000000;
}

.info {
  font-size: 25px;
  color: rgb(255, 255, 255);
  font-family: Arial, sans-serif;
  margin-bottom: 0px;
  margin-top: 0px;
}

.button-container {
  margin-top: 30px;
  align-items: center;
  
}

.button {
  display: flex;
  padding: 20px 40px;
  background-color: #0518f2;
  color: white;
  text-decoration: none;
  margin: 10px;
  border-radius: 10px;
  font-size: 25px;
  font-weight: bold;
  transition: background-color 0.3s ease;
}

}
</style>
