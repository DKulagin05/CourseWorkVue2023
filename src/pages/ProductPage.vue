<template>
  <div class="wrapper">
<!--    <section class="filters">-->
<!--      <div class="wrapper">-->
<!--        <div class="filters-title">-->
<!--          <div class="filters-title-text">Каталог</div>-->
<!--          <div class="filters-title-filters"></div>-->
<!--        </div>-->
<!--        <form class="filters-more-fliters" @submit.prevent="submitFilters">-->
<!--          <div class="filters-more-fliters-price">-->
<!--            <p>Цена</p>-->
<!--            <div class="filters-more-fliters-price-inputs">-->
<!--              <input class="input" id="search_price_start" type="text" placeholder="От" v-model="priceFrom" />-->
<!--              <div class="line_filters"></div>-->
<!--              <input class="input" id="search_price_end" type="text" placeholder="До" v-model="priceTo" />-->
<!--            </div>-->
<!--          </div>-->
<!--          <div class="filters-more-fliters-sort">-->
<!--            <p>Сортировка</p>-->
<!--            <select name="filters-more-fliters-sort" v-model="sortType">-->
<!--              <option value="0">Дешёвые</option>-->
<!--              <option value="1">Дорогие</option>-->
<!--            </select>-->
<!--          </div>-->
<!--          <div class="filters-more-fliters-sort">-->
<!--            <input type="submit" class="sort_btn" id="sort_all_btn" value="Отсортировать" />-->
<!--          </div>-->
<!--        </form>-->
<!--      </div>-->
<!--    </section>-->
    <div class="card_container">
      <div class="room-card" v-for="room in rooms" :key="room.id">
        <div class="room-img">
          <img :src="'http://frontend/src/assets/img/products/' + room.img" :alt="room.title">
        </div>
        <h2>{{ room.title }}</h2>
        <div class="room-specifications">
          <p>Площадь: {{ room.square }} м²</p>
          <p>Человек: {{ room.people_count }}</p>
        </div>
        <p>Цена: {{ room.price }} р/ночь</p>

        <div class="additional-services">
          <h2>Дополнительные услуги</h2>
          <div class="service">
            <input type="checkbox" :id="'meal-' + room.id" v-model="room.meal" @change="mealChecked">
            <label :for="'meal-' + room.id">Питание</label>
          </div>
          <div class="service">
            <input type="checkbox" :id="'special-zones-' + room.id" v-model="room.specialZones" @change="specialZonesChecked">
            <label :for="'special-zones-' + room.id">Посещение спец. зон</label>
          </div>
          <div class="service">
            <input type="checkbox" :id="'transport-' + room.id" v-model="room.transport" @change="transportChecked">
            <label :for="'transport-' + room.id">Транспорт</label>
          </div>
          <div class="service">
            <input type="checkbox" :id="'wake-up-' + room.id" v-model="room.wakeUp" @change="wakeUpChecked">
            <label :for="'wake-up-' + room.id">Пробуждение</label>
          </div>
        </div>
        <div class="room-booking">
          <div>
            <button class="book-button" @click="showModal = true; selectRoom(room); ProductAdd(room)">Подробнее</button>
            <div v-if="showModal" class="modal">
              <div class="modal-content">
                <div class="modal-info">
                  <div class="modal-description">
                    <h3>{{ this.selectedRoom.description }}</h3>
                  </div>
                  <div class="modal-add-info">
                    <ul>
                      <h3>Этот номер включает в себя:</h3>
                      <li v-if="this.Minibar">Минибар</li>
                      <li v-if="this.TV">TV</li>
                      <li v-if="this.WiFi">WiFi</li>
                      <li v-if="this.Conditioner">Кондиционер</li>
                    </ul>
                  </div>
                </div>
                <div class="modal-header">
                  <h3>Выберите даты</h3>
                </div>
                <div class="modal-body">
                  <div class="input_label_box">
                    <label for="InDate">Дата въезда:</label>
                    <input id="InDate" type="date" v-model="checkInDate" required />
                  </div>
                  <div class="input_label_box">
                    <label for="OutDate">Дата выезда:</label>
                    <input id="OutDate" type="date" v-model="checkOutDate" required />
                  </div>
                </div>
                <div class="modal-footer">
                  <button @click="bookRoom(selectedRoom.id)">Забронировать</button>
                  <button @click="showModal = false">Отмена</button>
                </div>
              </div>
            </div>
          </div>
        </div>
      </div>
    </div>
  </div>
</template>

