// src/api/axios.js
import axios from 'axios';

const apiClient = axios.create({
    baseURL: 'http://localhost:8000', // Adjust this to your PHP server URL
    withCredentials: false, // This depends on your CORS settings
    headers: {
        'Accept': 'application/json',
        'Content-Type': 'application/json'
    }
});

export default apiClient;
