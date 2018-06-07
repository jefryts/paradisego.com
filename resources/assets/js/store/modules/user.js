import { get, byMethod } from '../../lib/api';

import axios from 'axios'

const user = {
	state: {
		token: localStorage.getItem('access_token') || null,
		name: '',
		avatar: '',
		roles: [],
		method: 'post'
	},
	mutations: {
		SET_TOKEN: (state, token) => {
			state.token = token
		},
		SET_NAME: (state, name) => {
			state.name = name
		},
		SET_AVATAR: (state, avatar) => {
			state.avatar = avatar
		},
		SET_ROLES: (state, roles) => {
			state.roles = roles
		},
	},
	actions: {
		Login({ commit, state }, credentials) {
			return new Promise((resolve, reject) => {
				byMethod(state.method, '/api/login', credentials)
				.then(response => {
					const token = response.data.access_token

					localStorage.setItem('access_token', token)
					commit('SET_TOKEN', token)
					
					resolve(response)
				}).catch(error => {
					reject(error)
				})
			})
		},
		GetInfo({ commit, state }) {
			return new Promise((resolve, reject) => {
				getInfo(state.token).then(response => {
					const data = response.data
					if (data.roles && data.roles.length > 0) { // 验证返回的roles是否是一个非空数组
						commit('SET_ROLES', data.roles)
					} else {
						reject('getInfo: roles must be a non-null array !')
					}
					commit('SET_NAME', data.name)
					commit('SET_AVATAR', data.avatar)
					resolve(response)
				}).catch(error => {
					reject(error)
				})
			})
		},
		LogOut({commit, state, getters}) {
			axios.defaults.headers.common['Authorization'] = 'Bearer ' + state.token
			if (getters.token) {
				return new Promise((resolve, reject) => {
					byMethod(state.method, '/api/logout')
					.then(response => {
						localStorage.removeItem('access_token')
						commit('SET_TOKEN', null)
						commit('SET_ROLES', [])
						resolve(response)
					})
					.catch(error => {
						localStorage.removeItem('access_token')
						commit('SET_TOKEN', null)
						reject(error)
					})
				})

			}
		},
		FedLogOut(context) {
			return new Promise(resolve => {
				context.commit('SET_TOKEN', '')
				removeToken()
				resolve()
			})
		}
	}
}

export default user