<template>
	<div>
		<div class="content">
			<h2>Reservations</h2>
		</div>
		<div class="panel filters">
			<div class="panel-heading">
				Search
			</div>
			<div class="panel-block">
				
		        <div class="field is-horizontal" >

	                <div class="field-body">
	                	<div class="field has-addons">
					      <div class="control">
					        <VueFlatpickr :options="fpOptions" v-model="date" @blur="errors.date = []" @change="selectDate" />

          
					         <!--  <span class="icon is-small clear-date" @click="clearDate">
						        <i class="fa fa-calendar"></i>
						      </span>  -->
					      </div>
					       <div class="control">
							    <a class="button is-info" @click="clearDate">
							      X
							    </a>
						  </div>
					    </div>
					    <div class="field is-grouped">
					      <div class="control is-expanded has-icon">
					        <input type="text" name="q" class="input" placeholder="..." v-model="search" @keyup="onSearch">
					         <span class="icon is-small">
						        <i class="fa fa-search"></i>
						      </span>
					      </div>
					    </div>
					    
					    
					 </div>
		              
		          
		        </div>

			</div>
		</div>
	   <div id="no-more-tables">
		   <table class="table">
			  <thead>
			    <tr>
			      
			      <th>Date</th>
			      <th>Type</th>
			      <th><abbr title="Important">Important</abbr></th>
			      <th><abbr title="Client">Client</abbr></th>
			      <th><abbr title="People">People</abbr></th>
			      <th><abbr title="Hidden notes">Hidden notes</abbr></th>
			      <th><abbr title="Notes">Notes</abbr></th>
			      <th></th>
			    </tr>
			  </thead>
			  
			  <tbody>
			    <tr v-for="item in data.data" class="color-reservation" :class="'is-'+getServiceColor(item.service_color)">
			      <td data-title="Date"><a href="#" :title=" item.date ">{{ item.date }}</a>
			      </td>
			      <td data-title="Type">
					
					<span class="tag is-info" v-if="item.type_service == 'One Way'"><i class="fa fa-long-arrow-right"  title="One Way"></i></span>
					<span class="tag is-warning" v-else>
					<i class="fa fa-undo" title="Round Trip"></i></span>
					
			      </td>
			     
			      <td data-title="Important">

			      	
			      	<div v-if="item.status != -1">
			      		<div v-if="item.assigned == 1">
			      			<span class="tag is-success">Assigned</span>
			      		</div>
			      		<div v-else>
			      			<span class="tag is-danger" v-if="item.last_minute == 1">Last minute</span> <span class="tag is-default" v-else>None</span>
			      			
			      		</div>
			      	</div>
			      	<div v-else>
			      		<span class="tag is-warning">Canceled</span>
			      	</div>
			      </td>
			      <td data-title="Client">{{ item.customer_name }}</td>
			      <td data-title="People">{{ parseInt(item.adults) + parseInt(item.children) }}</td>
			      <td data-title="Hidden notes">{{ item.hidden_notes }}</td>
			      <td data-title="Notes">{{ item.notes }}</td>
			      <td>
			      	<a href="#" @click="edit(item)" class="button is-primary is-small" v-show="item.status != -1 && !parseInt(item.assigned)">Edit</a>
			      	<a href="#" @click="cancel(item)" class="button is-warning is-small" v-show="item.status != -1">Cancel</a>
			      	<a href="#" @click="remove(item)" class="delete" v-show="isAdmin"></a>
			      </td>
			      
			    </tr>
			   
			    
			  </tbody>
			</table>
			
			<nav class="pagination-bulma">
				<laravel-pagination :data="data" v-on:pagination-change-page="getResults"></laravel-pagination >
			</nav>
		</div>
	</div>
</template>
<script>

   //import VuePaginator from 'vuejs-paginator'
   import LaravelPagination from 'laravel-vue-pagination'
   import VueFlatpickr from 'vue-flatpickr';
   import 'vue-flatpickr/theme/airbnb.css';
   
 export default {
        props: ['reservations','isAdmin'],
       
        components: {
		    LaravelPagination: LaravelPagination,
		    VueFlatpickr: VueFlatpickr,
		  },
        data () {
	        return {
	 		  data:{},
	 		  search:"",
	 		  date:"",
	          //items:[],
	          loader:false,
	          service_color:['default','info','pink','success','warning','yellow','purple','success'],
	          fpOptions:{
                  //minDate:"today"
                   onChange:this.selectDate,
                   
                },
	         
	          
	        }
	      },
	      
        methods: {
        	clearDate(){
        		this.date = '';
        		this.getResults();
        	},
        	
        	selectDate(){
        		 this.getResults();
        	},
        	getServiceColor(typeService) {
        		return this.service_color[typeService];
        	},
        	 onSearch:_.debounce(function(search) {
	           

	         this.getResults();
					

		    }, 500),

        	getResults(page) {
				if (typeof page === 'undefined') {
					page = 1;
				}
				

				// Using vue-resource as an example
				axios.get('/reservations/list?date='+ this.date +'&q='+ this.search +'&page=' + page).then((response) => {
                      
                      this.data = response.data;
                      
                    }, (response) => {
                                console.log(response.data)
                                //this.errors = response;
                    });

				
			},
	         edit(reservation) {
			  
	          	bus.$emit('editReservation', reservation);
	          
	        },//edit

	        remove(item){
	           
	        	 axios.delete('/reservations/'+item.id).then((response) => {
                	
                	let index = this.data.data.indexOf(item)
	                this.data.data.splice(index, 1);
	               
	                bus.$emit('alert', 'Reservation Deleted','success');
	                // console.log(response);
	                
	                
	              }, (response) => {
	                          //console.log(response.data)
	                          this.errors = response.response.data;
	              });
	           

	          }, //remove

	         cancel(item){

	         	  axios.put('/reservations/'+ item.id + '/cancel', item ).then((response) => {
                    
                   
                    
                     this.getResults();
                    
                     bus.$emit('alert', 'Reservation Canceled','success');
                     
                     
                    
                  }, (response) => {
                              // console.log(response.response.data)
                              this.errors = response.response.data;
                  });
	           
	        	 

	          }, //cancel

          	updateList(reservation){

          		//this.items.push(reservation);
          		this.getResults();
          	}//addToList

       	
        },//methods
        created() {
          
          //this.items = this.reservations;
	      this.getResults();
	      bus.$on('updateListReservations', this.updateList);
	      
	    }
    }
</script>