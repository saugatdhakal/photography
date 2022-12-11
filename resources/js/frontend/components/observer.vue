<template>
  <div class="observer" style="height: 15px; display: block"></div>
</template>

<script setup>
import { onMounted, onUnmounted, ref } from "@vue/runtime-core";
const observer = ref(null);
const props = defineProps({
  option: {
    type: Object,
    define: {},
    required: true,
  },
  observerFlag: {
    type: Boolean,
    define: true,
    required: false,
  },
});

const emit = defineEmits(["observerCall"]);

onMounted(() => {
  const targetElement = document.querySelector(".observer");
  observer.value = new IntersectionObserver((enteries, observerImages) => {
    enteries.forEach((entery) => {
      if (entery && entery.isIntersecting && props.observerFlag) {
        emit("observerCall");
      }
    });
  }, props.option);
  observer.value.observe(targetElement);
});
onUnmounted(() => {
  observer.value.disconnect();
});
</script>

<style>
</style>
