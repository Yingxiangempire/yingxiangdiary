import Home from '../pages/home/index'
import Navigation from '../pages/tools/navigation'
window.Vue = require('vue');
window.VueRouter = require('vue-router');
Vue.use(VueRouter);
const router = new VueRouter({
  mode: 'history',
  base: '/',
  scrollBehavior(to, from, savedPosition) {
    if (savedPosition) { 
      return savedPosition
    } else {
      return {x: 0, y: 0}
    }
  },
  routes: [
    {
      path: '/',
      name: 'home',
      component: Home,
      children:[
        {
          path: 'navigation',
          name: 'navigation',
          component: Navigation
        }
      ]
    }

  ]
})

router.beforeEach((to, from, next) => {
  next()
})

export default router
