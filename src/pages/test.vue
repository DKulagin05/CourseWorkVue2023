<template>
  <div>
    <button @click="showMessage">Показать сообщение</button>
    <transition name="fade">
      <div v-if="displayMessage" class="message" :style="{ top: messageTop }">
        {{ messageText }}
      </div>
    </transition>
  </div>
</template>

<script>
export default {
  data() {
    return {
      displayMessage: false,
      messageText: "",
      messageTop: "200px"
    };
  },
  methods: {
    showMessage() {
      this.displayMessage = true;
      this.messageText = "Привет! Я появляющееся сообщение.";

      setTimeout(() => {
        this.displayMessage = false;
        setTimeout(() => {
          this.messageText = "";
        }, 500);
      }, 5000);
    }
  }
};
</script>

<style>
.message {
  position: fixed;
  top: 0;
  left: 0;
  width: 100%;
  max-width: 400px;
  background-color: yellow;
  padding: 10px;
  text-align: center;
  transition: top 0.5s;
}

.fade-enter {
  top: -100px;
}

.fade-leave-to {
  top: 200px;
}
</style>