<script setup>
import { RouterView } from 'vue-router'
import NavigationBar from './components/NavigationBar.vue'
import { useAuthStore } from './stores/auth.store'

const authStore = useAuthStore()
const auth = authStore.user
</script>

<template>
  <div v-if="auth !== null || !authStore.isLoading"><NavigationBar /></div>
  <RouterView />
</template>
