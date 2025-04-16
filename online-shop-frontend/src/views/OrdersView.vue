<template>
  <div>
    <!-- List of orders -->
    <h1 class="text-2xl font-bold mb-4">Orders</h1>
    <div class="overflow-x-auto">
      <table class="min-w-full bg-black text-white border border-gray-200">
        <thead>
          <tr>
            <th class="px-4 py-2 border-b">Order ID</th>
            <th class="px-4 py-2 border-b">Total Amount</th>
            <th class="px-4 py-2 border-b">Status</th>
          </tr>
        </thead>
        <tbody>
          <tr v-for="order in orders" :key="order.id">
            <td class="px-4 py-2 border-b">{{ order.id }}</td>
            <td class="px-4 py-2 border-b">${{ order.total_price }}</td>
            <td class="px-4 py-2 border-b">{{ order.status }}</td>
          </tr>
        </tbody>
      </table>
    </div>
  </div>
</template>
<script setup>
import { computed, onMounted } from 'vue'
import { useOrderStore } from '../stores/order.store'

const orderStore = useOrderStore()
const orders = computed(() => orderStore.orders)

onMounted(async () => {
  await fetchOrders()
})

const fetchOrders = async () => {
  try {
    orders.value = await orderStore.fetchOrders()
  } catch (error) {
    console.error('Error fetching orders:', error)
  }
}
</script>
