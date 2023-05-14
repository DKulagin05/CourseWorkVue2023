<template>
  <div class="rating">
    <span class="star" v-for="n in 5" :key="n" @click="setRating(n)">
      <i class="fa" :class="getClass(n)">
        0000
      </i>
    </span>
  </div>
</template>

<script>
export default {
  data() {
    return {
      rating: null,
    };
  },
  methods: {
    setRating(n) {
      this.rating = n;
      console.log(this.rating)
    },
    getClass(n) {
      return {
        'fa-star': n <= this.rating,
        'fa-star-o': n > this.rating,
      };
    },
  },
};
</script>

<style scoped>
.rating {
  display: flex;
  gap: 10px;
  font-size: 2rem;
  color: #bfa76d;
}

.star {
  cursor: pointer;
}

.fa {
  font-size: inherit;
}
.fa-star {
  width: 50px;
  height: 50px;
  background-image: url("@/assets/img/filledStar.png");
  background-repeat: no-repeat;
}
.fa-star-o {
  width: 50px;
  height: 50px;
  background-image: url("@/assets/img/emptyStar.png");
  background-repeat: no-repeat;
}
</style>
