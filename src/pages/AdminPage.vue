<template>
  <div class="wrapper" style="display:flex; gap: 150px; justify-content: space-around; padding-top: 50px;">
    <div class="universal_block">
      <h1>Создание номера</h1>
      <div class="create_room">
        <label for="create_title">Название</label>
        <textarea v-model="title" id="create_title" cols="30" rows="2"></textarea>
        <label for="create_description">Описание</label>
        <textarea v-model="description" id="create_description" cols="30" rows="2"></textarea>
        <label for="create_people_count">Кол-во человек</label>
        <input v-model="peopleCount" id="create_people_count" type="text">
        <label for="create_square">Площадь помещения</label>
        <input v-model="square" id="create_square" type="text">
        <label for="create_price">Цена</label>
        <input v-model="price" id="create_price" type="text">
        <div class="room_services">
          <h3>Включено в номер:</h3>
          <label for="new_Minibar">Минибар:</label>
          <input type="checkbox" id="new_Minibar" @change="new_MinibarChecked">
          <label for="new_TV">TV:</label>
          <input type="checkbox" id="new_TV" @change="new_TVChecked">
          <label for="new_WiFi">WiFi:</label>
          <input type="checkbox" id="new_WiFi" @change="new_WiFiChecked">
          <label for="new_Conditioner">Кондиционер:</label>
          <input type="checkbox" id="new_Conditioner" @change="new_ConditionerChecked">
        </div>
        <label>Изображения:</label>
        <input @change="onFileSelected_1" id="create_img_1" type="file" class="create_img">
        <input @change="onFileSelected_2" id="create_img_2" type="file" class="create_img">
        <input @change="onFileSelected_3" id="create_img_3" type="file" class="create_img">
        <button @click="createProduct" class="create_room_btn">Сохранить изменения</button>
      </div>
    </div>
    <div class="universal_block">
      <h1>Удаление номера</h1>
      <form @submit.prevent="submitFormDelete">
        <label for="search_delete">Введите id или название номера</label>
        <div class="" style="display:flex;">
          <input  v-model="searchInput" id="search_delete" type="text" />
          <input  type="submit" class="delete_room" />
        </div>

      </form>
      <div class="search_remove_room_get">
        <div class="search_room_delete_result" v-if="existingResultDelete">
          <table>
            <thead>
            <tr>
              <th style="color: black">id</th>
              <th style="color: black">title</th>
              <th style="color: black">description</th>
              <th style="color: black">people_count</th>
              <th style="color: black">square</th>
              <th style="color: black">price</th>
            </tr>
            </thead>
            <tbody>
            <tr>
              <td id="delete_id">{{room.id}}</td>
              <td id="delete_title">{{room.title}}</td>
              <td>{{room.description}}</td>
              <td>{{room.people_count}}</td>
              <td>{{room.square}}</td>
              <td>{{room.price}}</td>
              <td><button class="redact_product" @click="deleteProduct">Удалить</button></td>
            </tr>
            </tbody>
          </table>
        </div>
      </div>
    </div>
  </div>
