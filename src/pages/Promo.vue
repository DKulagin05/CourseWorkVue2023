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
<style scoped>
.main-sec {
  padding: 50px 0;
}

.promo-codes {
  display: flex;
  gap: 10px;
  flex-wrap: wrap;
  justify-content: center;
}

.promo {
  display: flex;
  flex-direction: column;
  width: 400px;
  margin: 20px;
  background-color: #ffffff;
  border-radius: 5px;
  box-shadow: 0 0 5px 0 rgba(0, 0, 0, 0.3);
  transition: all 0.3s ease;
}

.promo:hover {
  box-shadow: 0 0 10px 0 rgba(0, 0, 0, 0.3);
  transform: translateY(-5px);
}

.promo-img {
  width: 100%;
  height: 150px;
  overflow: hidden;
  border-top-left-radius: 5px;
  border-top-right-radius: 5px;
}

.promo-img img {
  width: 100%;
  height: 100%;
  object-fit: cover;
}

.promo-content {
  padding: 20px;
  text-align: center;
}

.promo-content h1 {
  margin-bottom: 10px;
  font-size: 24px;
  font-weight: 600;
  color: #333333;
}

.promo-content p {
  font-size: 16px;
  line-height: 1.5;
  color: #666666;
}
</style>