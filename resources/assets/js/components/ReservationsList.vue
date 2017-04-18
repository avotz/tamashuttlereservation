<template>
	<div>
		<div class="content">
			<h2>Reservations</h2>
		</div>
		
	   <table class="table">
		  <thead>
		    <tr>
		      
		      <th>Date</th>
		      <th>Type</th>
		      <th><abbr title="Important">Important</abbr></th>
		      <th><abbr title="Client">Client</abbr></th>
		      <th><abbr title="Persons">Persons</abbr></th>
		      <th></th>
		    </tr>
		  </thead>
		  <tfoot>
		    <tr>
		      <th>Date</th>
		      <th>Type</th>
		      <th><abbr title="Important">Important</abbr></th>
		      <th><abbr title="Client">Client</abbr></th>
		      <th><abbr title="Persons">Persons</abbr></th>
		      <th></th>
		    </tr>
		  </tfoot>
		  <tbody>
		    <tr v-for="item in data.data">
		      <td><a href="#" :title=" item.date ">{{ item.date }}</a>
		      </td>
		      <th>
				
				<span class="tag is-info" v-if="item.type_service == 'One Way'"><i class="fa fa-long-arrow-right"  title="One Way"></i></span>
				<span class="tag is-warning" v-else>
				<i class="fa fa-undo" title="Round Trip"></i></span>
				
		      </th>
		     
		      <td><span class="tag is-danger" v-if="item.last_minute">Last minute</span></td>
		      <td>{{ item.customer_name }}</td>
		      <td>{{ item.adults + item.children + item.infants }}</td>
		      <td>
		      	<a href="#" @click="edit(item)" class="button is-primary is-small">Edit</a>
		      	<a href="#" @click="remove(item)" class="delete" v-show="isAdmin"></a>
		      </td>
		      
		    </tr>
		   
		    
		  </tbody>
		</table>
		
		<nav class="pagination-bulma">
			<laravel-pagination :data="data" v-on:pagination-change-page="getResults"></laravel-pagination >
		</nav>
	</div>
</template>
<script>

   //import VuePaginator from 'vuejs-paginator'
   import LaravelPagination from 'laravel-vue-pagination'
   
 export default {
        props: ['reservations','isAdmin'],
       
        components: {
		    LaravelPagination: LaravelPagination
		  },
        data () {
	        return {
	 		  data:{},
	          //items:[],
	          loader:false,
	         
	          
	        }
	      },
	      
        methods: {
        	 getResults(page) {
				if (typeof page === 'undefined') {
					page = 1;
				}

				// Using vue-resource as an example
				axios.get('/reservations/list?page=' + page).then((response) => {
                      
                     
                      
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