import Vue from 'vue'
import VueRouter from 'vue-router'

Vue.use(VueRouter)

const router = new VueRouter({
	routes: [
		{ path: '/', redirect: '/events' },
		{ path: '/events', component: require('../views/events/index.vue') }
		// { path: '/invoices/create', component: require('../views/invoices/form.vue') },
		// { path: '/invoices/:id/edit', component: require('../views/invoices/form.vue'), meta: { mode: 'edit' } },
		// { path: '/invoices/:id', component: require('../views/invoices/show.vue') }
	]
})

export default router