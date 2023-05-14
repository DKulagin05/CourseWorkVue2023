<template>
  <div class="rating">
    <span
        v-for="star in stars"
        :key="star"
        @click="rate(star)"
        :class="{ filled: star <= selected }"
    >
      <img :src="star <= selected ? filledStar : emptyStar" alt="star">
    </span>
  </div>
</template>

<script>
export default {
  name: 'Rating',
  props: {
    value: {
      type: Number,
      required: true
    },
    emptyStar: {
      type: String,
      default: 'src/assets/img/emptyStar.png'
    },
    filledStar: {
      type: String,
      default: 'src/assets/img/filledStar.png'
    }
  },
  data() {
    return {
      stars: [1, 2, 3, 4, 5],
      selected: this.value
    }
  },
  methods: {
    rate(star) {
      this.selected = star;
      this.$emit('input', this.selected);
    }
  }
}
</script>

<style>
.rating {
  display: inline-block;
}
.rating img {
  width: 30px;
  height: 30px;
}
span {
  display: inline-block;
  margin-right: 5px;
  cursor: pointer;
}
.filled img {
  opacity: 1;
}
.empty img {
  opacity: 0.5;
}
</style>
