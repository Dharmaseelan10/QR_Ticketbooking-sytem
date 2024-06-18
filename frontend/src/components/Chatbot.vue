<template>
    <div class="chatbot">
      <div class="header">
        <img src="https://media.istockphoto.com/id/1445426863/vector/chat-bot-vector-logo-design-concept.jpg?s=612x612&w=0&k=20&c=XDdfzS4lNW9yxQ0BQGZq9KMLL4bJ8ywXlYdAhBSuoCA=" alt="Chatbot Logo" class="logo">
        <h1 class="title">Chatbot</h1>
      </div>
      <div class="chat-container">
        <div class="message bot-bubble">Hi, I'm your chatbot. Please choose an option:</div>
        <div v-for="(message, index) in chatMessages" :key="index" class="message" :class="{ 'user-message': message.isUser }">
          <div v-if="message.isUser" class="user-bubble">{{ message.text }}</div>
          <div v-else class="bot-bubble">{{ message.text }}</div>
        </div>
        <div v-if="loading" class="loading-indicator">Processing QR code...</div>
      </div>
      <div class="options-container">
        <button @click="showConcertDetails(1)">Concert 1</button>
        <button @click="showConcertDetails(2)">Concert 2</button>
        <button @click="showConcertDetails(3)">Concert 3</button>
        <button @click="scanQRCode">Scan QR Code</button>
      </div>
      <input type="file" accept="image/*" style="display: none" ref="qrInput" @change="handleQRImage" />
    </div>
  </template>
  
  <script>
  import jsQR from 'jsqr';
  
  export default {
    data() {
      return {
        chatMessages: [],
        loading: false,
        concerts: [
          {
            id: 1,
            name: "Ed Sheeran: + - = ÷ × Tour",
            date: "Saturday, 30th March 2024",
            location: "Bukit Jalil National Stadium",
            specialGuest: "Calum Scott",
            presentedBy: "UOB",
            promotedBy: "AEG Presents and PR Worldwide"
          },
          {
            id: 2,
            name: "Music of the Spheres World Tour",
            date: "Sunday, 31st March 2024",
            location: "Asia, Europe, Latin America, North America, Australia",
            associatedAlbum: "Music of the Spheres",
            attendance: "7.66 million",
            numberOfShows: 176,
            producer: "Live Nation"
          },
          {
            id: 3,
            name: "Tom Jones Ages & Stages Tour",
            date: "Thu, June 10, 2024",
            location: "Europe, North America, Asia",
            associatedAlbum: "Ages & Stages",
            attendance: "5.2 million",
            numberOfShows: 120,
            producer: "Global Entertainment"
          }
        ]
      };
    },
    methods: {
      showMessage(text, isUser = false) {
        this.chatMessages.push({ text, isUser });
      },
      showConcertDetails(concertId) {
        const concert = this.concerts.find(concert => concert.id === concertId);
        if (concert) {
          this.showMessage(`Concert Name: ${concert.name}`);
          for (const key in concert) {
            if (key !== 'id' && key !== 'name') {
              this.showMessage(`${key}: ${concert[key]}`);
            }
          }
        } else {
          this.showMessage("Invalid selection. Please choose a valid concert.");
        }
        this.showMessage('', false); // Add a line break after response
      },
      scanQRCode() {
        this.$refs.qrInput.click();
      },
      handleQRImage(event) {
        this.loading = true;
        const file = event.target.files[0];
        const reader = new FileReader();
        reader.onload = () => {
          const qrDataUrl = reader.result;
          const img = new Image();
          img.onload = () => {
            const canvas = document.createElement('canvas');
            const ctx = canvas.getContext('2d');
            canvas.width = img.width;
            canvas.height = img.height;
            ctx.drawImage(img, 0, 0, img.width, img.height);
            const imageData = ctx.getImageData(0, 0, img.width, img.height);
            const code = jsQR(imageData.data, img.width, img.height);
            if (code) {
              this.loading = false;
              const qrData = JSON.parse(code.data);
              this.showMessage(`QR Code Data: ${JSON.stringify(qrData)}`);
            } else {
              this.loading = false;
              this.showMessage('No QR code found in the image.');
            }
            this.showMessage('', false); // Add a line break after response
          };
          img.src = qrDataUrl;
        };
        reader.readAsDataURL(file);
      }
    }
  };
  </script>
  
  <style scoped>
  .chatbot {
    display: flex;
    flex-direction: column;
    align-items: center;
  }
  
  .header {
    display: flex;
    align-items: center;
    margin-bottom: 20px;
  }
  
  .logo {
    width: 50px;
    height: 50px;
    margin-right: 10px;
  }
  
  .title {
    font-size: 24px;
    font-weight: bold;
  }
  
  .chat-container {
    margin-bottom: 20px;
    border: 1px solid #ccc;
    border-radius: 5px;
    padding: 10px;
    width: 300px;
    max-height: 300px;
    overflow-y: auto;
  }
  
  .message {
    margin-bottom: 5px;
  }
  
  .user-bubble {
    background-color: #007bff;
    color: #fff;
    padding: 10px;
    border-radius: 10px 10px 10px 0;
  }
  
  .bot-bubble {
    background-color: #f0f0f0;
    color: #000;
    padding: 10px;
    border-radius: 10px 10px 0 10px;
  }
  
  .options-container {
    display: flex;
    gap: 10px;
  }
  
  button {
    padding: 10px 20px;
    background-color: #007bff;
    color: #fff;
    border: none;
    border-radius: 5px;
    cursor: pointer;
  }
  
  button:hover {
    background-color: #0056b3;
  }
  
  input[type="file"] {
    display: none;
  }
  
  .loading-indicator {
    margin-top: 10px;
    color: #007bff;
  }
  
  .options-container {
    display: flex;
    flex-wrap: wrap;
    gap: 10px;
  }
  
  button {
    padding: 10px 20px;
    background-color: #007bff;
    color: #fff;
    border: none;
    border-radius: 5px;
    cursor: pointer;
  }
  
  button:hover {
    background-color: #0056b3;
  }
  </style>
  