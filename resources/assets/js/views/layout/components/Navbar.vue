<template>
  <el-menu class="navbar" mode="horizontal">
    <hamburger class="hamburger-container" :toggleClick="toggleSideBar" :isActive="sidebar.opened"></hamburger>
    <breadcrumb class="hidden-sm-and-down"></breadcrumb>
	<div class="search-container hidden-xs-only" v-if="true">
		<el-input
			class="search-navbar"
			placeholder="Busca un evento!"
			size="small">
			<el-button slot="append" icon="el-icon-search"></el-button>
		</el-input>
	</div>
	<div class="access-container">
		<el-button-group v-if="!loggedIn">
			<router-link to="/login" class="el-button el-button--default el-button--small is-plain">Iniciar Sesión</router-link>
			<router-link to="/registro" class="el-button el-button--success el-button--small is-plain">Regístrate</router-link>
		</el-button-group>
	</div>
    <el-dropdown v-if="loggedIn" class="avatar-container" trigger="click">
      <div class="avatar-wrapper">
        <img class="user-avatar" src="https://wpimg.wallstcn.com/f778738c-e4f8-4870-b634-56703b4acafe.gif?imageView2/1/w/80/h/80">
        <i class="el-icon-caret-bottom"></i>
      </div>
      <el-dropdown-menu class="user-dropdown" slot="dropdown">
        <router-link class="inlineBlock" to="/">
          <el-dropdown-item>
            Home
          </el-dropdown-item>
        </router-link>
        <el-dropdown-item divided>
		  <router-link to="/logout">Logout</router-link>
        </el-dropdown-item>
      </el-dropdown-menu>
    </el-dropdown>
  </el-menu>
</template>
<style>
  .search-container {
	position: absolute;
	display: inline-block;
	height: 50px;
	line-height: 50px;
	margin-left: 65px;
  }
  .access-container {
	position: relative;
	float: right;
	right: 120px;
  }
  .search-navbar {
	position: relative;
	top: -3px;
  }
  .search-navbar .el-input__inner{
	width: 250px;
	min-width: 170px;
  }
  .search-navbar .el-input-group__append {
	padding: 0px;
  }
  .search-navbar .el-button{
	padding: 8px;
	margin: 0;
  }
  .access-container .el-button-group{
	position: relative;
	top: -2px;
  }
</style>

<script>
import { mapGetters } from 'vuex'
import Breadcrumb from '../../../components/Breadcrumb'
import Hamburger from '../../../components/Hamburger'
export default {
  components: {
    Breadcrumb,
    Hamburger
  },
  computed: {
    ...mapGetters([
      'sidebar',
	]),
	loggedIn(){
		return this.$store.getters.token
	}
  },
  methods: {
    toggleSideBar() {
      this.$store.dispatch('ToggleSideBar')
    },
    // logout() {
    //   this.$store.dispatch('LogOut').then(() => {
    //     location.reload() // Para volver a crear la instancia de vue-router y evitar el bug
    //   })
    // }
  }
}
</script>