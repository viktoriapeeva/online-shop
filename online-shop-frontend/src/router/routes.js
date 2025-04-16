const routes = [
  {
    path: '/auth',
    children: [
      {
        path: 'login',
        name: 'login',
        component: () => import('../views/LoginView.vue'),
      },
      {
        path: 'register',
        name: 'register',
        component: () => import('../views/RegisterView.vue'),
      },
    ],
  },
  {
    path: '/',
    name: 'home',
    component: () => import('../views/StoreView.vue'),
  },
  {
    path: '/cart',
    name: 'cart',
    component: () => import('../views/CartView.vue'),
  },
  {
    path: '/products/:id',
    name: 'product',
    component: () => import('../views/ProductView.vue'),
  },
  {
    path: '/orders',
    name: 'orders',
    component: () => import('../views/OrdersView.vue'),
  },
  {
    path: '/checkout',
    name: 'checkout',
    component: () => import('../views/CheckoutView.vue'),
  },
]

export default routes
