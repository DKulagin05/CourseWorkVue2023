<template>
  <div class="slider">
    <div class="slider-track" :style="{ transform: `translateX(-${sliderPosition}%)` }">
      <div class="slider-item" v-for="(item, index) in items" :key="index">
        {{ item }}
      </div>
    </div>
    <div class="slider-controls">
      <button @click="prevSlide" :disabled="currentSlide === 0">Prev</button>
      <button @click="nextSlide" :disabled="currentSlide === items.length - 1">Next</button>
    </div>
  </div>
</template>

<script>
export default {
  data() {
    return {
      items: ["Slide 1", "Slide 2", "Slide 3", "Slide 4"],
      currentSlide: 0,
      sliderPosition: 0,
      sliderWidth: 100,
    };
  },
  methods: {
    nextSlide() {
      this.currentSlide++;
      this.sliderPosition = this.currentSlide * (this.sliderWidth / this.items.length);
    },
    prevSlide() {
      this.currentSlide--;
      this.sliderPosition = this.currentSlide * (this.sliderWidth / this.items.length);
    },
  },
};
</script>

<style>
.slider {
  position: relative;
  width: 100%;
  overflow: hidden;
}

.slider-track {
  display: flex;
  transition: transform 0.3s ease-in-out;
}

.slider-item {
  flex: 1;
  min-width: 100%;
}

.slider-controls {
  position: absolute;
  bottom: 0;
  left: 50%;
  transform: translateX(-50%);
}

.slider-controls button {
  margin: 0 10px;
}
</style>
