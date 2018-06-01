<template>
	<div class="app-container">
		<el-row :style="{ marginBottom: '20px' }">
			<el-col :span="24">
				<!-- <el-card class="text-center" shadow="never"> -->
					<div class="place-events text-center">
						<font-awesome-icon icon="map-marker-alt" size="lg"/>
						<template>
							<el-select class="select-ubication" v-model="ciudad" placeholder="Select">
								<el-option
									v-for="item in options"
									:key="item.value"
									:label="item.label"
									:value="item.value">
								</el-option>
							</el-select>
						</template>
					</div>
				<!-- </el-card> -->
			</el-col>
		</el-row>
		<el-row :gutter="20">
			<el-col :span="8" v-for="item in model" :key="item.data" :style="{ marginBottom: '20px' }">
				<el-card shadow="hover">
					<img src="https://i.ytimg.com/vi/mQu_HQ_mkpc/maxresdefault.jpg" class="image">
					<div style="padding: 12px;">
						<div class="title-card">
							<h3 style="margin: 0">{{ item.name }}</h3>
						</div>
						<div class="block text-right">
							<el-rate
								v-model="value2"
								:colors="['#99A9BF', '#F7BA2A', '#FF9900']">
							</el-rate>
						</div>
						<div class="date-info">
							<div class="calendar">
								<span class="month">{{ item.month }}</span>
								<span class="day">{{ item.day }}</span>
							</div>
							<div class="daytime">
								<span class="weekday">{{ item.dayName }}</span>
								<span class="time">{{ item.hour }}</span>
							</div>
						</div>
						<!-- <div class="bottom clearfix">
							<time class="time">{{ item.date }} - {{item.start_time}}</time>
							<time class="time">De: {{item.start_time}} - {{item.end_time}}</time>
						</div> -->
					</div>
				</el-card>
			</el-col>
		</el-row>
	</div>
</template>
<style>
  .app-container {
	padding-right: 10%;
	padding-left: 10%;
  }
  .place-events {
	font-size: 2em;
	margin: 5px 0;
  }
  .select-ubication {
	position: relative;
	top: -5px;
  }
  .el-card {
	border: 1px solid #c5c7cc;
  }
  .el-card__body {
	padding: 0;
  }
  .title-card {
	margin-bottom: 10px;
	overflow: hidden;
	height: 44px;
  }
  .time {
    font-size: 13px;
	color: #090a66;
	font-style: oblique;
  }
  .date-info {
	background-color: #ffffff;
	padding: 0px;
	position: relative;
	overflow: hidden;
	height: 52px;
  }
  .calendar {
	display: block;
	float: left;
	left: 10px;
	top: 10px;
	width: 50px;
	bottom: 10px;
  }
  .month {
    font-size: 10px;
    text-align: center;
    background-color: #090a66;
    color: #e2e3e4;
    text-transform: uppercase;
    display: block;
    border-top-right-radius: 4px;
    border-top-left-radius: 4px;
  }
  .day {
    font-size: 30px;
    font-weight: bold;
    text-align: center;
    display: block;
    background-color: #d7dcf7;
    border-bottom-right-radius: 4px;
    border-bottom-left-radius: 4px;
    line-height: 1;
    padding: 4px 0px;
  }
  .daytime {
    margin-left: 60px;
    padding-top: 16px;
    font-weight: bold;
  }
  .weekday {
    color: #86898e;
    text-transform: uppercase;
  }
  .image {
    width: 100%;
    display: block;
  }

  .clearfix:before,
  .clearfix:after {
      display: table;
      content: "";
  }
  
  .clearfix:after {
      clear: both
  }
</style>
<script>
	import Vue from 'vue'
	import FontAwesomeIcon from '@fortawesome/vue-fontawesome'
	import { get } from '../../lib/api'
	export default {
		data () {
			return {
				model : {
					data: []
				},
				options : [
					{
						value: 'chiclayo',
						label: 'Chiclayo'
					}, 
					{
						value: 'trujillo',
						label: 'Trujillo'
					}, 
					{
						value: 'piura',
						label: 'Piura'
					}
				],
				ciudad: 'chiclayo',
				value2: null
			}
		},
		components: {
			FontAwesomeIcon
		},
		beforeRouteEnter(to, from, next) {
			get('/api/events', to.query)
				.then((res) => {
					next(vm => vm.setData(res))
				})
		},
		beforeRouteUpdate(to, from, next) {
			get('/api/events', to.query)
				.then((res) => {
					this.setData(res)
					next()
				})
		},
		methods: {
			setData(res) {
				Vue.set(this.$data, 'model', res.data.results)

				// this.page = this.model.current_page
				// this.$bar.finish()
			},
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
		}
	}
</script>