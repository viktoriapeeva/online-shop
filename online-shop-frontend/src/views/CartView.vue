<template>
  <div class="container mx-auto mt-8 p-4 bg-white shadow-md rounded-lg text-black">
    <h1 class="text-2xl font-bold mb-4">Shopping Cart</h1>
    <!-- <CartSidebar /> -->
    <div class="mt-4">
      <h2 class="text-xl font-semibold">Products</h2>

      <div class="grid grid-cols-1 gap-4">
        <div v-for="product in cart" :key="product.id">
          <CartProduct :product="product" />
        </div>
      </div>
      <div v-if="cart.length === 0" class="text-center text-gray-500 mt-4">Your cart is empty.</div>
      <div class="flex justify-between items-center mt-4">
        <h2 class="text-xl font-semibold">
          Total Price: <span class="text-green-600">${{ totlalPrice }}</span>
        </h2>
        <button
          @click="toCheckout"
          class="bg-blue-500 text-white px-4 py-2 rounded hover:bg-blue-600"
        >
          Checkout
        </button>
      </div>
    </div>
  </div>
</template>
<script setup>
import { computed } from 'vue'
import { useRouter } from 'vue-router'
import { useProductStore } from '../stores/product.store'
import CartProduct from '../components/CartProduct.vue'

const productStore = useProductStore()
const cart = computed(() => productStore.cart)
const totlalPrice = computed(() => productStore.totalPrice.toFixed(2))
const router = useRouter()

function toCheckout() {
  router.push('/checkout')
}
</script>
