<template>
	<div class="app-container">
		<div class="block hidden-xs-only">
			<el-carousel trigger="click" height="150px">
				<el-carousel-item v-for="item in 4" :key="item">
					<h3>{{ item }}</h3>
				</el-carousel-item>
			</el-carousel>
		</div>
		<el-row :style="{ margin: '20px 0px' }">
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
			<el-col :xs="24" :sm="12" :md="8" v-for="item in model" :key="item.data" :style="{ marginBottom: '20px' }">
				<el-card shadow="hover">
					<img src="https://i.ytimg.com/vi/mQu_HQ_mkpc/maxresdefault.jpg" class="image">
					<div style="padding: 12px;">
						<div class="title-card">
							<h3 style="margin: 0">{{ item.name }}</h3>
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
				<div class="block rate-container">
					<span>Valoración: </span> 
					<el-rate class="rate"
						v-model="value2"
						:colors="['#99A9BF', '#F7BA2A', '#FF9900']">
					</el-rate>
				</div>
			</el-col>
		</el-row>
	</div>
</template>
<style>
  .app-container {
	padding-right: 50px;
	padding-left: 50px;
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
  .rate-container{
	margin: 5px;
  }
  .rate-container .rate{
	float: right;
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
  .el-carousel__item h3 {
	text-align: center;
    color: #475669;
    font-size: 14px;
    opacity: 0.75;
    line-height: 150px;
    margin: 0;
  }

  .el-carousel__item:nth-child(2n) {
    background-color: #99a9bf;
  }

  .el-carousel__item:nth-child(2n+1) {
    background-color: #d3dce6;
  }
  @media only screen and (max-width: 600px) {
    .app-container {
	  padding-right: 10px;
	  padding-left: 10px;
	}
  }
  @media (min-width: 600px) and (max-width: 728px) {
	.app-container {
	  padding-right: 20px;
	  padding-left: 20px;
	}
  }
  @media (min-width: 728px) and (max-width: 992px) {
	.app-container {
	  padding-right: 35px;
	  padding-left: 35px;
	} 
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