<script>
export default {
  props: {
    roomName: String,
    area: Number,
    capacity: Number,
    price: Number
  },
  data() {
    return {
      meal: false,
      specialZones: false,
      transport: false,
      wakeUp: false,
      title: "Комната с двуспальной кроватью",
      square: 5,
      people_count: 2,
      price: 1500,
      selectedRoom: null,
      showModal: false,
      checkInDate: null,
      checkOutDate: null,
      rooms: [],
      Minibar: false,
      TV: false,
      WiFi: false,
      Conditioner: false,
    }
  },
  filters: {
    toNumber(value) {
      return value ? 1 : 0
    }
  },
  methods: {
    mealChecked() {
      this.meal = !this.meal
    },
    specialZonesChecked() {
      this.specialZones = !this.specialZones
    },
    transportChecked() {
      this.transport = !this.transport
    },
    wakeUpChecked() {
      this.wakeUp = !this.wakeUp
    },
    selectRoom(room) {
      this.selectedRoom = room;

    },
    bookRoom(id) {
      console.log('Book room with id:', this.selectedRoom.id, 'Check-in date:', this.checkInDate, 'Check-out date:', this.checkOutDate);
      let item_booking = this.selectedRoom.id;
      const token = localStorage.getItem('token');
      let array_services = [
        this.wakeUp ? 1:0,
        this.meal ? 1:0,
        this.specialZones ? 1:0,
        this.transport ? 1:0,
      ]
      let InDate = this.checkInDate
      let OutDate = this.checkOutDate
      fetch('http://frontend/src/api/booking.php', {
        headers: {
          "Accept": "application/json",
          "Content-Type": "application/json"
        },
        method: 'POST',
        body: JSON.stringify({
          item_booking,
          token,
          array_services,
          InDate,
          OutDate
        })
      })
          .then(response => response.json())
          .then(data => {
            if(data.success) {
              alert(data.message);
              this.$router.push('/personal');
            } else {
              alert(data.message);
            }
          });

      this.showModal = false;
    },
    ProductAdd(room) {
      fetch('http://frontend/src/api/ProductDataAdd.php', {
        method: 'POST',
        body: JSON.stringify({
          item_id: room['id'],
          token: localStorage.getItem('token')
        })
      })
          .then(response => response.json())
          .then(data => {
            this.Minibar = parseInt(data[0]['Minibar'])
            this.TV = parseInt(data[0]['TV'])
            this.WiFi = parseInt(data[0]['WiFi'])
            this.Conditioner = parseInt(data[0]['Conditioner'])
            // let arr = [this.TV,this.Minibar,this.WiFi,this.Conditioner]
            let item_booking = room['id'];

          })
          .catch(error => console.error(error));
    }
  },
  mounted() {
    fetch('http://frontend/src/api/ProductData.php', {
      method: 'POST',
      body: JSON.stringify({})
    })
        .then(response => response.json())
        .then(data => {
          this.rooms = data.message;
        })
        .catch(error => console.error(error));

  }
}
</script>

<style scoped>
.card_container {
  display: flex;
  flex-wrap: wrap;
  gap: 100px;
}
.modal {
  position: fixed;
  top: 0;
  left: 0;
  right: 0;
  bottom: 0;
  background-color: rgba(0, 0, 0, 0.5);
  display: flex;
  justify-content: center;
  align-items: center;
}
input[type='date'] {
  /*width: 200px;*/
}
.modal-content {
  background-color: #fff;
  width: 400px;
  padding: 20px;
  border-radius: 5px;
}

.modal-header h3 {
  margin: 0;
  padding: 20px;
  font-weight: bold;
  font-size: 32px;
}
.modal-body {
  display: flex;
  align-items: center;
  flex-direction: column;
  gap: 30px;
}
.modal-body input {
  display: block;
  margin-bottom: 10px;
}
.modal-body label {
  font-size: 20px;
}
.modal-footer button {
  margin-right: 10px;
}

.room-specifications {
  display: flex;
  gap: 30px;
  flex-wrap:wrap;
  margin: 0;
  padding: 0;
}
.room-specifications {
  margin: 0;
  padding: 0;
}
.room-card {
  width: 350px;
  background-color: #f2e8d8;
  padding: 20px;
  border-radius: 10px;
  box-shadow: 0px 0px 10px rgba(0, 0, 0, 0.2);
}

.room-card h2 {
  margin-top: 0;
  font-size: 1.5rem;
}
.room-img {
  width: 310px;
}
.room-card img {
  height: 200px;
  width: 100%;
  border-radius: 5px 5px 0 0 ;
}
.room-card p {
  margin: 10px 0;
}

.additional-services {
  margin-top: 0;
}

.additional-services h3 {
  margin-top: 0;
  font-size: 1.2rem;
}

.service {
  display: flex;
  align-items: center;
}

.service label {
  margin-left: 10px;
}

.book-button {
  margin-top: 20px;
  background-color: #c8a165;
  color: #fff;
  border: none;
  border-radius: 5px;
  padding: 10px 20px;
  font-size: 1.2rem;
  cursor: pointer;
}

.book-button:hover {
  background-color: #a88452;
}
</style>