<div class="wrapper">
  <div class="universal_block" style="padding-bottom: 250px; margin-top: 50px">
    <h1>Изменение номера</h1>
    <form @submit.prevent="submitFormEdit">
      <label for="search_edit">Введите id или название номера</label>
      <div class="" style="display:flex;">
        <input  v-model="searchInputEdit" id="search_edit" type="text" />
        <input  type="submit" class="delete_room" />
      </div>

    </form>
    <div class="search_remove_room_get">
      <div class="search_room_delete_result" v-if="existingResultEdit">
        <table>
          <thead>
          <tr>
            <th style="color: black">id</th>
            <th style="color: black">title</th>
            <th style="color: black">description</th>
            <th style="color: black">people_count</th>
            <th style="color: black">square</th>
            <th style="color: black">price</th>
            <th style="color: black">TV</th>
            <th style="color: black">WiFi</th>
            <th style="color: black">Conditioner</th>
            <th style="color: black">Minibar</th>
            <th style="color: black">Img</th>
          </tr>
          </thead>
          <tbody>
          <tr class="edit_module">
            <td id="edit_id">{{room_edit.id}}</td>
            <td>{{room_edit.title}}</td>
            <td>{{room_edit.description}}</td>
            <td>{{room_edit.people_count}}</td>
            <td>{{room_edit.square}}</td>
            <td>{{room_edit.price}}</td>
            <td>{{room_edit.TV}}</td>
            <td>{{room_edit.WiFi}}</td>
            <td>{{room_edit.Conditioner}}</td>
            <td>{{room_edit.Minibar}}</td>
            <td><button class="redact_product" @click="editProductShow">Редактировать</button></td>
          </tr>
          <tr v-if="editShow">
            <td>{{room_edit.id}}</td>
            <td><textarea name="" id="edit_title" cols="25" rows="3" v-model="room_edit.title"></textarea></td>
            <td><textarea name="" id="edit_description" cols="25" rows="3" v-model="room_edit.description"></textarea></td>
            <td><input id="edit_people_count" type="text" v-model="room_edit.people_count"></td>
            <td><input id="edit_square" type="text" v-model="room_edit.square"></td>
            <td><input id="edit_price" type="text" v-model="room_edit.price"></td>
            <td><input id="edit_TV" type="text" v-model="room_edit.TV"></td>
            <td><input id="edit_WiFi" type="text" v-model="room_edit.WiFi"></td>
            <td><input id="edit_Conditioner" type="text" v-model="room_edit.Conditioner"></td>
            <td><input id="edit_Minibar" type="text" v-model="room_edit.Minibar"></td>
            <div style="display:flex; flex-direction: column">
              <td><input type="file" @change="EditImgSelected1" class="edit_img" name="edit_profile_img_1" id="edit_profile_img_1"></td>
              <td><input type="file" @change="EditImgSelected2" class="edit_img" name="edit_profile_img_2" id="edit_profile_img_2"></td>
              <td><input type="file" @change="EditImgSelected3" class="edit_img" name="edit_profile_img_3" id="edit_profile_img_3"></td>
            </div>
            <td><button class="redact_product" @click="editProduct">Сохранить изменения</button></td>
          </tr>
          </tbody>
        </table>
      </div>
    </div>
  </div>
  <div class="universal_block" style="margin-top: 100px; margin-bottom: 100px;">
    <h1>Создание спецпредложений</h1>
    <div class="Promotion_create" style="margin-bottom: 150px;">
      <label for="create_promotion_title">Название</label>
      <textarea name="" id="create_promotion_title" cols="25" rows="3" v-model="createPromotionTitle"></textarea>
      <label for="create_promotion_description">Описание</label>
      <textarea name="" id="create_promotion_description" cols="25" rows="3" v-model="createPromotionDescription"></textarea>
      <label for="create_promotion_img">Изображение</label>
      <input type="file" @change="CreatePromotionImgSelected" class="create_promotion_img" name="create_promotion_img" id="create_promotion_img">
      <button class="redact_product" @click="createPromotion">Сохранить изменения</button>
    </div>
  </div>
  <div class="universal_block" style="padding-bottom: 100px;  padding-bottom: 100px;">
    <h1>Удаление спецпредложения</h1>
    <form @submit.prevent="submitFormDeletePromo">
      <label for="search_delete_promo">Введите id или название спецпредложения</label>
      <div class="" style="display:flex;">
        <input  v-model="searchInputPromo" id="search_delete_promo" type="text" />
        <input  type="submit" class="delete_room" />
      </div>
    </form>
    <div class="search_remove_room_get">
      <div class="search_room_delete_result" v-if="existingResultDeletePromo">
        <table>
          <thead>
          <tr>
            <th style="color: black">id</th>
            <th style="color: black">title</th>
            <th style="color: black">description</th>
            <th style="color: black">img</th>
          </tr>
          </thead>
          <tbody>
          <tr>
            <td id="delete_id_promo">{{promos.id}}</td>
            <td id="delete_title_promo">{{promos.title}}</td>
            <td>{{promos.description}}</td>
            <td>{{promos.img}}</td>
            <td><button class="redact_product" @click="deletePromotion">Удалить</button></td>
          </tr>
          </tbody>
        </table>
      </div>
    </div>
  </div>

</div>

</template>

