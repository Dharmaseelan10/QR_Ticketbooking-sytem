import { createRouter, createWebHistory } from 'vue-router';
import Dashboard from './components/Dashboard.vue';
import Login from './components/Login.vue';
import Register from './components/Register.vue';
import Ticket from './components/ticket.vue';
import TicketBooking from './components/ticketbooking.vue';
import QRScan from './components/QRScan.vue';
import QRScanner from './components/QRScanner.vue';
import QRScannerMachine from './components/QRScannerMachine.vue';
import QRScannerFile from './components/QRScannerFile.vue';
import Concert1 from './components/concert1.vue';
import Concert2 from './components/concert2.vue';
import Concert3 from './components/concert3.vue';
import UserQRCode from './components/UserQRCode.vue';
import Navbar from './components/Navbar.vue'; // Import the default Navbar component
import Chatbot from './components/Chatbot.vue'; // Import the default Navbar component



// Pass the Vue app instance to the router
const router = createRouter({
  history: createWebHistory(),
  routes: [
    { path: '/', component: Dashboard },
    { path: '/login', component: Login },
    { path: '/register', component: Register },
    { path: '/ticket', component: Ticket },
    { path: '/ticketbooking', component: TicketBooking },
    { path: '/QRScan', component: QRScan },
    { path: '/QRScanner', component: QRScanner },
    { path: '/QRScannerMachine', component: QRScannerMachine},
    { path: '/QRScannerFile', component: QRScannerFile },
    { path: '/concert1', component: Concert1 },
    { path: '/concert2', component: Concert2 },
    { path: '/concert3', component: Concert3 },
    { path: '/Chatbot', component: Chatbot },
    { path: '/user-qrcode', component: UserQRCode },
  ]
});


export default router;
