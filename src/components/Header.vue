<template>
  <div class="header">
    <div class="wrapper">
      <div class="header_body">
        <div class="header_logo">
          <router-link to="/"><img src="../assets/img/Logo.png" alt="#" /></router-link>

        </div>
        <div class="header_links">
          <router-link to="/promo">Спецпредложения</router-link>
          <router-link to="/product">Бронирование</router-link>
          <router-link to="/services">Услуги</router-link>
          <router-link to="/contacts">Контакты</router-link>
        </div>
        <div class="header_profile">
          <img src="@/assets/img/Profile.png" alt="#" @click="toggleWindow" />
          <div class="window_reg_log" :class="['active', !isWindowActive ? 'hide' : '']" >
            <router-link to="/promo" class="header_links_mobile">Спецпредложения</router-link>
            <router-link to="/product" class="header_links_mobile">Бронирование</router-link>
            <router-link to="/services" class="header_links_mobile">Услуги</router-link>
            <router-link to="/contacts" class="header_links_mobile">Контакты</router-link>
            <router-link v-if="isLoggedIn" to="/personal" class="profile">Профиль</router-link>
            <router-link v-if="isLoggedIn" to="/logout" class="logout" @click="handleLogout">Выйти</router-link>
            <router-link v-if="!isLoggedIn" to="/login" class="login">Войти</router-link>
            <router-link v-if="!isLoggedIn" to="/registration" class="registration">Регистрация</router-link>
          </div>
        </div>
      </div>
    </div>
  </div>
</template>

<script>
export default {
  name: "Header",
  data() {
    return {
      isWindowActive: false,
      isLoggedIn: false,
    };
  },
  mounted() {
    const token = localStorage.getItem("token");
    if (token) {
      this.isLoggedIn = true;
    }
  },
  methods: {
    toggleWindow() {
      this.isWindowActive = !this.isWindowActive;
    },
    handleLogout() {
      localStorage.clear();
      this.isLoggedIn = false;
      this.isWindowActive = false;
    },
  },
};
</script>
<style scoped>
.hide {
  display: none !important;
}
</style>


