import { defineStore } from 'pinia'
import { api } from '../utils/axios'

export const useProductStore = defineStore('product', {
  state: () => ({
    products: [],
    product: null,
    categories: [],
    cart: [],
    totalPrice: 0,
    page: 1,
    per_page: 12,
    totalPages: 0,
    isLoading: false,
  }),

  actions: {
    async fetchProducts({ page, per_page, category }) {
      this.isLoading = true
      this.page = page || this.page
      this.per_page = per_page || this.per_page
      try {
        const response = await api.get('api/products', {
          params: {
            page,
            per_page,
            category,
          },
        })
        const data = response.data
        this.totalPages = data.meta.last_page
        this.products = data.data
      } catch (error) {
        console.error('Error fetching products:', error)
        return Promise.reject(error)
      } finally {
        this.isLoading = false
      }
    },
    async fetchProduct(id) {
      this.isLoading = true
      try {
        const response = await api.get(`api/products/${id}`)
        const data = response.data
        this.product = data.data
      } catch (error) {
        console.error('Error fetching product:', error)
      } finally {
        this.isLoading = false
      }
    },
    async fetchCategories() {
      try {
        this.isLoading = true
        const response = await api.get('api/categories')
        const data = response.data
        this.categories = data.data
      } catch (error) {
        console.error('Error fetching categories:', error)
      } finally {
        this.isLoading = false
      }
    },
    addToCart(product) {
      const existingProduct = this.cart.find((item) => item.id === product.id)
      if (existingProduct) {
        existingProduct.quantity += 1
      } else {
        this.cart.push({ ...product, quantity: 1 })
      }
      this.totalPrice += parseFloat(product.price)
    },
    removeFromCart(product) {
      const index = this.cart.findIndex((item) => item.id === product.id)
      if (index !== -1) {
        this.totalPrice -= parseFloat(this.cart[index].price) * this.cart[index].quantity
        this.cart.splice(index, 1)
      }
    },
    clearCart() {
      this.cart = []
      this.totalPrice = 0
    },
  },
})
