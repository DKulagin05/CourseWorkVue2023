<template>
  <div class="wrapper">
    <section class="filters">
      <div class="wrapper">
        <div class="filters-title">
          <div class="filters-title-text">Каталог</div>
          <div class="filters-title-filters"></div>
        </div>
        <form class="filters-more-fliters">
          <div class="filters-more-fliters-price">
            <p>Цена</p>
            <div class="filters-more-fliters-price-inputs">
              <input class="input" id="search_price_start" type="text" placeholder="От" v-model="priceFrom" />
              <div class="line_filters"></div>
              <input class="input" id="search_price_end" type="text" placeholder="До" v-model="priceTo" />
            </div>
          </div>
          <div class="filters-more-fliters-sort">
            <p>Сортировка</p>
            <select name="filters-more-fliters-sort" v-model="sortType">
              <option value="0">Дешёвые</option>
              <option value="1">Дорогие</option>
            </select>
            <p>Количество человек</p>
            <select name="filters-more-fliters-sort" v-model="peopleCount">
              <option value="0">Все</option>
              <option value="1">1</option>
              <option value="2">2</option>
              <option value="4">4</option>
            </select>
          </div>
<!--          <div class="filters-more-fliters-sort">-->
<!--            <input type="submit" class="sort_btn" id="sort_all_btn" value="Отсортировать"/>-->
<!--          </div>-->
        </form>
      </div>
    </section>
    <div class="card_container">
      <div style="position: relative" class="room-card" v-for="room in filteredRooms" :key="room.id">
        <div class="room-img">
          <img :src="'http://frontend/src/assets/img/products/' + room.img_1" :alt="room.title">
        </div>
        <h2 style="font-weight: 400; margin: 10px 0 5px 0; line-height: 30px; min-height: 60px">{{ room.title }}</h2>
        <div class="room-specifications">
          <p>Площадь: {{ room.square }} м²</p>
          <p>Человек: {{ room.people_count }}</p>
        </div>
        <p>Цена: {{ room.price }} р/ночь</p>
        <div class="modal-add-info">
          <h3>Этот номер включает в себя:</h3>
          <ul style="margin-top: 5px; display:flex; gap: 30px">
            <div>
              <li v-if="parseInt(room.Minibar)">Минибар</li>
              <li v-if="parseInt(room.TV)">TV</li>
            </div>
           <div>
             <li v-if="parseInt(room.WiFi)">WiFi</li>
             <li v-if="parseInt(room.Conditioner)">Кондиционер</li>
           </div>

          </ul>
        </div>

        <div class="room-booking">
          <div>
            <button style="position: absolute; bottom: 20px; right: 20px; margin-top: 50px;" class="book-button" @click="showModal = true; selectRoom(room)">Подробнее</button>
            <div v-if="showModal" class="modal">
              <div class="modal-content">
                <div class="modal_rent">
                  <div class="modal-description">
                    <div class="modal-description-img">
                      <img v-if="this.selectedRoom.img_1 !== ''" :src="'http://frontend/src/assets/img/products/' + this.selectedRoom.img_1" :alt="this.selectedRoom.title">
                      <img v-if="this.selectedRoom.img_2 !== ''" :src="'http://frontend/src/assets/img/products/' + this.selectedRoom.img_2" :alt="this.selectedRoom.title">
                      <img v-if="this.selectedRoom.img_3 !== ''" :src="'http://frontend/src/assets/img/products/' + this.selectedRoom.img_3" :alt="this.selectedRoom.title">
                    </div>
                    <h2>{{ this.selectedRoom.title }}</h2>
                    <h3>{{ this.selectedRoom.description }}</h3>
                    <div class="modal-add-info-var">
                      <div class="add-info-var">
                        <h3>Этот номер включает в себя:</h3>
                        <ul>
                          <li v-if="parseInt(this.selectedRoom.Minibar)">Минибар</li>
                          <li v-if="parseInt(this.selectedRoom.TV)">TV</li>
                          <li v-if="parseInt(this.selectedRoom.WiFi)">WiFi</li>
                          <li v-if="parseInt(this.selectedRoom.Conditioner)">Кондиционер</li>
                        </ul>
                      </div>
                      <div class="test">
                        <div class="modal-room-specifications">
                          <p>Площадь: {{ room.square }} м²</p>
                          <p>Человек: {{ room.people_count }}</p>
                        </div>
                        <p style="font-weight: bold; text-align: center;  font-size: 20px;">Цена: {{ totalCount }} р</p>
                      </div>
                    </div>

                  </div>
                </div>

                <div class="modal-room-additional-info">
                  <div class="modal-info">
                    <div class="modal-additional-services">
                      <h2>Дополнительные услуги</h2>
                      <div class="modal-service">
                        <input type="checkbox" :id="'meal-' + room.id" v-model="room.meal" @change="mealChecked">
                        <label :for="'meal-' + room.id">Питание</label>
                      </div>
                      <div class="modal-service">
                        <input type="checkbox" :id="'special-zones-' + room.id" v-model="room.specialZones" @change="specialZonesChecked">
                        <label :for="'special-zones-' + room.id">Посещение спец. зон</label>
                      </div>
                      <div class="modal-service">
                        <input type="checkbox" :id="'transport-' + room.id" v-model="room.transport" @change="transportChecked">
                        <label :for="'transport-' + room.id">Транспорт</label>
                      </div>
                      <div class="modal-service">
                        <input type="checkbox" :id="'wake-up-' + room.id" v-model="room.wakeUp" @change="wakeUpChecked">
                        <label :for="'wake-up-' + room.id">Пробуждение</label>
                      </div>
                    </div>
                  </div>
                  <div class="modal-header">
                    <h3>Выберите даты</h3>
                  </div>
                  <div class="modal-body">
                    <div class="input_label_box">
                      <label for="InDate">Дата въезда:</label>
                      <input id="InDate" type="date" v-model.lazy="checkInDate" @change="checkDate" required />
                      <span v-if="dateErrorIn" style="color: red;">Дата не может быть меньше текущей</span>
                    </div>
                    <div class="input_label_box">
                      <label for="OutDate">Дата выезда:</label>
                      <input id="OutDate" type="date" v-model="checkOutDate" @change="calculateDays(); checkDate()" required />
                      <span v-if="dateErrorOut" style="color: red;">Дата выселения не может быть меньше даты заселения</span>
                    </div>
                  </div>
                  <div class="modal-footer">
                    <button @click="bookRoom(selectedRoom.id)" :disabled="dateErrorOut || dateErrorIn || checkInDate===null || checkOutDate===null"
                            :class="{ 'disabled-button': dateErrorOut || dateErrorIn || checkInDate===null || checkOutDate===null }">Забронировать</button>
                    <button @click="showModal = false">Отмена</button>
                  </div>
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
    // price: Number
  },
  data() {
    return {
      meal: false,
      specialZones: false,
      transport: false,
      wakeUp: false,
      title: "",
      square: 0,
      people_count: 0,
      price: 0,
      selectedRoom: null,
      showModal: false,
      checkInDate: null,
      checkOutDate: null,
      rooms: [],
      Minibar: false,
      TV: false,
      WiFi: false,
      Conditioner: false,
      dateErrorIn: false,
      dateErrorOut: false,
      daysCount: 1,
      totalPrice: 0,
      sortType: 0,
      priceTo: 10000,
      priceFrom: 0,
      peopleCount: 0,
      filteredRooms: []
    }
  },
  computed: {
    totalCount(){
      let add = 0
      if(this.meal) add += 1500
      if(this.specialZones) add += 2500
      if(this.transport) add += 1000
      if(this.wakeUp) add += 500
      this.totalPrice = this.selectedRoom.price * this.daysCount + add
      return this.selectedRoom.price * this.daysCount + add

    }
  },
  watch: {
    priceFrom: {
      handler() {
        this.filter();
      }
    },
    priceTo: {
      handler() {
        this.filter();
      }
    },
    sortType: {
      handler() {
        this.filter();
      }
    },
    peopleCount: {
      handler() {
        this.filter();
      }
    }
  },
  methods: {
    filter() {
      const priceFrom = this.priceFrom;
      const priceTo = parseFloat(this.priceTo);
      const sortBy = this.sortType;
      const peopleCount = parseInt(this.peopleCount);

      let filteredRooms = this.rooms;

      if (!isNaN(priceFrom) && !isNaN(priceTo)) {
        filteredRooms = filteredRooms.filter(room => room.price >= priceFrom && room.price <= priceTo);
      }

      if (peopleCount > 0) {
        filteredRooms = filteredRooms.filter(room => room.people_count === this.peopleCount);
      }

      if (sortBy == 1) {
        filteredRooms.sort((a, b) => b.price - a.price);
      } else if (sortBy == 0) {
        filteredRooms.sort((a, b) => a.price - b.price);
      }

      this.filteredRooms = filteredRooms;
    },
    calculateDays() {
      if (this.checkInDate && this.checkOutDate) {
        const date1Obj = new Date(this.checkInDate)
        const date2Obj = new Date(this.checkOutDate)
        const timeDiff = Math.abs(date2Obj.getTime() - date1Obj.getTime())
        const diffDays = Math.ceil(timeDiff / (1000 * 3600 * 24))
        this.daysCount = diffDays
      }
    },
    checkDate() {
      const currentDate = new Date()
      const checkInDate = new Date(this.checkInDate)
      if (checkInDate < currentDate) {
        this.dateErrorIn = true
      } else {
        this.dateErrorIn = false
      }
      const checkOutDate = new Date(this.checkOutDate)
      if (checkOutDate <= checkInDate) {
        this.dateErrorOut = true
      } else {
        this.dateErrorOut = false
      }
    },
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
      let totalPrice = this.totalPrice
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
          OutDate,
          totalPrice
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
  },
  mounted() {

    fetch('http://frontend/src/api/ProductData.php', {
      method: 'POST',
      body: JSON.stringify({})
    })
        .then(response => response.json())
        .then(data => {
          this.rooms = data.message;
          this.filteredRooms = this.rooms

        })
        .catch(error => console.error(error));

  }
}
</script>