<script>
export default {
  data() {
    return {
      title: '',
      description: '',
      peopleCount: '',
      square: '',
      price: '',
      create_img: null,
      selectedFile_1: null,
      selectedFile_2: null,
      selectedFile_3: null,
      searchInput: '',
      searchInputPromo: '',
      searchInputEdit: '',
      room: {},
      promos: {},
      room_edit: {},
      existingResultDelete: false,
      existingResultDeletePromo: false,
      existingResultEdit: false,
      new_Conditioner: false,
      selectedEditImg_1: null,
      selectedEditImg_2: null,
      selectedEditImg_3: null,
      createPromotionTitle: '',
      createPromotionDescription: '',
      CreatePromotionImg: null,
      new_WiFi: false,
      new_TV: false,
      new_Minibar: false,
      editShow: false
    }
  },
  methods: {
    EditImgSelected1(event) {
      this.selectedEditImg_1 = event.target.files[0]
    },
    EditImgSelected2(event) {
      this.selectedEditImg_2 = event.target.files[0]
    },
    EditImgSelected3(event) {
      this.selectedEditImg_3 = event.target.files[0]
    },
    CreatePromotionImgSelected(event) {
      this.CreatePromotionImg = event.target.files[0]
    },
    new_MinibarChecked() {
      this.new_Minibar = !this.new_Minibar
    },
    new_TVChecked() {
      this.new_TV = !this.new_TV
    },
    new_WiFiChecked() {
      this.new_WiFi = !this.new_WiFi
    },
    new_ConditionerChecked() {
      this.new_Conditioner = !this.new_Conditioner
    },
    onFileSelected_1(event) {
      this.selectedFile_1 = event.target.files[0]
    },
    onFileSelected_2(event) {
      this.selectedFile_2 = event.target.files[0]
    },
    onFileSelected_3(event) {
      this.selectedFile_3 = event.target.files[0]
    },
    createPromotion() {
      const formDataCreateProm = new FormData();
      formDataCreateProm.append('createPromotionTitle', this.createPromotionTitle)
      formDataCreateProm.append('createPromotionDescription', this.createPromotionDescription)
      formDataCreateProm.append('CreatePromotionImg', this.CreatePromotionImg)
      console.log(formDataCreateProm)
      fetch('http://frontend/src/api/createPromotions.php', {
        method: 'POST',
        body: formDataCreateProm,
      })
          .then(response => response.json())
          .then(data => {
            if (data.success) {
              alert(data.message)
              // this.existingResultEdit = false
            } else {
              alert(data.message)
            }
          })
          .catch(error => console.log(error));
    },
    editProduct() {
      const formDataEdit = new FormData();
      formDataEdit.append('edit_id', this.room_edit.id)
      formDataEdit.append('edit_product_img_1', this.selectedEditImg_1)
      formDataEdit.append('edit_product_img_2', this.selectedEditImg_2)
      formDataEdit.append('edit_product_img_3', this.selectedEditImg_3)
      formDataEdit.append('edit_title', this.room_edit.title)
      formDataEdit.append('edit_description', this.room_edit.description)
      formDataEdit.append('edit_people_count', this.room_edit.people_count)
      formDataEdit.append('edit_square', this.room_edit.square)
      formDataEdit.append('edit_price', this.room_edit.price)
      formDataEdit.append('edit_minibar', this.room_edit.Minibar)
      formDataEdit.append('edit_tv', this.room_edit.TV)
      formDataEdit.append('edit_wifi', this.room_edit.WiFi)
      formDataEdit.append('edit_conditioner', this.room_edit.Conditioner)
      console.log(formDataEdit)
      fetch('http://frontend/src/api/editProduct.php', {
        method: 'POST',
        body: formDataEdit,
      })
          .then(response => response.json())
          .then(data => {
            if (data.success) {
              alert(data.message)
              // this.existingResultEdit = false
            } else {
              alert(data.message)
            }
          })
          .catch(error => console.log(error));
    },
    createProduct() {
      const createData = new FormData()
      createData.append('create_img_1', this.selectedFile_1)
      createData.append('create_img_2', this.selectedFile_2)
      createData.append('create_img_3', this.selectedFile_3)
      createData.append('create_title', this.title)
      createData.append('create_description', this.description)
      createData.append('create_people_count', this.peopleCount)
      createData.append('create_square', this.square)
      createData.append('create_price', this.price)
      createData.append('create_minibar', this.new_Minibar ? 1 : 0)
      createData.append('create_tv', this.new_TV ? 1 : 0)
      createData.append('create_wifi', this.new_WiFi ? 1 : 0)
      createData.append('create_conditioner', this.new_Conditioner ? 1 : 0)
      console.log(createData)
      fetch("http://frontend/src/api/createProduct.php", {
        method: "POST",
        body: createData,
      })
          .then((response) => response.json())
          .then((data) => {
            if (data.success) {
              alert(data.message);
              // location.reload();
              console.log(data.tet)
            } else {
              alert(data.message);
              console.log(data.tet)
            }
          })
          .catch((error) => console.error(error));
    },
    submitFormDelete() {
      fetch('http://frontend/src/api/searchEditProduct.php', {
        method: 'POST',
        body: JSON.stringify({
          id: this.searchInput,
        }),
        headers: { 'Content-Type': 'application/json' },
      })
          .then((response) => response.json())
          .then((data) => {
            if (data.success) {
              this.room = data.message[0];
              this.existingResultDelete = true;
            } else {
              alert(data.message);
            }
          })
          .catch((error) => console.error(error));
    },
    submitFormDeletePromo() {
      fetch('http://frontend/src/api/searchDeletePromo.php', {
        method: 'POST',
        body: JSON.stringify({
          id: this.searchInputPromo,
        }),
        headers: { 'Content-Type': 'application/json' },
      })
          .then((response) => response.json())
          .then((data) => {
            if (data.success) {
              this.promos = data.message[0];
              this.existingResultDeletePromo = true;
            } else {
              alert(data.message);
            }
          })
          .catch((error) => console.error(error));
    },
    submitFormEdit() {
      fetch('http://frontend/src/api/searchEditProduct.php', {
        method: 'POST',
        body: JSON.stringify({
          id: this.searchInputEdit,
        }),
        headers: { 'Content-Type': 'application/json' },
      })
          .then((response) => response.json())
          .then((data) => {
            if (data.success) {
              this.room_edit = data.message[0];
              this.existingResultEdit = true;
            } else {
              alert(data.message);
            }
          })
          .catch((error) => console.error(error));
    },
    editProductShow() {
      this.editShow = !this.editShow
      console.log(typeof(this.room_edit.Minibar ? 1 : 0))

    },
    deletePromotion() {
      const delete_id = document.getElementById('delete_id_promo').textContent;
      const delete_title = document.getElementById('delete_title_promo').textContent;
      if (confirm('Вы уверены что хотите удалить предложение с id ' + delete_id + '?')) {
        fetch('http://frontend/src/api/deletePromo.php', {
          method: 'POST',
          body: JSON.stringify({
            delete_id,
            delete_title,
          }),
          headers: { 'Content-Type': 'application/json' },
        })
            .then((response) => response.json())
            .then((data) => {
              if (data.status) {
                alert(data.message);
                location.reload();
              } else {
                alert(data.message);
              }
            })
            .catch((error) => console.error(error));
      }
    },
    deleteProduct() {
      const delete_id = document.getElementById('delete_id').textContent;
      const delete_title = document.getElementById('delete_title').textContent;
      if (confirm('Вы уверены что хотите удалить номер с id ' + delete_id + '?')) {
        fetch('http://frontend/src/api/deleteProduct.php', {
          method: 'POST',
          body: JSON.stringify({
            delete_id,
            delete_title,
          }),
          headers: { 'Content-Type': 'application/json' },
        })
            .then((response) => response.json())
            .then((data) => {
              if (data.status) {
                alert(data.message);
                location.reload();
              } else {
                alert(data.message);
              }
            })
            .catch((error) => console.error(error));
      }
    },
  },
  mounted() {
    fetch('http://frontend/src/api/removeBooking.php', {})
  }
}
</script>


