<template>
  <div>
    <section class="main-sec">
      <div class="wrapper">
        <div class="promo-codes">
          <div v-for="promo in promos" :key="promo.id" class="promo">
            <div class="promo-img">
              <img :src="'http://frontend/src/assets/img/' + promo.img" :alt="promo.title" />
            </div>
            <div class="promo-content">
              <h1>{{ promo.title }}</h1>
              <p>{{ promo.description }}</p>
            </div>
          </div>
        </div>
      </div>
    </section>
  </div>
</template>
<script>

export default {
  name: "Promo",
  components: {
  },
  data() {
    return {
      promos: [],
    };
  },
  async mounted() {
    try {
      fetch("http://frontend/src/api/promoData.php", {
        headers: {
          "Accept": "application/json",
          "Content-Type": "application/json"
        }
      }).then(response => response.json())
          .then(data => (this.promos = data));
    } catch (error) {
      console.log(error);
    }
  },
};
</script>