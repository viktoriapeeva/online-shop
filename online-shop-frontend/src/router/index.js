import { createRouter, createWebHistory } from 'vue-router'
import routes from './routes'
import { useAuthStore } from '../stores/auth.store'

const router = createRouter({
  history: createWebHistory(import.meta.env.BASE_URL),
  routes,
})

router.beforeEach(async (to, from, next) => {
  const publicPages = ['/auth/login', '/auth/register']
  const authRequired = !publicPages.includes(to.path)
  const authToken = localStorage.getItem('access_token')

  const authStore = useAuthStore()
  if (authRequired && !authToken) {
    next({ name: 'login' })
  } else if (authToken && !authStore.user) {
    await authStore.getUser()
    next()
  } else {
    next()
  }
})

export default router
