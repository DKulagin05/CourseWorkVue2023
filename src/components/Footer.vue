<template>
  <footer>
    <div class="wrapper">
      <div class="footer_body">
        <div class="footer_input">
            <input name="mailing" v-model="mail"  id="mailing" type="email" placeholder="Подписаться на рассылку">
            <button class="mailingBtn" @click="mailing">Подписаться</button>
        </div>
        <div class="footer_links">
          <router-link to="/contacts">Контакты</router-link>
          <router-link to="/services">Услуги</router-link>
        </div>
        <div class="footer_pay_var">
          <img src="@/assets/img/qiwi.png" alt="#">
          <img src="@/assets/img/paypal.png" alt="#">
        </div>
        <div class="footer_logo">
          <router-link to="/"><img src="../assets/img/Logo.png" alt="#" /></router-link>
        </div>
      </div>
    </div>
  </footer>
</template>

<script>
export default {
  data() {
    return {
      mail: null,
    }
  },
  methods: {
    mailing() {
      const email = this.mail

      fetch('http://frontend/src/api/footer_mailing.php', {
        method: 'POST',
        body: JSON.stringify({
          email
        })
      })
          .then(response => response.json())
          .then(data => {
            if (data.success) {
              alert(data.message);
            } else {
              alert(data.message);
            }
          })
          .catch(error => console.error(error));
    }
  }
}

</script>

<style scoped>
footer {
  background-color: #000;
  color: #333;
  font-size: 16px;
  line-height: 24px;
  padding: 10px 0;
  max-height: 100px;
}

.footer_body {
  display: flex;
  /*flex-wrap: wrap;*/
  justify-content: space-between;
  align-items: center;
}



input[type="email"] {
  /*border-radius: 5px;*/
  border-bottom-left-radius: 5px;
  border-top-left-radius: 5px;
  border: none;
  font-size: 14px;
  padding: 10px;
  width: 250px;
}

.mailingBtn {
  background-color: #c8a165;
  border: none;
  /*border-radius: 5px;*/
  border-bottom-right-radius: 5px;
  border-top-right-radius: 5px;
  color: #fff;
  cursor: pointer;
  font-size: 16px;
  /*margin-left: 10px;*/
  padding: 10px 20px;
}

.footer_links {
  display: flex;
  justify-content: space-between;
  width: 30%;
}

.footer_links a {
  font-size: 24px;
  color: #fff;
  text-decoration: none;
  margin-right: 20px;
}

.footer_links a:hover {
  text-decoration: underline;
}
.footer_pay_var {
  display: flex;
}
.footer_pay_var img {
  height: 35px;
  margin-right: 20px;
}
#mailingForm {
  display: flex;
  align-items: center;
}
.footer_logo {
  /*margin-top: 20px;*/
}

.footer_logo img {
  max-height: 50px;
}
</style>