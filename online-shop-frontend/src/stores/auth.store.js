import { defineStore } from 'pinia'
import AuthService from '../services/auth.service'
import { api } from '@/utils/axios'

export const useAuthStore = defineStore('auth', {
  state() {
    return {
      user: null,
      isLoading: true,
    }
  },
  actions: {
    async login(formData) {
      try {
        this.isLoading = true
        await AuthService.login(formData)
        const user = await AuthService.fetchUser()
        this.user = user
      } catch (error) {
        console.error(error)
        this.user = null
      } finally {
        this.isLoading = false
      }
    },
    async register(formData) {
      try {
        this.isLoading = true
        await AuthService.register(formData)
        const user = await AuthService.fetchUser()
        this.user = user
      } catch (error) {
        console.error(error)
        this.user = null
      } finally {
        this.isLoading = false
      }
    },
    async getUser() {
      try {
        this.isLoading = true
        const user = await AuthService.fetchUser()
        this.user = user
      } catch (error) {
        console.error(error)
        this.user = null
      } finally {
        this.isLoading = false
      }
    },
    async logout() {
      try {
        this.isLoading = true
        await AuthService.logout()
        this.user = null
      } catch (error) {
        console.error(error)
      } finally {
        this.isLoading = false
      }
    },
    async updateUser(formData) {
      try {
        this.isLoading = true
        const userId = this.user.id
        const user = await api.put(`api/user/${userId}`, formData)
        this.user = user
      } catch (error) {
        console.error(error)
        this.user = null
      } finally {
        this.isLoading = false
      }
    },
  },
})
