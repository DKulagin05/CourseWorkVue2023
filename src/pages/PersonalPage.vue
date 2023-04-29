<template>
  <div class="personal_info">
    <div class="wrapper">
      <div class="personal_info_header">
        <h1>Личный кабинет</h1>
        <div class="sale_header_border"></div>
      </div>
      <div class="personal_info_body">
        <div class="personal_info_block" v-if="personalDataLoaded">
          <div class="personal_img">
            <img style="width: 300px; height:300px;" :src="'src/assets/img/profile_pictures/' + personalData.img" alt="Profile_Img">
          </div>
          <div class="personal_data">
            <div class="personal_data_fn">
              <div class="personal_surname">{{ personalData.surname }}</div>
              <div class="personal_name">{{ personalData.name }}</div>
              <div class="personal_patronymic">{{ personalData.patronymic }}</div>
            </div>
            <div class="personal_data_phone">
              <div class="personal_phone">{{ personalData.phone }}</div>
            </div>
            <div class="personal_data_mail">
              <div class="personal_mail">{{ personalData.email }}</div>
            </div>
            <div v-if="personalData.admin === '1'" :class="['admin_box']">
              <router-link to="/admin" class="admin_panel_btn">Админ панель</router-link>
            </div>
            <div class="edit_profile_btn" @click="editProfile">Редактировать профиль</div>
            <form class="edit_personal_data" v-if="editMode" @submit.prevent="saveChanges">
              <div style="margin-bottom: 20px;">
                <label for="edit_name">Имя:</label>
                <input type="text" v-model="new_name" name="edit_name" id="edit_name" required>

                <label for="edit_surname">Фамилия:</label>
                <input type="text" v-model="new_surname" name="edit_surname" id="edit_surname" required>

                <label for="edit_patronymic">Отчетство:</label>
                <input type="text" v-model="new_patronymic" name="edit_patronymic" id="edit_patronymic">
              </div>
              <div style="margin-bottom: 20px;">
                <label for="edit_phone">Телефон:</label>
                <input type="text" v-model="new_phone" name="edit_phone" id="edit_phone" required>

                <label for="edit_mail">Email:</label>
                <input type="text" v-model="new_email" name="edit_mail" id="edit_mail" required>

                <label for="edit_profile_img">Изображение профиля:</label>
                <input type="file" @change="onImgSelected"  name="edit_profile_img" id="edit_profile_img">
              </div>
              <input type="submit" class="save_changes" @click="saveChanges">
            </form>
          </div>
        </div>
        <div v-else>
          Загрузка данных...
        </div>
      </div>
    </div>
  </div>
  <div class="personal_info_booking">
    <div class="wrapper">
      <div class="personal_info_booking_body">
        <div class="personal_info_booking_header">
          <h1>Ваши бронирования</h1>
        </div>
        <div class="products-list">
          <div class="card_container">
            <div class="room-card" v-for="room in personalBooking" :key="room.id">

              <div class="room-img">
                <img :src="'http://frontend/src/assets/img/products/' + room[1].img" :alt="room[1].title">
              </div>

              <h2>{{ room[1].title }}</h2>
              <div class="booking_date">
                <p>{{calculateDays(room[0].arrival_date,room[0].departure_date)}}Дата заселения: {{room[0].arrival_date}}<br>Время проживания: {{daysCount}} ночи</p>
                <p style="font-size: 14px">Заселение - 13:00 | Выселение - 10:00</p>
              </div>
              <div class="split"></div>
              <div class="room-specifications">
                <p>Площадь: {{ room[1].square }} м²</p>
                <p>Человек: {{ room[1].people_count }}</p>
              </div>

              <p style="margin-bottom: 10px; font-size: 18px">Стоимость: {{ room[0].price }} р</p>

              <div class="additional-services">
                <h2>Дополнительные услуги</h2>
                <div class="service">
                  <input type="checkbox" :id="'meal-' + room[0].id" disabled :checked="parseInt(room[0].dinner)">
                  <label :for="'meal-' + room[0].id">Питание</label>
                </div>
                <div class="service">
                  <input type="checkbox" :id="'special-zones-' + room[0].id" disabled :checked="parseInt(room[0].zones)">
                  <label :for="'special-zones-' + room[0].id">Посещение спец. зон</label>
                </div>
                <div class="service">
                  <input type="checkbox" :id="'transport-' + room[0].id" disabled :checked="parseInt(room[0].transport)">
                  <label :for="'transport-' + room[0].id">Транспорт</label>
                </div>
                <div class="service">
                  <input type="checkbox" :id="'wake-up-' + room[0].id" disabled :checked="parseInt(room[0].awakening)">
                  <label :for="'wake-up-' + room[0].id">Пробуждение</label>
                </div>
              </div>

              <div class="cancel_btn">
                <button class="book-button" @click="cancelBooking(room[1].id)">Отменить</button>
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
  data() {
    return {
      personalDataLoaded: false,
      personalData: {},
      editMode: false,
      new_email: '',
      new_phone: '',
      new_patronymic: '',
      new_surname: '',
      new_name: '',
      edit_profile_img: null,
      selectedImg: null,
      token: localStorage.getItem('token'),
      personalBooking: [],
      daysCount: 0
    };
  },
  methods: {
    calculateDays(checkInDate,checkOutDate) {
      if (checkInDate && checkOutDate) {
        const date1Obj = new Date(checkInDate)
        const date2Obj = new Date(checkOutDate)
        const timeDiff = Math.abs(date2Obj.getTime() - date1Obj.getTime())
        const diffDays = Math.ceil(timeDiff / (1000 * 3600 * 24))
        this.daysCount = diffDays
      }
    },
    onImgSelected(event) {
      this.selectedImg = event.target.files[0]
    },
    cancelBooking(id) {
      if (confirm('Вы уверены что хотите отменить бронирование?')) {
        let item_booking = id;
        let token = localStorage.getItem('token')
        fetch('http://frontend/src/api/cancelBooking.php', {
          method: 'POST',
          body: JSON.stringify({
            item_booking
          }),
          headers: { 'Content-Type': 'application/json' }
        })
            .then(response => response.json())
            .then(data => {
              if(data.success) {
                alert(data.message);
                location.reload();
              } else {
                alert(data.message);
              }
            });
      }
    },

    fetchPersonalData() {
      fetch('http://frontend/src/api/personalData.php', {
        method: 'POST',
        body: JSON.stringify({
          token: this.token
        }),
        headers: { 'Content-Type': 'application/json' }
      })
          .then(response => response.json())
          .then(data => {
            this.personalData = data[0];
            this.personalDataLoaded = true;
          })
          .catch(error => console.log(error));
    },
    editProfile() {
      this.editMode = !this.editMode
    },
    saveChanges() {
      const formData = new FormData();
      let token = localStorage.getItem('token');
      formData.append('token', token);
      formData.append('new_name', this.new_name);
      formData.append('new_surname', this.new_surname);
      formData.append('new_patronymic', this.new_patronymic);
      formData.append('new_phone', this.new_phone);
      formData.append('new_email', this.new_email);
      formData.append('edit_img', this.selectedImg);
      console.log(formData)
      fetch('http://frontend/src/api/editPersonalData.php', {
        method: 'POST',
        body: formData,
      })
          .then(response => response.json())
          .then(data => {
            if (data.success) {
              alert(data.message)
              this.editMode = false;
              this.fetchPersonalData();
            } else {
              alert(data.message)
            }
          })
          .catch(error => console.log(error));
    },
  },
  mounted() {
    let token = localStorage.getItem('token');
    this.fetchPersonalData()
    fetch('http://frontend/src/api/personalBookingInfo.php', {
      method: 'POST',
      body: JSON.stringify({
        token
      })
    })
        .then(response => response.json())
        .then(data => {
          this.personalBooking = data.result;
        })
        .catch(error => console.error(error));

  }
}
</script>

