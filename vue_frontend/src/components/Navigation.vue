<template>
    <nav class="h-20 flex items-center justify-between shadow-md bg-blue-200 p-10">
        <div class="img">
            <img src="../assets/image.png" class="w-20">
        </div>
  <div id="nav-item" class="flex pr-20 gap-10 ">
    <NavigationItem class="active:bg-blue-300 hover:bg-blue-700 hover:text-white p-2 hover:rounded-full  "
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
import Search from "./Search.vue";
import { ref } from "vue";

const navItems = ref([
  { label: "Home", path: "/", icon: "home" },
  { label: "Book", path: "/book",icon:"menu_book" },
  { label: "Author", path: "/author", icon:"account_circle"},
  { label: "Member", path: "/member", icon:"group_add"},
 
]);
</script>

<style lang="scss" scoped>
</style>