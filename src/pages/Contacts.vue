<template>
  <div class="contacts">
    <div class="wrapper">
      <div class="contacts_body">
        <div class="contacts_info">
          <div class="contacts_info_unit">
            <h1>Контактный телефон</h1>
            <h2>+79123055142</h2>
          </div>
          <div class="contacts_info_unit">
            <h1>Наш адрес</h1>
            <h2>улица Энтузиастов, 17, Челябинск, 454080</h2>
          </div>
          <div class="contacts_info_unit">
            <h1>Наши соц. сети</h1>
            <h4><a href="https://vk.com/kulagindim">Вконтакте</a></h4>
          </div>
        </div>
        <div class="contacts_map">
          <div style="position:relative;overflow:hidden;"><a href="https://yandex.ru/maps/56/chelyabinsk/?utm_medium=mapframe&utm_source=maps" style="color:#eee;font-size:12px;position:absolute;top:0px;">Челябинск</a><a href="https://yandex.ru/maps/56/chelyabinsk/house/ulitsa_entuziastov_17/YkgYdQBnS0UEQFtvfX10cHxkYQ==/?indoorLevel=1&ll=61.378359%2C55.150621&utm_medium=mapframe&utm_source=maps&z=16.95" style="color:#eee;font-size:12px;position:absolute;top:14px;">Улица Энтузиастов, 17 — Яндекс Карты</a><iframe src="https://yandex.ru/map-widget/v1/?indoorLevel=1&ll=61.378359%2C55.150621&mode=whatshere&whatshere%5Bpoint%5D=61.377582%2C55.151057&whatshere%5Bzoom%5D=17&z=16.95" width="100%" height="500" frameborder="0" allowfullscreen="true" style="position:relative;"></iframe></div>
        </div>
      </div>
      <div class="how_to_get_to_us">
        <div class="how_to_get_to_us_header">
          <h1>Как до нас добраться</h1>
        </div>
        <div class="how_to_get_to_us_maps">
          <div class="how_to_get_to_us_map_train">
            <h1>От вокзала</h1>
            <div style="position:relative;overflow:hidden;"><a href="https://yandex.ru/maps/56/chelyabinsk/?utm_medium=mapframe&utm_source=maps" style="color:#eee;font-size:12px;position:absolute;top:0px;">Челябинск</a><a href="https://yandex.ru/maps/56/chelyabinsk/?ll=61.400719%2C55.146224&mode=routes&rtext=55.151039%2C61.377194~55.141438%2C61.415398&rtt=taxi&ruri=ymapsbm1%3A%2F%2Forg%3Foid%3D1233654449~ymapsbm1%3A%2F%2Ftransit%2Fstop%3Fid%3Dstation__lh_9609235&utm_medium=mapframe&utm_source=maps&z=14.99" style="color:#eee;font-size:12px;position:absolute;top:14px;">Яндекс Карты</a><iframe src="https://yandex.ru/map-widget/v1/?ll=61.400719%2C55.146224&mode=routes&rtext=55.151039%2C61.377194~55.141438%2C61.415398&rtt=taxi&ruri=ymapsbm1%3A%2F%2Forg%3Foid%3D1233654449~ymapsbm1%3A%2F%2Ftransit%2Fstop%3Fid%3Dstation__lh_9609235&z=14.99" width="560" height="400" frameborder="1" allowfullscreen="true" style="position:relative;"></iframe></div>
          </div>
          <div class="how_to_get_to_us_map_flight">
            <h1>От аэропорта</h1>
            <div style="position:relative;overflow:hidden;"><a href="https://yandex.ru/maps/56/chelyabinsk/?utm_medium=mapframe&utm_source=maps" style="color:#eee;font-size:12px;position:absolute;top:0px;">Челябинск</a><a href="https://yandex.ru/maps/56/chelyabinsk/?ll=61.444611%2C55.224473&mode=routes&rtext=55.151039%2C61.377194~55.298084%2C61.509242&rtt=taxi&ruri=ymapsbm1%3A%2F%2Forg%3Foid%3D1233654449~ymapsbm1%3A%2F%2Forg%3Foid%3D1114754702&utm_medium=mapframe&utm_source=maps&z=12.29" style="color:#eee;font-size:12px;position:absolute;top:14px;">Яндекс Карты</a><iframe src="https://yandex.ru/map-widget/v1/?ll=61.444611%2C55.224473&mode=routes&rtext=55.151039%2C61.377194~55.298084%2C61.509242&rtt=taxi&ruri=ymapsbm1%3A%2F%2Forg%3Foid%3D1233654449~ymapsbm1%3A%2F%2Forg%3Foid%3D1114754702&z=12.29" width="560" height="400" frameborder="1" allowfullscreen="true" style="position:relative;"></iframe></div>
          </div>
        </div>
      </div>
    </div>
  </div>
</template>

<script>
export default {
  name: "Contacts"
}
</script>

<style scoped>
.contacts {
  font-family: Arial, sans-serif;
  padding-bottom: 100px;
}

.contacts_body {
  display: flex;
  justify-content: space-between;
  align-items: center;
}

.contacts_info {
  flex-basis: 40%;
  background-color: #FFFFFF;
  padding: 40px;
  border-radius: 5px;
  box-shadow: 0px 3px 10px rgba(0, 0, 0, 0.1);
}

.contacts_info_unit {
  margin-bottom: 40px;
}

.contacts_info_unit h1 {
  font-size: 20px;
  color: #575757;
  margin-bottom: 10px;
}

.contacts_info_unit h2 {
  font-size: 28px;
  color: #0d5c5b;
  margin: 0;
}

.contacts_info_unit h4 {
  font-size: 18px;
  color: #0d5c5b;
  margin: 0;
}

.how_to_get_to_us {
  margin-top: 10px;
}

.how_to_get_to_us_header {
  text-align: center;
  margin-bottom: 30px;
}

.how_to_get_to_us_header h1 {
  font-size: 28px;
  color: #0d5c5b;
  margin: 0;
}

.how_to_get_to_us_maps {
  display: flex;
  justify-content: space-between;
}

.how_to_get_to_us_map_train,
.how_to_get_to_us_map_flight {
  flex-basis: 48%;
  background-color: #FFFFFF;
  padding: 40px;
  border-radius: 5px;
  box-shadow: 0px 3px 10px rgba(0, 0, 0, 0.1);
}

.how_to_get_to_us_map_train h1,
.how_to_get_to_us_map_flight h1 {
  font-size: 20px;
  color: #575757;
  margin-bottom: 20px;
}

.how_to_get_to_us_map_train div,
.how_to_get_to_us_map_flight div {
  width: 100%;
  height: 400px;
}
</style>