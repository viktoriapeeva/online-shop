<template>
  <nav class="bg-gray-800">
    <div class="mx-auto max-w-7xl px-2 sm:px-6 lg:px-8">
      <div class="relative flex h-16 items-center">
        <div class="flex flex-1 items-center justify-center sm:items-stretch sm:justify-start">
          <div class="flex shrink-0 items-center">
            <img
              class="h-8 w-auto"
              src="https://tailwindcss.com/plus-assets/img/logos/mark.svg?color=indigo&shade=500"
              alt="Your Company"
            />
          </div>
          <div class="hidden sm:ml-6 sm:block">
            <div class="flex space-x-4">
              <RouterLink
                to="/"
                class="rounded-md px-3 py-2 text-sm font-medium text-gray-300 hover:bg-gray-700 hover:text-white"
              >
                Store
              </RouterLink>

              <select
                class="rounded-md px-3 py-2 text-sm font-medium text-gray-300 hover:bg-gray-700 hover:text-white"
                @change="filterProductsByCategory($event.target.value)"
              >
                <option value="" disabled selected>Categories</option>
                <option value="all">All</option>
                <option v-for="category in categories" :key="category.id" :value="category.id">
                  {{ category.name }}
                </option>
              </select>

              <RouterLink
                v-if="orderStore.orders.length > 0"
                to="/orders"
                class="rounded-md px-3 py-2 text-sm font-medium text-gray-300 hover:bg-gray-700 hover:text-white"
              >
                Orders
              </RouterLink>
            </div>
          </div>
        </div>
        <div
          class="absolute inset-y-0 right-0 flex items-center pr-2 sm:static sm:inset-auto sm:ml-6 sm:pr-0"
        >
          <button
            type="button"
            @click="$router.push('/cart')"
            class="relative p-2 hover:bg-gray-700 hover:text-white focus:outline-none focus:ring-2 focus:ring-white focus:ring-offset-2 focus:ring-offset-gray-800"
          >
            <span
              class="absolute -top-1 -right-1 inline-flex h-3 w-3 items-center justify-center rounded-full bg-red-500 text-xs font-bold text-white ring-2 ring-white"
              >{{ cart.length }}</span
            >
            <ShoppingCartIcon class="size-6 relative hover:text-white"> </ShoppingCartIcon>
          </button>
          <!-- Profile dropdown -->
          <div class="relative ml-3">
            <div>
              <button
                type="button"
                class="relative flex rounded-full bg-gray-800 text-sm focus:ring-2 focus:ring-white focus:ring-offset-2 focus:ring-offset-gray-800 focus:outline-hidden"
                id="user-menu-button"
                aria-expanded="false"
                aria-haspopup="true"
              >
                <span class="absolute -inset-1.5"></span>
                <span class="sr-only">Open user menu</span>

                <img
                  class="size-8 rounded-full"
                  src="https://images.unsplash.com/photo-1472099645785-5658abf4ff4e?ixlib=rb-1.2.1&ixid=eyJhcHBfaWQiOjEyMDd9&auto=format&fit=facearea&facepad=2&w=256&h=256&q=80"
                  alt=""
                />
              </button>
              <!-- logout button -->
            </div>
          </div>
          <div>
            <button
              type="button"
              @click="handleLogout()"
              class="rounded-md px-3 py-2 text-sm font-medium text-gray-300 hover:bg-gray-700 hover:text-white"
            >
              Logout
            </button>
          </div>
        </div>
      </div>
    </div>
  </nav>
</template>
<script setup>
import { ref, computed, onMounted } from 'vue'
import { useProductStore } from '../stores/product.store'
import { ShoppingCartIcon } from '@heroicons/vue/24/solid'
import { useRouter } from 'vue-router'
import { useAuthStore } from '../stores/auth.store'
import { useOrderStore } from '../stores/order.store'

const productStore = useProductStore()
const orderStore = useOrderStore()
const authStore = useAuthStore()
const cart = ref(productStore.cart)
const categories = computed(() => productStore.categories)
const router = useRouter()

onMounted(async () => {
  await productStore.fetchCategories()
})

async function filterProductsByCategory(category) {
  await productStore.fetchProducts({
    page: productStore.page,
    per_page: productStore.per_page,
    category: category,
  })
}
async function handleLogout() {
  await authStore.logout().then(() => {
    router.push('/login')
  })
}
</script>
