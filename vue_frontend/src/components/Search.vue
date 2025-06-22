<template>
 
</template>

<script setup>
import { ref } from 'vue';

const searchInput = ref('');
const emit = defineEmits(['update:search']);

const onInput = () => {
  emit('update:search', searchInput.value);
};
</script>

<style scoped>
/* Optional styles */
</style>
