<template>
  <div class="wrapper">
    <div class="services-header">Наши дополнительные услуги</div>
    <div class="accordion-block" v-for="(item, index) in items" :key="item.id">
      <div class="accordion-header" @click="toggleAccordion(index)">
        <h3>{{ item.title }}</h3>
        <span :class="{'active': activeIndex === index}">&#8595;</span>
      </div>
      <div class="accordion-title" v-if="activeIndex === index">
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
    fetch("http://frontend/src/api/services.php", {
      method: "POST",
      body: JSON.stringify({}),
    })
        .then((response) => response.json())
        .then((data) => {
          this.items = data;
        })
        .catch((error) => console.error(error));
  },
  methods: {
    toggleAccordion(index) {
      this.activeIndex = this.activeIndex === index ? null : index;
    },
  },
};
</script>

<style scoped>
@import url('https://fonts.googleapis.com/css2?family=Jost:ital,wght@0,100;0,200;0,300;0,400;0,500;0,600;0,700;0,800;0,900;1,100;1,200;1,300;1,400;1,500;1,600;1,700;1,800;1,900&family=Montserrat:ital,wght@0,100;0,200;0,300;0,400;0,500;0,600;0,700;0,800;0,900;1,100;1,200;1,300;1,400;1,500;1,600;1,700;1,800;1,900&display=swap');
.wrapper {
  font-family: 'Jost', sans-serif;
  font-family: 'Montserrat', sans-serif;
}
.services-header {
  margin-top: 50px;
  font-size: 24px;
  font-weight: bold;
  color: #6d4c41;
  margin-bottom: 20px;
}

.accordion-block {
  margin-bottom: 20px;
}
.accordion-header span {
  transition: 0.4s ease;

}
.accordion-header {
  display: flex;
  justify-content: space-between;
  align-items: center;
  background-color: #e1d2c0;
  padding: 10px;
  cursor: pointer;
  transition: background-color 0.3s ease;
}

.accordion-header:hover {
  background-color: #d1c2b0;
}

.accordion-header h3 {
  font-size: 20px;
  font-weight: bold;
  color: #6d4c41;
  margin: 0;
  padding: 0 10px 0 10px;
}

.active {
  transform: rotate(180deg);
  transition: 0.4s ease;
}

.accordion-title {
  background-color: #f2ede4;
  padding: 10px;
  overflow: hidden;
  transition: max-height 0.3s ease-in-out;
}

.accordion-title p {
  font-size: 16px;
  color: #6d4c41;
  margin: 0;
  padding: 10px 10px 0 10px;
}

.active + .accordion-title {
  max-height: 500px;
}
</style>
