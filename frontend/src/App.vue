<template>
  <div id="app">
    <!-- Render the Navbar component -->
    <Navbar />

    <!-- Main content area -->
    <router-view></router-view>
  </div>
</template>

<script>
import Navbar from './components/Navbar.vue';

export default {
  name: 'App',
  components: {
    Navbar
  }
}
</script>

<style>
/* Add your CSS styles for the app */
body {
  margin: 0; /* Remove default body margin */
  overflow: auto; /* Allow scrollbars */
}

#app {
  background-image: url('https://static.vecteezy.com/system/resources/previews/022/778/224/non_2x/stage-shows-empty-dark-blue-purple-pink-background-illustration-ai-generative-free-photo.jpg');
  background-size: cover;
  background-position: center;
  min-height: 100vh; /* Set minimum height to full viewport height */
  min-width: 99vw; /* Set minimum width to full viewport width */
  overflow: auto; /* Allow scrollbars */
}

/* Setting font-family for the entire application */
html, body, #app {
  font-family: -apple-system, BlinkMacSystemFont, 'Segoe UI', Roboto, Oxygen-Sans, Ubuntu, Cantarell, 'Helvetica Neue', sans-serif;
  /* San Francisco is used as a system font in macOS and iOS. The fallback fonts ensure compatibility across different platforms. */
}
</style>
