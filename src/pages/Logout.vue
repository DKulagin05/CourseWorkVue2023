<template>
  <div>
    <h1>Вы не должны это видеть</h1>
  </div>
</template>

<script>
export default {
  mounted() {
    localStorage.clear();
    this.$router.push('/login');
  }
}
</script>
