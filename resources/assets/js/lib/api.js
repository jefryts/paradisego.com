import axios from 'axios'

// axios.defaults.baseURL = '/api/'

export function get(url, params) {
	return axios({
		method: 'GET',
		url: url,
		params: params
	})
}

export function byMethod(method, url, data = null) {
	if (data) {
		return axios({
			method: method,
			url: url,
			data: data
		})
	}
	return axios({
	    method: method,
	    url: url,
	})
}