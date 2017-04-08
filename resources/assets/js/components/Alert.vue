<template>
  <transition name="fade">
	<div v-bind:class="'has-text-centered notification is-' + type" v-show="show">
	  <button class="delete" v-show="important" @click="show= false"></button>
	 	<slot></slot>
	</div>
  </transition>
	
</template>

<script>
	export default {
		props: {
			type: { default:'info'},
			timeout: { default: 3000},
			important:{
				type: Boolean,
				default: false
			}

		},
		data() {
			return {show: true}
		},
		mounted(){
			if(! this.important){
				setTimeout(
					() => this.show = false,
					this.timeout
				)
			}
		}
	}
</script>