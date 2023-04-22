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
          <a href="../contacts.php">Контакты</a>
          <a href="../services.php">Услуги</a>
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

<style>

</style>