<style scoped>
@import url('https://fonts.googleapis.com/css2?family=Jost:ital,wght@0,100;0,200;0,300;0,400;0,500;0,600;0,700;0,800;0,900;1,100;1,200;1,300;1,400;1,500;1,600;1,700;1,800;1,900&family=Montserrat:ital,wght@0,100;0,200;0,300;0,400;0,500;0,600;0,700;0,800;0,900;1,100;1,200;1,300;1,400;1,500;1,600;1,700;1,800;1,900&display=swap');
.wrapper {
  font-family: 'Jost', sans-serif;
  font-family: 'Montserrat', sans-serif;
}
.disabled-button {
  opacity: 0.5;
}
.modal {
  background-color: rgba(123,123,123,0.15);
  position: fixed;
  top: 0;
  left: 0;
  width: 100%;
  height: 100%;
  display: flex;
  justify-content: center;
  align-items: center;
  z-index: 9999;
}

.modal-content {
  background-color: #f2e8d8;
  width: 50%;
  padding: 30px;
  border-radius: 5px;
  display: flex;
  flex-direction: column;
  /*align-items: center;*/
  justify-content: space-between;
}

.modal_rent {
  display: flex;
  flex-direction: row;
  justify-content: center;
  align-items: center;
  width: 100%;
  margin-bottom: 20px;
}
.modal-description-img {
  display: flex;
  justify-content: center;
  gap: 10px;
}
.modal-description-img img {
  max-width: 40%;
}
.modal-description {
  display: flex;
  flex-direction: column;
  /*align-items: center;*/
  justify-content: center;
  width: 100%;
  padding-right: 10px;
}

