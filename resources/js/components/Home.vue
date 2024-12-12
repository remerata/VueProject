<template>
  <header>
    <nav class="navbar">
      <a class="logo" href="#">
        <img src="/img/loho.png" alt="Logo" class="logo-img">
      </a>
      <span id="hamburger-btn" class="material-symbols-outlined">menu</span>
    </nav>
  </header>

  <section class="hero-section">
    <div class="content boxed-content">
      <div style="text-align: center;">
        <h1>BOOK CLOUD</h1>
        <br>
        <h4>MANAGE YOUR LIBRARY BOOKS</h4>
      </div>
      <br>
    </div>
    <router-link to="/login" class="get-started-btn">GET STARTED</router-link>
  </section>
</template>

<script>
export default {
  name: "Home",
};
</script>

<style scoped>
@import "/public/css/home.css";  /* Use @ to refer to the resources directory */
</style>
