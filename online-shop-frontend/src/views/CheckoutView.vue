<template>
  <div>
    <div class="container mx-auto mt-8 p-4 bg-white shadow-md rounded-lg text-black">
      <h1 class="text-2xl font-bold mb-4">User Details</h1>
      <div v-if="user" class="flex flex-col md:flex-row">
        <div v-if="!isEditing" class="md:ml-6 mt-4 md:mt-0">
          <h2 class="text-xl font-semibold">Name: {{ user.name }}</h2>
          <p class="text-gray-500">Email: {{ user.email }}</p>
          <p class="text-gray-500">Address: {{ user.address || 'Not provided' }}</p>
          <p class="text-gray-500">Phone: {{ user.phone || 'Not provided' }}</p>
          <button
            @click="isEditing = !isEditing"
            class="mt-4 bg-blue-500 text-white px-4 py-2 rounded hover:bg-blue-600"
          >
            Edit Details
          </button>
        </div>
        <div v-else class="flex flex-col md:ml-6 mt-4 md:mt-0">
          <input
            type="text"
            v-model="user.name"
            class="border p-2 rounded mb-2"
            placeholder="Name"
          />
          <input
            type="email"
            v-model="user.email"
            class="border p-2 rounded mb-2"
            placeholder="Email"
          />
          <input
            type="text"
            v-model="user.address"
            class="border p-2 rounded mb-2"
            placeholder="Address"
          />
          <input
            type="text"
            v-model="user.phone"
            class="border p-2 rounded mb-2"
            placeholder="Phone"
          />
          <button
            @click="editUserDetails()"
            class="mt-4 bg-blue-500 text-white px-4 py-2 rounded hover:bg-blue-600"
          >
            Save Details
          </button>
        </div>
      </div>
      <div v-else class="flex justify-center items-center h-screen">
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
      <!-- payment details dropdown with pick payment method -->

      <!-- proucts -->
      <h1 class="text-2xl font-bold mb-4 mt-8">Products</h1>
      <div class="grid grid-cols-1 gap-4">
        <div v-for="product in cart" :key="product.id">
          <CartProduct :product="product" />
        </div>
      </div>
      <h1 class="text-2xl font-bold mb-4 mt-8">Payment Details</h1>
      <div class="flex flex-col md:flex-row">
        <div class="md:ml-6 mt-4 md:mt-0">
          <h2 class="text-xl font-semibold">Payment Method</h2>
          <select v-model="selectedPaymentMethod" class="border p-2 rounded mb-2">
            <option v-for="method in paymentMethods" :key="method.id" :value="method.name">
              {{ method.name }}
            </option>
          </select>
        </div>
      </div>
      <div class="flex justify-between items-center mt-4">
        <h2 class="text-xl font-semibold">
          Total Price: <span class="text-green-600">${{ totlalPrice }}</span>
        </h2>
        <button
          @click="handleOrder"
          class="bg-blue-500 text-white px-4 py-2 rounded hover:bg-blue-600"
        >
          Checkout
        </button>
      </div>
    </div>
  </div>
</template>
<script setup>
import { onMounted, computed, ref } from 'vue'
import { useAuthStore } from '../stores/auth.store'
import { useOrderStore } from '@/stores/order.store'
import { useProductStore } from '@/stores/product.store'
import CartProduct from '@/components/CartProduct.vue'
import { useRouter } from 'vue-router'

const authStore = useAuthStore()
const productStore = useProductStore()
const orderStore = useOrderStore()
const router = useRouter()
const cart = computed(() => productStore.cart)
const user = computed(() => authStore.user)
const selectedPaymentMethod = ref('creditCard')
const paymentMethods = ref([
  { id: 1, name: 'Credit Card' },
  { id: 2, name: 'PayPal' },
  { id: 3, name: 'Bank Transfer' },
])

const isEditing = ref(false)
const totlalPrice = computed(() => productStore.totalPrice.toFixed(2))

const userDetails = ref({
  name: user.value.name,
  email: user.value.email,
  address: user.value.address,
  phone: user.value.phone,
})

onMounted(() => {
  if (!user.value) {
    authStore.fetchUser()
  }
})

function handleOrder() {
  const orderDetails = {
    user_id: user.value.id,
    products: cart.value.map((product) => ({
      id: product.id,
    })),
    total_price: productStore.totalPrice,
    status: 'pending',
    shipping_address: user.value.address,
    payment_method: selectedPaymentMethod.value,
  }

  orderStore
    .createOrder(orderDetails)
    .then(() => {
      productStore.clearCart()
      router.push({ name: 'orders' })
    })
    .catch((error) => {
      console.error('Error creating order:', error)
    })
}

function editUserDetails() {
  isEditing.value = !isEditing.value
  if (!isEditing.value) {
    authStore.updateUser(userDetails.value)
  }
}
</script>
