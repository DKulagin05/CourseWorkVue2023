<template>
  <div>
    <Header/>
    <router-view/>
    <Footer/>
  </div>
</template>

<script>
import Header from "./components/Header.vue";
import Footer from "./components/Footer.vue";
import services from "./pages/Services.vue";
import MainPage from "./pages/MainPage.vue";
import ProductPage from "./pages/ProductPage.vue";
import Registration from "./pages/Registration.vue"
import Login from "./pages/Login.vue";
import AdminPage from "./pages/AdminPage.vue";

export default {
  name: "App",
  components: {
    Header,
    Footer,
    services,
    MainPage,
    ProductPage,
    Registration,
    Login,
    AdminPage
  },
};
</script>

<style>
/* Стили для всего приложения */
</style>

