<template>
  <div>
    <!-- filters -->

    <div class="flex items-baseline justify-between border-b border-gray-200 pt-24 pb-6">
      <h1 class="text-4xl font-bold tracking-tight text-white-900">New Arrivals</h1>
    </div>

    <section aria-labelledby="products-heading" class="pt-6 pb-24">
      <div class="grid p-5">
        <div class="lg:col-span-3">
          <div class="grid grid-cols-1 gap-x-8 gap-y-10 lg:grid-cols-4">
            <div
              class="bg-white shadow-md rounded-lg p-4"
              v-for="product in products"
              :key="product.id"
            >
              <ProductSkeleton v-if="productStore.isLoading" />
              <ProductItem v-else :product="product" />
            </div>
          </div>
          <Pagination
            v-if="!productStore.isLoading"
            :currentPage="productStore.page"
            :totalPages="productStore.totalPages"
            :perPage="productStore.per_page"
            @pagechanged="fetchProucts"
          />
        </div>
      </div>
    </section>
  </div>
</template>

<script setup>
import ProductItem from '../components/ProductItem.vue'
import { onMounted, computed } from 'vue'
import { useProductStore } from '../stores/product.store'
import ProductSkeleton from '../components/ProductSkeleton.vue'
import Pagination from '@/components/PaginationItem.vue'

const productStore = useProductStore()
const products = computed(() => productStore.products)

onMounted(async () => {
  await productStore.fetchProducts({
    page: productStore.page,
    per_page: productStore.per_page,
  })
  await productStore.fetchCategories()
})

async function fetchProucts() {
  await productStore.fetchProducts({
    page: productStore.page,
    per_page: productStore.per_page,
  })
}
</script>
