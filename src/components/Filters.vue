<template>
  <section class="filters">
    <div class="wrapper">
      <div class="filters-title">
        <div class="filters-title-text">Каталог</div>
        <div class="filters-title-filters"></div>
      </div>
      <form class="filters-more-filters">
        <div class="filters-more-filters-price">
          <p>Цена</p>
          <div class="filters-more-filters-price-inputs">
            <input class="input" id="search_price_start" type="text" placeholder="От" v-model="priceFrom" />
            <div class="line_filters"></div>
            <input class="input" id="search_price_end" type="text" placeholder="До" v-model="priceTo" />
          </div>
        </div>
        <div class="filters-more-filters-sort">
          <p>Сортировка</p>
          <select name="filters-more-filters-sort" v-model="sortType">
            <option value="0">Дешёвые</option>
            <option value="1">Дорогие</option>
          </select>
          <p>Количество человек</p>
          <select name="filters-more-filters-sort" v-model="peopleCount">
            <option value="0">Все</option>
            <option value="1">1</option>
            <option value="2">2</option>
            <option value="4">4</option>
          </select>
        </div>
      </form>
    </div>
  </section>
</template>

<script>
export default {
  name: "Filters"
}
</script>

<style scoped>

</style>