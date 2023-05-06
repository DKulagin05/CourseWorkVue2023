<template>
  <div>
    <div class="head_box">
      <div class="wrapper">
        <div class="head_body">
          <div class="head_booking_wnd">
            <div class="head_booking_wnd_inputs">
              <h1 style="color: white; line-height: 50px; font-size: 26px;">Для наших дорогих гостей - специальные акции и скидки! Забронируйте номер уже сегодня и получите больше за меньшую цену!</h1>
              <router-link to="/promo" class="detailed_btn">Подробнее</router-link>
            </div>
          </div>
        </div>
        <div class="head_all_btn">
          <div class="left_side">
            <p>Множество номеров для вас<br>
              прямо сейчас</p>
            <h1>Посмотреть все номера</h1>
          </div>
          <div class="right_side">
            <router-link to="/product"><img src="@/assets/img/Arrow.png" alt="#"></router-link>
          </div>
        </div>
      </div>
    </div>
<!--    <div class="slider_body">-->
<!--      <div class="wrapper">-->
<!--        <div class="slider_header">-->
<!--          <h1>Лучшие предложения</h1>-->
<!--        </div>-->
<!--        <div class="slider">-->
<!--          <div class="slider__item filter" v-for="product in products" :key="product.id">-->
<!--            <div class="personal_info_booking_unit">-->
<!--              <img class="product_img" :src="product.image" :alt="product.name">-->
<!--              <div class="info_booking_body">-->
<!--                <div class="info_booking_main">-->
<!--                  <div class="info_booking_header">-->
<!--                    <h1>{{ product.name }}</h1>-->
<!--                  </div>-->
<!--                  <div class="info_booking_specifications">-->
<!--                    <div class="specifications_square">-->
<!--                      <img src="@/assets/img/square.png" alt="#">-->
<!--                      <p>{{ product.area }} кв. м</p>-->
<!--                    </div>-->
<!--                    <div class="specifications_person">-->
<!--                      <img src="@/assets/img/person.png" alt="#">-->
<!--                      <p>{{ product.capacity }} чел.</p>-->
<!--                    </div>-->
<!--                  </div>-->
<!--                  <div class="info_booking_price_btn">-->
<!--                    <div class="info_booking_price">-->
<!--                      <h1>Цена</h1>-->
<!--                      <p>{{ product.price }} р</p>-->
<!--                    </div>-->
<!--                    <div class="info_booking_btn" @click="reserveProduct(product.id)">Забронировать</div>-->
<!--                  </div>-->
<!--                </div>-->
<!--              </div>-->
<!--            </div>-->
<!--          </div>-->
<!--        </div>-->
<!--      </div>-->
<!--    </div>-->
    <div class="sec_third">
      <div class="wrapper">
        <div class="advantages_body">
          <div class="advantages_header">Наши преимущества</div>
          <div class="advantages_list">
            <div class="advantages_list_unit">
              <img src="@/assets/img/Time.png" alt="#">
              <p>Быстрое бронирование</p>
            </div>
            <div class="advantages_list_unit">
              <img src="@/assets/img/Defend.png" alt="#">
              <p>Гарантия безопасности</p>
            </div>
            <div class="advantages_list_unit">
              <img src="@/assets/img/WiFi.png" alt="#">
              <p>Бесплатный WiFi</p>
            </div>
            <div class="advantages_list_unit">
              <img src="@/assets/img/Money.png" alt="#">
              <p>Низкие цены</p>
            </div>
            <div class="advantages_list_unit">
              <img src="@/assets/img/Parking.png" alt="#">
              <p>Бесплатная парковка</p>
            </div>
          </div>
        </div>
      </div>
    </div>
    <div class="sec_map">
      <div style="position:relative;overflow:hidden;"><a href="https://yandex.ru/maps/56/chelyabinsk/?utm_medium=mapframe&utm_source=maps" style="color:#eee;font-size:12px;position:absolute;top:0;">Челябинск</a><a href="https://yandex.ru/maps/56/chelyabinsk/house/ulitsa_entuziastov_17/YkgYdQBnS0UEQFtvfX10cHxkYQ==/?indoorLevel=1&ll=61.378359%2C55.150621&utm_medium=mapframe&utm_source=maps&z=16.95" style="color:#eee;font-size:12px;position:absolute;top:14px;">Улица Энтузиастов, 17 — Яндекс Карты</a><iframe src="https://yandex.ru/map-widget/v1/?indoorLevel=1&ll=61.378359%2C55.150621&mode=whatshere&whatshere%5Bpoint%5D=61.377582%2C55.151057&whatshere%5Bzoom%5D=17&z=16.95" width="100%" height="500" frameborder="0" allowfullscreen="true" style="position:relative;"></iframe></div>
    </div>
  </div>
</template>

<script>


</script>
<style scoped>
.head_booking_wnd {
  position: absolute;
  top: 150px;

  /*margin: 150px 0 0 0;*/
  background-color: var(--light-brown);
  padding: 30px 50px;
  border-radius: 30px;
  max-width: 700px;
  max-height: 500px;
  box-shadow: -4px 4px 4px 0px #00000059;
}
.head_booking_wnd_inputs {
  display: flex;
  flex-direction: column;
  align-items: center;
}
.detailed_btn {
  text-decoration: none;
  margin-top: 40px;
  border-radius: 5px;
  background: var(--cyan);
  padding: 12px 85px;
  color: white;
  font-family: 'Montserrat';
  font-style: normal;
  font-weight: 500;
  font-size: 22px;
  line-height: 27px;
  transition: 0.5s ease;
}
.detailed_btn:hover {
  color: var(--cyan);
  background: white;
}
</style>