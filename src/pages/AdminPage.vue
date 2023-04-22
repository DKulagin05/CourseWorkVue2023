<template>
  <div class="wrapper" style="display:flex; gap: 150px; justify-content: space-around;">
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
        <label for="create_img">Изображение</label>
        <input @change="onFileSelected" id="create_img" type="file">
        <button @click="createProduct" class="create_room_btn">Сохранить изменения</button>
      </div>
    </div>
    <div class="universal_block">
      <h1>Удаление номера</h1>
      <form @submit.prevent="submitForm">
        <input v-model="searchInput" id="search_delete" type="text" />
        <label for="search_delete">Введите id или название номера</label>
        <input type="submit" class="delete_room" />
      </form>
      <div class="search_remove_room_get">
        <div class="search_room_delete_result" v-if="existingResultDelete">
          <table>
            <thead>
            <tr>
              <th>id</th>
              <th>title</th>
              <th>description</th>
              <th>people_count</th>
              <th>square</th>
              <th>price</th>
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
      selectedFile: null,
      searchInput: '',
      room: {},
      existingResultDelete: false,
    }
  },
  methods: {
    onFileSelected(event) {
      this.selectedFile = event.target.files[0]
    },
    createProduct() {
      const createData = new FormData()
      createData.append('create_img', this.selectedFile)
      createData.append('create_title', this.title)
      createData.append('create_description', this.description)
      createData.append('create_people_count', this.peopleCount)
      createData.append('create_square', this.square)
      createData.append('create_price', this.price)
      // console.log(createData)
      fetch("http://frontend/src/api/createProduct.php", {
        method: "POST",
        body: createData,
      })
          .then((response) => response.json())
          .then((data) => {
            if (data.status) {
              alert(data.message);
              location.reload();
              // window.location.href = "../product.php";
            } else {
              alert(data.message);
              console.log(data)
            }
          })
          .catch((error) => console.error(error));
    },
    submitForm() {
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
  }
}
</script>


<style scoped>
body {

}
input[type='text'] {
  width: 150px;
  border: 1px black solid !important;
  border-radius: 5px !important;
}
textarea {
  resize: none !important;
}
.create_room {
  display: flex;
  flex-direction: column;
  max-width: 300px;
}
.universal_block {
  display: flex;
  flex-direction: column;
  gap: 50px;
}
.adminPage_body {
  display: flex;
  flex-direction: row;
  gap: 50px;
  /*align-items: center;*/
  justify-content: center;
}
.create_room {
  display: flex;
  flex-direction: column;
  gap: 10px;
}
.redact_product_inputs {
  display: flex;
  flex-direction: column;
  max-width: 300px;
  gap: 10px;
  justify-content: center !important;
}
/*.remove_product_table {*/
/*    display: flex;*/
/*    gap: 5px !important;*/
/*}*/
</style>