.modal-description img {
  width: 100%;
  margin-bottom: 10px;
}

.modal-description h2 {
  font-size: 24px;
  margin-bottom: 10px;
}

.modal-description h3 {
  font-size: 18px;
  margin-bottom: 10px;
}

.modal-add-info {
  display: flex;
  flex-direction: column;
  margin-top: 10px;
  /*align-items: center;*/
  /*justify-content: space-between;*/
}
.modal-add-info-var {
  display: flex;
  /*flex-direction: column;*/
  margin-top: 10px;
  /*gap: 50px;*/
  justify-content: space-around;
}
.modal-room-specifications {
  margin-top: 20px;
  text-align: center;
}
.modal-room-specifications p {
  font-size: 18px;
}


.modal-additional-services h2 {
  font-size: 5px;
  margin-bottom: 10px;
}

.modal-service {
  margin-bottom: 10px;
}

.modal-service label {
  font-size: 18px;
}

.modal-header h3 {
  font-size: 24px;
}

.modal-body {
  display: flex;
  flex-direction: row;
  justify-content: space-between;
  margin-bottom: 20px;
}

.input_label_box {
  display: flex;
  flex-direction: column;
  margin-bottom: 10px;
}

.input_label_box label {
  font-size: 18px;
  margin-bottom: 5px;
}

.modal-footer {
  display: flex;
  flex-direction: row;
  justify-content: space-between;
  align-items: center;
}

.modal-footer button {
  padding: 10px 20px;
  font-size: 18px;
  border-radius: 5px;
  border: none;
  color: #fff;
  cursor: pointer;
}

.modal-footer button:first-child {
  background-color: #A0522D;
}

.modal-footer button:last-child {
  background-color: #696969;
}
.modal-footer button {
  margin-right: 10px;
  background-color: #a88452;
  color: white;
  border-radius: 5px;
  padding: 5px 10px;
  font-size: 1.2rem;
  cursor: pointer;
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
  min-height: 520px;
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
