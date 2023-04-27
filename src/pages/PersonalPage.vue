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
<!--            <form class="edit_personal_data hide" v-if="editingProfile" @submit.prevent="saveChanges">-->
<!--              <div style="margin-bottom: 20px;">-->
<!--                <label for="edit_name">Имя:</label>-->
<!--                <input type="text" v-model="editedPersonalData.name" name="edit_name" id="edit_name" required>-->

<!--                <label for="edit_surname">Фамилия:</label>-->
<!--                <input type="text" v-model="editedPersonalData.surname" name="edit_surname" id="edit_surname" required>-->

<!--                <label for="edit_patronymic">Отчетство:</label>-->
<!--                <input type="text" v-model="editedPersonalData.patronymic" name="edit_patronymic" id="edit_patronymic">-->
<!--              </div>-->
<!--              <div style="margin-bottom: 20px;">-->
<!--                <label for="edit_phone">Телефон:</label>-->
<!--                <input type="text" v-model="editedPersonalData.phone" name="edit_phone" id="edit_phone" required>-->

<!--                <label for="edit_mail">Email:</label>-->
<!--                <input type="text" v-model="editedPersonalData.email" name="edit_mail" id="edit_mail" required>-->

<!--                <label for="edit_profile_img">Изображение профиля:</label>-->
<!--                <input type="file" v-model="editedPersonalData.profileImg" name="edit_profile_img" id="edit_profile_img">-->
<!--              </div>-->
<!--              <input type="submit" class="save_changes">-->
<!--            </form>-->
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
                  <input type="checkbox" :id="'meal-' + room.id" v-model="room.meal" disabled>
                  <label :for="'meal-' + room.id">Питание</label>
                </div>
                <div class="service">
                  <input type="checkbox" :id="'special-zones-' + room.id" v-model="room.specialZones" disabled>
                  <label :for="'special-zones-' + room.id">Посещение спец. зон</label>
                </div>
                <div class="service">
                  <input type="checkbox" :id="'transport-' + room.id" v-model="room.transport" disabled>
                  <label :for="'transport-' + room.id">Транспорт</label>
                </div>
                <div class="service">
                  <input type="checkbox" :id="'wake-up-' + room.id" v-model="room.wakeUp" disabled>
                  <label :for="'wake-up-' + room.id">Пробуждение</label>
                </div>
              </div>
              <div class="cancel_btn">
                <button class="book-button" @click="cancelBooking(room.id)">Отменить</button>
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
      editingProfile: false,
      editedPersonalData: {},
      token: localStorage.getItem('token'),
      personalBooking: [],
    };
  },
  methods: {
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
    checkboxLoad(){

    },
    editProfile() {
      const formData = new FormData();
      formData.append('name', this.personalData.name);
      formData.append('surname', this.personalData.surname);
      formData.append('patronymic', this.personalData.patronymic);
      formData.append('phone', this.personalData.phone);
      formData.append('email', this.personalData.email);
      formData.append('profileImg', this.profileImg);

      fetch('http://frontend/src/api/editPersonalData.php', {
        method: 'POST',
        body: formData,
        headers: { 'Authorization': `Bearer ${this.token}` }
      })
          .then(response => response.json())
          .then(data => {
            this.editMode = false;
            this.fetchPersonalData();
          })
          .catch(error => console.log(error));
    },

    onProfileImgChange(e) {
      this.profileImg = e.target.files[0];
    }

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
          this.personalBooking = data.message;
          console.log(data.result)
        })
        .catch(error => console.error(error));

  }
}
</script>

<style scoped>
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
  max-width: 199px;
}
</style>