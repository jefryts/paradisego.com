import Vue from 'vue'

import App from './App.vue'
import router from './router'

import ElementUI from 'element-ui'
import locale from 'element-ui/lib/locale/lang/es'
import '../sass/element-variables.scss'

import store from './store'

import './icons' // icon

import NProgress from 'nprogress' // Progress 进度条
import 'nprogress/nprogress.css'// Progress 进度条样式

Vue.use(ElementUI, { locale });


router.beforeEach((to, from, next) => {
	NProgress.configure({ showSpinner: false })
	NProgress.start()
	next()
})

Vue.filter('formatMoney', (value) => {
	return Number(value)
		.toFixed(2)
		.replace(/(\d)(?=(\d{3})+(?!\d))/g, "$1,")
})

new Vue({
	el: '#app',
	router,
	store,
	template: '<App/>',
	components: { App }
})