<template>
  <div>
    <h2 class="text-xl text-gray-700 font-bold">{{ product.name }}</h2>
    <p class="text-gray-700">{{ product.description }}</p>
    <p class="text-lg font-semibold text-green-600">${{ product.price }}</p>
    <p class="text-gray-500">Category: {{ product.category.name }}</p>
    <p class="text-gray-500">Stock: {{ product.stock }}</p>
    <div class="flex justify-between mt-4">
      <button
        :class="[' text-white mt-4  p-2 rounded', inCart ? 'bg-red-500' : 'bg-blue-500']"
        @click="handleCart(product)"
      >
        {{ inCart ? 'Remove from Cart' : 'Add to Cart' }}
      </button>

      <button
        @click="$router.push('products/' + product.id)"
        class="bg-gray-300 text-gray-700 mt-4 p-2 rounded"
      >
        View Product
      </button>
    </div>
  </div>
</template>

<script setup>
import { defineProps, ref } from 'vue'
import { useProductStore } from '../stores/product.store'

const productStore = useProductStore()

const inCart = ref(productStore.cart.some((item) => item.id === this.product.id))

defineProps({
  product: {
    type: Object,
    required: true,
  },
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
