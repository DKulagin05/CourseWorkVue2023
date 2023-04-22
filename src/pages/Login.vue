<template>
  <div>
    <div class="reg_header">
    </div>
    <div class="registration_sec">
      <div class="wrapper">
        <div class="reg_body">
          <form @submit.prevent="login()">
            <h1>Авторизация</h1>
            <div class="reg_inputs">
              <div class="input_label_box">
                <label for="email">Введите почту или номер</label>
                <input type="text" name="email" v-model="email" required>
              </div>
              <div class="input_label_box">
                <label for="password">Введите пароль</label>
                <input type="password" name="password" v-model="password" required>
              </div>
            </div>
            <input class="login_submit" value="Войти" type="submit">
            <div class="registration_var">
              <p>Нет аккаунта?</p>
              <router-link to="/registration" class="registration">Регистрация</router-link>
            </div>
          </form>
        </div>
      </div>
    </div>
  </div>
</template>

<script>
export default {
  data() {
    return {
      email: '',
      password: '',
    };
  },
  methods: {
    login() {
      fetch('http://frontend/src/api/check_login.php', {
        method: 'POST',
        body: JSON.stringify({
          email: this.email,
          password: this.password,
        }),
        headers: { 'Content-Type': 'application/json' },
      })
          .then(response => response.json())
          .then(data => {
            if (data.success) {
              localStorage.setItem('token', data.token);
              alert(data.message);
              this.$router.push('/personal');
            } else {
              alert(data.message);
            }
          })
          .catch(error => console.error(error));
    },
  },
};
</script>
