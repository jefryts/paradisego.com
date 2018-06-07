<template>
	
</template>
<script>
export default {
	created(){
		this.$store.dispatch('LogOut')
		.then(() => {
			this.$router.push({ path: '/' })
		})
	}
}
</script>

