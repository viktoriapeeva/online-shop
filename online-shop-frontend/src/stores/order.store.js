import { defineStore } from 'pinia'
import { api } from '../utils/axios'

export const useOrderStore = defineStore('order', {
  state: () => ({
    orders: [],
    pendingOrder: {
      user_id: null,
      status: null,
      total_price: null,
      order_items: [],
    },
    isLoading: false,
  }),

  actions: {
    async fetchOrders() {
      try {
        this.isLoading = true
        const response = await api.get('api/orders')
        const data = response.data
        this.orders = data.data
      } catch (error) {
        console.error('Error fetching orders:', error)
      } finally {
        this.isLoading = false
      }
    },
    async fetchOrder(id) {
      try {
        this.isLoading = true
        const response = await api.get(`api/orders/${id}`)
        const data = response.data
        return data.data
      } catch (error) {
        console.error('Error fetching order:', error)
      } finally {
        this.isLoading = false
      }
    },
    async createOrder(order) {
      try {
        this.isLoading = true
        // make sure that products is just an array ith nnumbers
        if (Array.isArray(order.products)) {
          order.products = order.products.map((product) => product.id)
        } else {
          order.products = [order.products]
        }

        const response = await api.post('api/orders', order)
        const data = response.data
        this.orders.push(data.data)
      } catch (error) {
        console.error('Error creating order:', error)
      } finally {
        this.isLoading = false
      }
    },
    async deleteOrder(id) {
      try {
        this.isLoading = true
        await api.delete(`api/orders/${id}`)
        this.orders = this.orders.filter((order) => order.id !== id)
      } catch (error) {
        console.error('Error deleting order:', error)
      } finally {
        this.isLoading = false
      }
    },
  },
})
