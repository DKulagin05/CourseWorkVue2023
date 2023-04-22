<template>
  <div>
    <div v-if="!success" class="products-list" style="font-size: 16px; display: flex; justify-content: center; margin-top: 30px;">
      <h3>{{ message }}</h3>
    </div>
    <div v-else>
      <form class="filters-more-fliters" @submit.prevent="filterProducts">
        <div class="form-group">
          <label for="search_price_start">Цена от:</label>
          <input type="number" class="form-control" id="search_price_start" v-model="priceFrom">
        </div>
        <div class="form-group">
          <label for="search_price_end">Цена до:</label>
          <input type="number" class="form-control" id="search_price_end" v-model="priceTo">
        </div>
        <div class="form-group">
          <label for="filters-more-fliters-sort">Сортировать:</label>
          <select class="form-control" id="filters-more-fliters-sort" v-model="sortBy">
            <option value="0">По возрастанию цены</option>
            <option value="1">По убыванию цены</option>
          </select>
        </div>
        <button type="submit" class="btn btn-primary">Применить</button>
      </form>
      <div class="products-list">
        <div v-for="product in filteredProducts" :key="product.id" class="personal_info_booking_unit">
          <img class="product_img" :src="'/assets/img/products/' + product.img" alt="#">
          <div class="info_booking_body">
            <div class="info_booking_main">
              <div class="info_booking_header">
                <h1>{{ product.title }}</h1>
              </div>
              <div class="info_booking_specifications">
                <div class="specifications_square">
                  <img src="@/assets/img/square.png" alt="#">
                  <p>{{ product.square }} кв. м</p>
                </div>
                <div class="specifications_person">
                  <img src="@/assets/img/person.png" alt="#">
                  <p>{{ product.people_count }} чел.</p>
                </div>
              </div>
              <div class="info_booking_price_btn" style="display:flex;">
                <div class="info_booking_price">
                  <h1>Цена</h1>
                  <p>{{ product.price }} р</p>
                </div>
                <div class="info_booking_btn data-id={{ product.id }}" @click="bookProduct(product.id)">Забронировать</div>
            </div>
          </div>
          <div class="info_booking_add_info hide">
            <div class="info_booking_add_block">
              <div class="info_add_top_block">
                <h1>Дополнительные услуги</h1>
                <div class="add_top_block_check">
                  <div class="checkbox_block">
                    <input type="checkbox" name="breakfast" id="breakfast">
                    <label for="breakfast">Завтрак</label>
                  </div>
                  <div class="checkbox_block">
                    <input type="checkbox" name="dinner" id="dinner">
                    <label for="dinner">Ужин</label>
                  </div>
                  <div class="checkbox_block">
                    <input type="checkbox" name="parking" id="parking">
                    <label for="parking">Парковка</label>
                  </div>
                </div>
                <div class="info_add_bottom_block">
                  <h1>Количество гостей:</h1>
                  <div class="guests_select">
                    <div class="guests_select_item" @click="setGuestsCount(1)" :class="{ active: guestsCount === 1 }">1</div>
                    <div class="guests_select_item" @click="setGuestsCount(2)" :class="{ active: guestsCount === 2 }">2</div>
                    <div class="guests_select_item" @click="setGuestsCount(3)" :class="{ active: guestsCount === 3 }">3</div>
                    <div class="guests_select_item" @click="setGuestsCount(4)" :class="{ active: guestsCount === 4 }">4</div>
                    <div class="guests_select_item" @click="setGuestsCount(5)" :class="{ active: guestsCount === 5 }">5</div>
                    <div class="guests_select_item" @click="setGuestsCount(6)" :class="{ active: guestsCount === 6 }">6</div>
                  </div>
                </div>
              </div>
              <div class="info_add_bottom_block">
                <h1>Дата заселения:</h1>
                <input type="date" v-model="checkinDate">
              </div>
              <div class="info_add_bottom_block">
                <h1>Дата выезда:</h1>
                <input type="date" v-model="checkoutDate">
              </div>
            </div>
            <div class="info_booking_add_info_close" @click="toggleBookingDetails(product.id)">Отменить</div>
            <div class="info_booking_add_info_reserve" @click="reserveProduct(product.id)">Забронировать</div>
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
      products: [],
      priceFrom: null,
      priceTo: null,
      sortBy: 0,
      guestsCount: 1,
      checkinDate: null,
      checkoutDate: null,
      success: false,
      message: '',
    }
  },
  mounted() {
    // Load products data from API
    this.loadProducts();
  },
  methods: {
    loadProducts() {
      // Make API request to load products data
      // Save response to this.products
    },
    filterProducts() {
      // Filter products based on selected filters and sort order
    },
    setGuestsCount(count) {
      this.guestsCount = count;
    },
    toggleBookingDetails(productId) {
      // Toggle show/hide of booking details form for selected product
    },
    bookProduct(productId) {
      // Open booking details form for selected product
    },
    reserveProduct(productId) {
      // Make API request to reserve selected product with selected options
    },
  },
  computed: {
    filteredProducts() {
      // Compute filtered and sorted products based on selected filters and sort order
      return [];
    },
  },
};
</script>