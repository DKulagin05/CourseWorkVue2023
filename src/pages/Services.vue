<template>
  <div class="wrapper">
    <div class="services_header">Наши дополнительные услуги</div>
    <div class="accordion_block" v-for="(item, index) in items" :key="item.id">
      <div class="accordion_header" @click="toggleAccordion(index)">
        <h3>{{ item.title }}</h3>
        <span :class="{'active': activeIndex === index}">&#8595;</span>
      </div>
      <div class="accordion_title" v-if="activeIndex === index">
        <p>{{ item.description }}</p>
      </div>
    </div>
  </div>
</template>
<script>
export default {
  data() {
    return {
      activeIndex: null,
      items: [],
    };
  },
  mounted() {
    fetch('http://frontend/src/api/services.php', {
      method: 'POST',
      body: JSON.stringify({})
    })
        .then(response => response.json())
        .then(data => {
          this.items = data;
        })
        .catch(error => console.error(error));
  },
  methods: {
    toggleAccordion(index) {
      this.activeIndex = this.activeIndex === index ? null : index;
    },
  },
};
</script>
<style scoped>
.services_header {
  font-size: 32px;
  margin-top: 50px;
}

.accordion_header {
  display: flex;
  align-items: center;
  width: 500px;
  padding: 15px;
  margin: 10px;
  height: 50px;
  border: 1px solid #916d48;
  justify-content: space-between;
}
.wrapper {
  display: flex;
  align-items: center;
  flex-direction: column;
}
h3 {
  padding: 0;
  margin: 0;
  cursor: pointer;
  font-size: 24px;
  background-color: transparent;
  display: flex;
  align-items: center;
  justify-content: center;
  line-height: 16px;
  color: #1ba39e;
}
p {
  border: 1px solid #1ba39e;
  padding: 10px;
}
.accordion_block {
  max-width: 700px;
  display: flex;
  flex-direction: column;
  align-items: center;
}
.active {
  transform: rotate(180deg);
}
</style>