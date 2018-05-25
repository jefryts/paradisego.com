<template>
	<div class="app-container">
		<div>HOLA</div>
		<el-button>Default</el-button>
	</div>
</template>
<script>
	import Vue from 'vue'
	// import { get } from '../../lib/api'
	export default {
		data () {
			return {
				model : {
					data: []
				}
			}
		},
	// 	beforeRouteEnter(to, from, next) {
	// 		get('/api/invoices', to.query)
	// 			.then((res) => {
	// 				next(vm => vm.setData(res))
	// 			})
	// 	},
	// 	beforeRouteUpdate(to, from, next) {
	// 		get('/api/invoices', to.query)
	// 			.then((res) => {
	// 				this.setData(res)
	// 				next()
	// 			})
	// 	},
	// 	methods: {
	// 		setData(res) {
	// 			Vue.set(this.$data, 'model', res.data.results)
	// 			this.page = this.model.current_page
	// 			this.$bar.finish()
	// 		},
	// 		nextPage() {
	// 			if(this.model.next_page_url) {
	// 				const query = Object.assign({}, this.$route.query)
	// 				query.page = query.page ? (Number(query.page) + 1) : 2

	// 				this.$router.push({
	// 					path: '/invoices',
	// 					query: query
	// 				})
	// 			}
	// 		},
	// 		prevPage() {
	// 			if(this.model.prev_page_url) {
	// 				const query = Object.assign({}, this.$route.query)
	// 				query.page = query.page ? (Number(query.page) - 1) : 1

	// 				this.$router.push({
	// 					path: '/invoices',
	// 					query: query
	// 				})
	// 			}
	// 		},
	// 		detailsPage(item) {
	// 			this.$router.push(`/invoices/${item.id}`)
	// 		}
	// 	}
	}
</script>