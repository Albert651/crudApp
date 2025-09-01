
<template>
  <transition name="fade">
    <div v-if="visible" class="fixed top-5 right-5 bg-green-500 text-white px-6 py-3 rounded-lg shadow-lg z-50">
      {{ message }}
    </div>
  </transition>
</template>

<script>
export default {
  props: ['message'],
  data() {
    return {
      visible: true
    };
  },
  mounted() {
    setTimeout(() => this.visible = false, 3000);
  }
};
</script>

<style>
.fade-enter-active,
.fade-leave-active {
  transition: opacity 0.5s;
}
.fade-enter-from,
.fade-leave-to {
  opacity: 0;
}
</style>
