import Vue from 'vue'

import App from './App.vue'
import router from './router'

import ElementUI from 'element-ui'
import locale from 'element-ui/lib/locale/lang/es'
import '../sass/element-variables.scss'

import store from './store'

import './icons' // icon

// import bar from './components/progress'

Vue.use(ElementUI, { locale });


// router.beforeEach((to, from, next) => {
// 	bar.start()
// 	next()
// })

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