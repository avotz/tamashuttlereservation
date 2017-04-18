<template>
  <div class="is-fullwidth">
	  <v-select :debounce="250"
				:on-search="getOptions"
				:options="options"
				:value.sync="selectedValue" 
				:on-change="select"
				placeholder="Search Destinations..."
				label="name"></v-select>
  </div>
</template>


<script>
    import vSelect from 'vue-select'
	export default {
		 props: ['destination','type'],
		 components:{
	          vSelect
	     },
		 data(){
		 	return{
		 		options: [],
		 		tour_location: 1,
		 		selectedValue: null
		 	}
		 },
		  methods: {
	        getOptions:_.debounce(function(search,loading) {
	           loading(true)

	        
				      axios.get('/destinations/list',{
					    params: {
					      q: search,
					      type:(this.type == 'dropoff') ? this.tour_location : 1
					    }
					  }).then(response => {

					  	this.options = response.data
						loading(false)
					  });
					

		    }, 500) /*(search, loading) {
         
	          loading(true)
	         
	          axios.get('/destinations/list',{
			    params: {
			      q: search
			    }
			  }).then(response => this.options = response.data);
	        *
	        }*/
	        
	       ,
	       select(item) {
  
	          if(item){
	          	
	            this.selectedValue = item;
	            
	            if(this.type == 'pickup')
	                this.$emit('pickup', this.selectedValue);
	          
	             if(this.type == 'dropoff')
	                this.$emit('dropoff', this.selectedValue);
	            
	          }

	          
	        
	         },
	        selected(item) {
  
	          if(item){
	           

		          if(this.type == 'pickup'){
		          	    this.selectedValue = item.pickup;
		         
		          	this.$emit('pickup', item.pickup);
		             
		           }
		          if(this.type == 'dropoff'){
		                 this.selectedValue = item.dropoff;
		             this.$emit('dropoff', item.dropoff);
		         }
	          }
	        
	         },
	         onChangeDestinations(type){
	         	this.tour_location = type;
	         },
	         clear(){
	         	
	         	this.selectedValue = null;
	         	if(this.type == 'dropoff')
	         		this.options = [];
	         }
       	
        },//methods

         created() {
		 			
		 			
		 			
					bus.$on('editReservation', this.selected);
					bus.$on('changeDestinations', this.onChangeDestinations);
					bus.$on('clearSelect', this.clear);
		  },
		 

	}
</script>

