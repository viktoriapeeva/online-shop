<template>
  <!-- Single Product Page -->
  <div class="container mx-auto mt-10 p-4 bg-white shadow-md rounded-lg">
    <div
      v-if="productStore.isLoading || product == null"
      class="flex justify-center items-center h-screen"
    >
      <svg
        class="animate-spin h-10 w-10 text-blue-500"
        xmlns="http://www.w3.org/2000/svg"
        fill="none"
        viewBox="0 0 24 24"
        stroke="currentColor"
        stroke-width="2"
        role="status"
        aria-label="Loading"
      >
        <path
          stroke-linecap="round"
          stroke-linejoin="round"
          d="M12 4v1m0 14v1m8.485-8.485l-.707.707M5.515 5.515l-.707.707m14.142 0l-.707-.707M5.515 18.485l-.707-.707m14.142 0l-.707.707M12 4a8 8 0 100 16 8 8 0 000-16z"
        />
      </svg>
    </div>
    <div v-else class="flex flex-col md:flex-row">
      <div class="md:ml-6 mt-4 md:mt-0">
        <h1 class="text-2xl font-bold text-gray-800">{{ product.name }}</h1>
        <p class="text-gray-600 mt-2">{{ product.description }}</p>
        <p class="text-lg font-semibold text-green-600 mt-4">${{ product.price }}</p>
        <p class="text-gray-500">Category: {{ product.category.name }}</p>
        <p class="text-gray-500">Stock: {{ product.stock }}</p>
        <button
          @click="handleCart(product)"
          :class="['mt-4 text-white px-4 py-2 rounded', inCart ? 'bg-red-500' : 'bg-blue-500']"
          class="mt-4 bg-blue-500 text-white px-4 py-2 rounded hover:bg-blue-600"
        >
          {{ inCart ? 'Remove from Cart' : 'Add to Cart' }}
        </button>
      </div>
    </div>
  </div>
</template>
<script setup>
import { onMounted, computed, ref } from 'vue'
import { useProductStore } from '../stores/product.store'
import { useRoute } from 'vue-router'

const route = useRoute()
const inCart = ref(false)
const productId = route.params.id
const productStore = useProductStore()
const product = computed(() => productStore.product)

onMounted(async () => {
  await productStore.fetchProduct(productId)
  inCart.value = productStore.cart.some((item) => item.id === product.value.id)
})

function handleCart(product) {
  if (!inCart.value) {
    productStore.addToCart(product)
    inCart.value = true
  } else {
    productStore.removeFromCart(product)
    inCart.value = false
  }
}
</script>
