<template>
  <div class="header">
    <div class="wrapper">
      <div class="header_body">
        <div class="header_logo">
          <router-link to="/" style="display:flex;align-items: center; gap: 10px; color: white; text-decoration: none; font-size: 24px"><img src="../assets/img/Logo.png" alt="#" /> ДоРассвета</router-link>

        </div>
        <div class="header_links">
          <router-link to="/promo">Спецпредложения</router-link>
          <router-link to="/product">Бронирование</router-link>
          <router-link to="/services">Услуги</router-link>
          <router-link to="/contacts">Контакты</router-link>
          <router-link to="/reviews">Отзывы</router-link>
        </div>
        <div class="header_profile" ref="headerProfile">
          <img src="@/assets/img/Profile.png" alt="#" @click="toggleWindow" />
          <div class="window_reg_log" :class="['active', !isWindowActive ? 'hide' : '']" >
            <router-link to="/promo" class="header_links_mobile">Спецпредложения</router-link>
            <router-link to="/product" class="header_links_mobile">Бронирование</router-link>
            <router-link to="/services" class="header_links_mobile">Услуги</router-link>
            <router-link to="/contacts" class="header_links_mobile">Контакты</router-link>
            <router-link to="/reviews" class="header_links_mobile">Отзывы</router-link>
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
    document.addEventListener("click", this.handleDocumentClick);
  },
  beforeUnmount() {
    document.removeEventListener("click", this.handleDocumentClick);
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
    handleDocumentClick(event) {
      const headerProfile = this.$refs.headerProfile;
      if (headerProfile && !headerProfile.contains(event.target)) {
        this.isWindowActive = false;
      }
    },
  },
};
</script>
<style scoped>
.hide {
  display: none !important;
}
@keyframes fadeIn {
  0% {
    opacity: 0;
    transform: translateY(-20px);
  }
  100% {
    opacity: 1;
    transform: translateY(0);
  }
}


.window_reg_log {
  animation: fadeIn 0.2s ease-in-out;
}

</style>


