/**
 * First we will load all of this project's JavaScript dependencies which
 * includes Vue and other libraries. It is a great starting point when
 * building robust, powerful web applications using Vue and Laravel.
 */
require('jquery');
require('./bootstrap');
window.Vue = require('vue');
window.VueRouter = require('vue-router');
Vue.use(VueRouter);

import router from './router/index'
import store from './store/index'
import App from './main'
import ElementUI from 'element-ui';
import 'element-ui/lib/theme-chalk/index.css';
import './assets/iconfont.css'
import './assets/styles/main.scss'
Vue.use(ElementUI);

/**
 * Next, we will create a fresh Vue application instance and attach it to
 * the page. Then, you may begin adding components to this application
 * or customize the JavaScript scaffolding to fit your unique needs.
 */

Vue.config.productionTip = false
// 4. 创建和挂载根实例。
// 记得要通过 router 配置参数注入路由，
// 从而让整个应用都有路由功能
new Vue({
        el: '#app',
        store,
        router,
        render: h => h(App)
})
