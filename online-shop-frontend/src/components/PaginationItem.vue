<template>
  <div>
    <div class="flex items-center justify-center mt-4">
      <ul class="flex space-x-2">
        <li
          class="px-2 py-1 bg-gray-700 rounded hover:bg-gray-600 cursor-pointer active:bg-gray-800"
          @click="prevPage"
          :class="{ 'cursor-not-allowed': currentPage === 1 }"
        >
          <ArrowLeftIcon class="h-5 w-5 text-white" />
        </li>
        <li
          v-for="page in totalPages"
          :key="page"
          class="px-2 py-1 bg-gray-700 rounded hover:bg-gray-600 cursor-pointer active:bg-gray-800"
          :class="{ 'bg-gray-800': page === currentPage }"
          @click="goToPage(page)"
        >
          {{ page }}
        </li>
        <li
          class="px-2 py-1 bg-gray-700 rounded hover:bg-gray-600 cursor-pointer active:bg-gray-800"
          @click="nextPage"
          :class="{ 'cursor-not-allowed': currentPage === totalPages }"
        >
          <ArrowRightIcon class="h-5 w-5 text-white" />
        </li>
      </ul>
    </div>
  </div>
</template>
<script setup>
import { onMounted, ref } from 'vue'
import { defineProps, defineEmits } from 'vue'
import { useProductStore } from '../stores/product.store'
import { ArrowLeftIcon, ArrowRightIcon } from '@heroicons/vue/20/solid'
const productStore = useProductStore()
const emit = defineEmits(['pagechanged'])
const props = defineProps({
  currentPage: {
    type: Number,
    required: true,
    default: 1,
  },
  totalPages: {
    type: Number,
    required: true,
  },
  perPage: {
    type: Number,
    required: true,
  },
})

const currentPage = ref(props.currentPage)
const totalPages = ref(props.totalPages)

onMounted(() => {})
function prevPage() {
  productStore.page = currentPage.value - 1
  currentPage.value = productStore.page
  emit('pagechanged')
}
function goToPage(page) {
  currentPage.value = page
  productStore.page = page
  emit('pagechanged', page)
}
function nextPage() {
  productStore.page = currentPage.value + 1
  currentPage.value = productStore.page
  emit('pagechanged')
}
</script>
