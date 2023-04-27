<template>
  <footer>
    <div class="wrapper">
      <div class="footer_body">
        <div class="footer_input">
          <form action="" id="mailingForm">
            <input name="mailing" id="mailing" type="email" placeholder="Подписаться на рассылку">
            <input type="submit" value="Подписаться">
          </form>
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
          <a href="../mainPage.php"><img src="@/assets/img/footer_logo.png" alt="#"></a>
        </div>
      </div>
    </div>
  </footer>
</template>

<script>
export default {
  name: 'Footer'
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



form input[type="email"] {
  /*border-radius: 5px;*/
  border-bottom-left-radius: 5px;
  border-top-left-radius: 5px;
  border: none;
  font-size: 14px;
  padding: 10px;
  width: 250px;
}

form input[type="submit"] {
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