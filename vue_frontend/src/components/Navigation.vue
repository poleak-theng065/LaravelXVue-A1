<template>
    <nav class="h-20 flex items-center justify-between shadow-md bg-blue-200 p-10">
        <div>
            <h1>logo</h1>
        </div>
        <div><input type="search" class="bg-gray-200 border-2 border-blue-400  rounded-full px-3 py-1.5 w-100" placeholder="search here"></div>
  <div id="nav-item" class="flex pr-20 gap-10">
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
  { label: "Home", path: "/", icon: "home" },
  { label: "Book", path: "/book",icon:"3p" },
  { label: "Author", path: "/author", icon:"account_circle"},
  { label: "Member", path: "/member", icon:"account_circle"},
 
]);
</script>

<style lang="scss" scoped>
</style>