<style scoped>
.save_changes {
  background-color: #c8a165;
  color: #fff;
  border: none;
  border-radius: 5px;
  padding: 5px 10px;
  font-size: 1.2rem;
  cursor: pointer;
}
.split {
  height: 1px;
  margin-top: 5px;
  background-color: black;
}
.room-specifications {
  display: flex;
  font-size: 18px;
  gap: 30px;
  margin: 10px 0 5px 0 ;
}
.additional-services h2 {
  font-size: 16px;
  margin-bottom: 5px;
}
.service label {
  font-size: 14px;
}
.personal_info_booking {
  padding-bottom: 100px;
}
.room-img {
  width: 310px;
}
.room-card img {
  height: 200px;
  width: 100%;
  border-radius: 5px 5px 0 0 ;
}
.room-card h2 {
  margin-top: 5px;
  line-height: 30px;
  font-weight: 500;
}
.personal_info_body {}
.products-list {
  display: flex;
  gap: 50px;
}
input[type="text"] {
  width: 100px !important;
  margin-right: 20px;
}
.edit_personal_data {

}
.edit_profile_btn {
  border: black 1px dashed;
  margin-top: 20px;
  padding: 10px;
  cursor: pointer;
  max-width: 230px;
}
.booking_date p {
  margin-top: 10px;
  text-align: center;
  font-size: 20px;
}
</style>