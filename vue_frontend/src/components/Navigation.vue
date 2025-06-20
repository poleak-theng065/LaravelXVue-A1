<template>
<nav class="h-16 flex items-center justify-center shadow-md bg-blue-200">
  <div id="nav-item" class="flex gap-35">
    <NavigationItem
      v-for="item in navItems"
      :key="item.label"
      :item="item"
      :to="item.path"
    />
  </div>
</nav>

</template>

<script setup>
import NavigationItem from "./NavigationItem.vue";
import { ref } from "vue";

const navItems = ref([
  { label: "HomeView", path: "/", icon: "home" },
  { label: "AboutView", path: "/about",icon:"3p" },
  { label: "ContactView", path: "/contact", icon:"account_circle"},
 
]);
</script>

<style lang="scss" scoped>
</style>