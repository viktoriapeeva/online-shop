<template>
  <div class="flex items-center justify-between p-4 bg-white shadow-md rounded-lg mb-4 text-black">
    <div class="flex items-center">
      <div>
        <h2 class="text-lg font-semibold">{{ product.name }}</h2>
        <p>${{ product.price }}</p>
      </div>
    </div>
    <button
      @click="() => productStore.removeFromCart(product)"
      class="bg-red-500 text-white px-4 py-2 rounded hover:bg-red-600"
    >
      Remove
    </button>
  </div>
</template>
<script setup>
import { useProductStore } from '../stores/product.store'

defineProps({
  product: {
    type: Object,
    required: true,
  },
})
const productStore = useProductStore()
</script>
