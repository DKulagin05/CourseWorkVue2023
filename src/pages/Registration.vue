<template>
  <div class="registration_sec">
    <div class="wrapper">
      <div class="reg_body">
        <form @submit.prevent="submitForm">
          <div class="reg_header">
            <h1>Регистрация</h1>
          </div>
          <div class="reg_inputs">
            <div class="input_label_box">
              <label for="name">Введите имя</label>
              <input type="text" v-model="name" id="name" required>
            </div>
            <div class="input_label_box">
              <label for="surname">Введите фамилию</label>
              <input type="text" v-model="surname" id="surname" required>
            </div>
            <div class="input_label_box">
              <label for="patronymic">Введите отчество</label>
              <input type="text" v-model="patronymic" id="patronymic">
            </div>
            <div class="input_label_box">
              <label for="email">Электронная почта</label>
              <input type="email" v-model="email" id="email" required>
            </div>
            <div class="input_label_box">
              <label for="phone">Номер телефона</label>
              <input type="text" v-model="phone" id="phone" required>
            </div>
            <div class="input_label_box">
              <label for="password">Введите пароль</label>
              <input type="password" v-model="password" id="password" required>
            </div>
            <div class="input_label_box">
              <label for="password_repeat">Подтвердите пароль</label>
              <input type="password" v-model="password_repeat" id="password_repeat" required>
            </div>
          </div>
          <div class="reg_input_box">
            <input type="submit" v-on:click="onSubmit()" value="Зарегистрироваться">
            <div class="approval_box">
              <input type="checkbox" id="approval">
              <label for="approval">Вы соглашаетесь с <a href="">Условиями</a> на обработку ваших персональных данных</label>
            </div>

          </div>
          <div class="login_var">
            <p>Уже есть аккаунт?</p>
            <router-link to="/login">Войти</router-link>
          </div>
        </form>
      </div>
    </div>
  </div>
</template>

<script>
export default {
  data() {
    return {
      name:'',
      surname: '',
      patronymic: '',
      email: '',
      phone: '',
      password: '',
      password_repeat: '',
    };
  },
  methods: {
    onSubmit() {
      fetch('http://frontend/src/api/registration.php', {
        method: 'POST',
        body: JSON.stringify({
          name: this.name,
          surname: this.surname,
          patronymic: this.patronymic,
          email: this.email,
          phone: this.phone,
          password: this.password,
          password_repeat: this.password_repeat
        }),
      })
          .then((response) => response.json()) // парсим ответ от сервера в формате JSON
          .then((data) => {
            if (data.status) {
              window.location.href = '../personal_account.php'; // переходим на страницу личного кабинета
            } else {
              alert(data.message); // выводим сообщение об ошибке регистрации
            }
          })
          .catch((error) => console.error(error)); // ловим ошибки сети и выводим в консоль
    },
  },
};
</script>