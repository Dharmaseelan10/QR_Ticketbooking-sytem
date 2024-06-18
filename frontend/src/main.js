// src/main.js
import { createApp } from 'vue'
import router from './router';
import App from './App.vue';
import apiClient from './api/axios'; // adjust path if you placed it elsewhere
import vue3GoogleLogin from 'vue3-google-login';
const app = createApp(App);
app.config.globalProperties.$api = apiClient; // This makes Axios available on the Vue instance as $api
app.use(vue3GoogleLogin, {
    clientId: '1055104091340-1atmt7h2jqpfqhs6gvu12c4gb3ofbuga.apps.googleusercontent.com'
})
app.use(router);
app.mount('#app');