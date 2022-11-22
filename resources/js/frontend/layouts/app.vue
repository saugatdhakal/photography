<template>
  <component :is="$route.meta.pageLayout || $route.meta.adminLayout || 'div'">
    <router-view />
  </component>
</template>
<script setup>
</script>
