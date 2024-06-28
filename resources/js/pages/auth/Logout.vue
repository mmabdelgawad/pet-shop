<script setup>
import { useAuthStore } from '../../stores/auth/authStore.js';
import { onMounted } from 'vue';

const authStore = useAuthStore();

onMounted(() => {
    authStore.logout();
});
</script>

<template></template>

<style scoped></style>
