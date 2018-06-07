/**
 * JavaScript dependencies
 */

// window._ = require('lodash');
// window.axios = require('axios');

/**
 * Ajax config
 */

// window.axios.defaults.headers.common = {
// 	'X-CSRF-TOKEN': window.Laravel.csrfToken,
// 	'X-Requested-With': 'XMLHttpRequest'
// };

import Vue from 'vue'

import App from './App.vue'
import router from './router'

import ElementUI from 'element-ui'
import locale from 'element-ui/lib/locale/lang/es'
import '../sass/element-variables.scss'
import 'element-ui/lib/theme-chalk/display.css';

import store from './store'

import NProgress from 'nprogress' // Progress 进度条
import 'nprogress/nprogress.css'// Progress 进度条样式

import fontawesome from '@fortawesome/fontawesome'
// import brands from '@fortawesome/fontawesome-free-brands'
import solid from '@fortawesome/fontawesome-free-solid'

Vue.use(ElementUI, { locale });

fontawesome.library.add(solid)

router.beforeEach((to, from, next) => {
	NProgress.configure({ showSpinner: false })
	NProgress.start()
	// next()

	if (to.matched.some(record => record.meta.requiresAuth)) {
		// this route requires auth, check if logged in
		// if not, redirect to login page
		if (!store.getters.token) {
			next({ 
				name: 'login',
				// query: {redirect: to.fullPath}
			})
		} else {
			next()
		}
	} else if (to.matched.some(record => record.meta.requiresVisitor)) {
	    // this route not requires auth, check if logged in redirect to index page
	    if (store.getters.token) {
	        next({
				path: '/',
				query: {redirect: to.fullPath}
	        })
	    } else {
	        next()
	    }
	} else {
		next()
	}
})


Vue.filter('formatMoney', (value) => {
	return Number(value)
		.toFixed(2)
		.replace(/(\d)(?=(\d{3})+(?!\d))/g, "$1,")
})

const app = new Vue({
	el: '#app',
	// render: h => h(App),
	router,
	store,	
	template: '<App/>',
	components: { App }
})

router.afterEach(() => {
	NProgress.done()
})