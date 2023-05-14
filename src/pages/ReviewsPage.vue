<template>
  <div class="wrapper">
    <div class="review-form" v-if="user_name !== null">
      <h2>Оставить отзыв</h2>
      <form @submit.prevent="submitForm">
        <div class="form-group">
          <label for="name">Ваше имя</label>
          <input type="text" id="name" v-model="user_name" disabled>
        </div>
        <div class="form-group">
          <label for="rating">Оценка</label>
          <select id="rating" v-model="rating" required>
            <option value="" disabled>Выберите оценку</option>
            <option v-for="n in 5" :value="n">{{ n }}</option>
          </select>
        </div>
        <div class="form-group">
          <label for="title">Заголовок</label>
          <textarea id="title" v-model="title" rows="1" cols="30" required></textarea>
        </div>
        <div class="form-group">
          <label for="description">Комментарий</label>
          <textarea id="description" v-model="description" rows="3" cols="30" required></textarea>
        </div>
        <button type="submit">Отправить отзыв</button>
      </form>
    </div>
    <div class="" v-else>Зарегистрируйтесь или войдите в аккаунт чтобы оставить отзыв</div>
    <div class="reviews">
      <h2>Отзывы о нашем отеле</h2>
      <div v-for="(review, index) in paginatedReviews" :key="index" class="review">
        <div class="review_head">
          <p class="name">{{ review.user_name }}</p>
          <div class="review_delete">
            <p class="" v-if="id_user===review.id_user" @click="removeReview(review.id, review.title)">Удалить</p>
            <p class="" v-if="admin==='1'" @click="removeReview(review.id, review.title)">Удалить (Адм)</p>
          </div>
        </div>
        <p class="rating">{{ review.score }}/5</p>
        <p class="title">{{ review.title }}</p>
        <p class="description">{{ review.description }}</p>
        <p class="date">{{ formatDate(review.date) }}</p>
      </div>
      <div v-if="reviews.length === 0" class="no-reviews">
        <p>Пока нет отзывов. Будьте первым, кто оставит свой!</p>
      </div>
      <div class="pagination">
        <button v-if="currentPage > 1" @click="prevPage"> &lt; </button>
        <span class="pagination_counter">{{ currentPage }}</span>
        <button v-if="currentPage < pageCount" @click="nextPage"> > </button>
      </div>
    </div>
  </div>
</template>

<script>
export default {
  data() {
    return {
      user_name: null,
      reviews: [],
      title: "",
      name: "",
      date: "",
      rating: "",
      description: "",
      id_user: "",
      admin: 0,
      currentPage: 1, // текущая страница
      reviewsPerPage: 5, // количество отзывов на странице
    };
  },
  computed: {
    paginatedReviews() {
      const startIndex = this.reviews.length - (this.currentPage * this.reviewsPerPage);
      const endIndex = startIndex + this.reviewsPerPage;
      return this.reviews.slice(startIndex, endIndex).reverse();
    },
    pageCount() {
      return Math.ceil(this.reviews.length / this.reviewsPerPage);
    },
  },
  methods: {
    prevPage() {
      this.currentPage--;
    },
    nextPage() {
      this.currentPage++;
    },
    formatDate(date) {
      const options = { year: "numeric", month: "long", day: "numeric" };
      return new Date(date).toLocaleDateString("ru-RU", options);
    },
    submitForm() {
      // Отправить данные нового отзыва на сервер, обновить список отзывов
      fetch('http://frontend/src/api/createReview.php', {
        method: 'POST',
        body: JSON.stringify({
          id_user: this.id_user,
          user_name: this.user_name,
          title: this.title,
          description: this.description,
          rating: parseInt(this.rating)
        }),
      })
          .then((response) => response.json())
          .then((data) => {
            alert(data.message)
            location.reload();
          })
          .catch((error) => console.error(error));
    },
    removeReview(remove_id,remove_title) {
      if(confirm('Вы уверены, что хотите удалить отзыв "' + remove_title + '"')) {
        fetch('http://frontend/src/api/deleteReview.php', {
          method: 'POST',
          body: JSON.stringify({
            remove_id: remove_id
          }),
        })
            .then((response) => response.json())
            .then((data) => {
              alert(data.message)
              location.reload();
            })
            .catch((error) => console.error(error));
      }
    },

  },
  mounted() {
    const token = localStorage.getItem('token')
    fetch('http://frontend/src/api/JWTDecode.php', {
      method: 'POST',
      body: JSON.stringify({
        token: token,
      }),
    })
        .then((response) => response.json())
        .then((data) => {
          this.user_name = data.data['user_name']
          this.id_user = data.data['id']
          this.admin = data.data['admin']
        })
        .catch((error) => console.error(error));

    fetch('http://frontend/src/api/ReviewsData.php', {
      method: 'GET',
    })
        .then((response) => response.json())
        .then((data) => {
          this.reviews = data.message
        })
        .catch((error) => console.error(error));
  }
};
</script>

<style scoped>
.wrapper {
  padding-bottom: 100px;
}
.reviews {
  display: flex;
  flex-direction: column;
  align-items: center;
  margin: 20px;
}

.review {
  display: flex;
  flex-direction: column;
  border: 1px solid #ddd;
  border-radius: 10px;
  padding: 10px;
  margin: 10px;
  width: 80%;
  max-width: 600px;
  background-color: #f2e8d8;
}

.name {
  font-weight: bold;
  margin-bottom: 5px;
}
.review_head {
  display: flex;
  justify-content: space-between;
}
.review_delete {
  display: flex;
  gap: 20px;
}
.review_delete p {
  cursor: pointer;
  color: #916d48;
}
form button[type="submit"] {
  margin-left: auto;
  display: block;
}
.date {
  font-size: 14px;
  color: #777;
  margin-bottom: 5px;
}
.title {
  font-weight: 600;
  margin-bottom: 10px;
}
.rating {
  font-size: 18px;
  color: #f6b93b;
  margin-bottom: 5px;
}

.description {
  margin-bottom: 10px;
}

.no-reviews {
  margin-top: 20px;
  font-style: italic;
  text-align: center;
}
.review-form {
  margin: 20px;
  display: flex;
  flex-direction: column;
  align-items: center;
}

h2 {
  font-size: 32px;
  font-weight: bold;
  color: #3b3a36;
  margin-bottom: 20px;
}

.form-group {
  display: flex;
  justify-content: space-between;
  align-items: center;
  margin-bottom: 20px;
  gap: 20px;
}
.pagination {
  display: flex;
  align-items: center;
}
.pagination_counter {
  font-size: 30px;
  margin: 0 20px ;
}
label {
  font-weight: bold;
  margin-bottom: 5px;
  color: #3b3a36;
  font-size: 20px;
}

input[type="text"],
select,
textarea {
  padding: 10px;
  border-radius: 5px;
  border: 1px solid #ccc;
  font-size: 18px;
  color: #3b3a36;
  background-color: #f2e8d8;
}

textarea {
  resize: vertical;
}

button {
  background-color: #c8a165 ;
  color: #fff;
  padding: 10px 20px;
  border: none;
  border-radius: 5px;
  font-size: 20px;
  cursor: pointer;
}

button:hover {
  background-color: #a88452;
}
</style>