<style scoped>

/* Общий стиль для блоков */
.universal_block {
  background-color: #f2e8d8;
  padding: 20px;
  border-radius: 5px;
  box-shadow: 2px 2px 5px #c3c3c3;
}

/* Стиль для формы поиска и удаления номера */
form {
  display: flex;
  flex-direction: column;
  gap: 10px;
}

label {
  font-weight: bold;
  margin-bottom: 5px;
}

input[type="text"] {
  max-width: 50px;
  padding: 8px;
  border-radius: 5px;
  border: none;
  box-shadow: 1px 1px 3px #c3c3c3;
}

input[type="submit"] {
  padding: 10px 20px;
  background-color: #c8a165;
  color: #fff;
  border: none;
  border-radius: 5px;
  cursor: pointer;
}

/* Стили для таблицы с информацией о номере */
table {
  border-collapse: collapse;
  width: 100%;
  margin-top: 20px;
}

th,
td {
  padding: 10px;
  text-align: left;
  border-bottom: 1px solid #ccc;
}

th {
  background-color: #f2e8d8;
  color: #fff;
}

/* Стили для кнопки удаления */
.redact_product {
  padding: 8px;
  background-color: #c8a165;
  color: #fff;
  border: none;
  border-radius: 5px;
  cursor: pointer;
}

.redact_product:hover {
  background-color: #f2e8d8;
  color: #c8a165;
  border: 1px solid #c8a165;
}

/* Стили для формы создания номера */
.create_room {
  display: flex;
  flex-direction: column;
  gap: 10px;
}

textarea {
  padding: 8px;
  border-radius: 5px;
  border: none;
  box-shadow: 1px 1px 3px #c3c3c3;
}

.create_img {
  padding: 10px 20px;
  background-color: #c8a165;
  color: #fff;
  border: none;
  border-radius: 5px;
  cursor: pointer;
}

.edit_img {
  padding: 10px;
  max-width: 150px;
  background-color: #c8a165;
  color: #fff;
  border: none;
  border-radius: 5px;
  cursor: pointer;
}


.create_room_btn {
  padding: 10px 20px;
  background-color: #c8a165;
  color: #fff;
  border: none;
  border-radius: 5px;
  cursor: pointer;
}

.create_room_btn:hover {
  background-color: #f2e8d8;
  color: #c8a165;
  border: 1px solid #c8a165;
}

</style>