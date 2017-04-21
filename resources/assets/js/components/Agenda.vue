<template>
	<div class="drag">
		<div class="columns is-desktop">
			<div class="column">
				<div class="content">
					
					<h2>New travel</h2>
				</div>
				<div class="form">
					<div class="field">
		             
		                <label class="label">Vehicle</label>
		            
		              
		                  <div class="control is-expanded">
		                  <div class="select is-fullwidth">
		                   <select class="input " style="width: 100%;" id="vehicle" name="vehicle" v-model="travel.vehicle" @change="selectedVehicle">
		                          
		                              <option value="0"></option>
		                              <option :value="item.id" v-for="item in vehicles"> {{ item.name }} ({{ item.maximum_capacity }} PAX)</option>
		                         
		                         
		                   </select>
		                   </div>
		                    
		                    
		                  </div>
		                
		              
		            </div>
		            <div class="field " v-show="travel.vehicle">
		             
		                <label class="label">Reservations</label>
		             
		              		
		                  <div class="control is-expanded " :class="{ active: maxReservation }">
		                  
		                   <draggable v-model="travel.reservations" class="dragArea dragAreatravel" :options="{group:'reservations'}" @end="onEnd">
			   				<reservation :element="element" v-for="element in travel.reservations" :isCompact="1"></reservation>
					      		
					      		<!-- <span v-show="!travel.reservations.length">Drap & drop the reservations</span>
						      	<div class="panel" v-for="element in travel.reservations">
								  <div class="panel-heading">
								     {{ element.customer_name }} <div class="is-pulled-right "><span class="tag is-success">People: {{  getPeople(element) }} </span> <span class="tag is-dark">{{ element.date }} </span>
								     </div>
								  </div>
								</div> -->
						      	
					      </draggable>
					     
					       <span class="tag is-success" v-show="maxReservation && total_people == max_capacity">Maximum capacity reached</span>
					       <span class="tag is-danger" v-show="total_people > max_capacity">Exceeds the maximum capacity</span>
		                    
		                    
		                  </div>
		              
		            </div>
		            <div class="field" v-show="travel.vehicle">
		             
		              
		                  <div class="control">
		                    <button class="button is-primary " @click="save()" :disabled="countReservation < 1 || (maxReservation && total_people > max_capacity)">
		                      Save
		                    </button>
		                    
		                  </div>
		               
		            </div>
				</div>
					
			</div>
			<div class="column">
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
							    <div class="field is-grouped">
							      <div class="control is-expanded has-icon">
							        <input type="text" name="q" class="input" placeholder="By client..." v-model="search" @keyup="onSearch">
							         <span class="icon is-small">
								        <i class="fa fa-search"></i>
								      </span>
							      </div>
							    </div>
							    
							    
							 </div>
				              
				          
				        </div>

					</div>
				</div>

		      <draggable v-model="reservations" class="dragArea" :options="{group:'reservations'}"  >
		     
			   		<reservation :element="element" v-for="element in reservations"></reservation>
				
		      </draggable>
			</div>
		</div>
		<div id="no-more-tables">
		    <table class="table">
			  <thead>
			    <tr>
			      
			      <th>ID</th>
			      <th>Vehicle</th>
			      <th><abbr title="Reservations">Reservations</abbr></th>
			      <th><abbr title="Created At">Created At</abbr></th>
			      <th></th>
			    </tr>
			  </thead>
			  <tbody>
			    <tr v-for="item in travelsData.data">
			      <td data-title="ID"><a href="#" :title=" item.id ">{{ item.id }}</a>
			      </td>
			      <td data-title="Vehicle">
					
					{{ item.vehicles[0].name }}
					
			      </td>
			     
			      <td data-title="Reservations">{{ item.reservations.length }}</td>
			      <td data-title="Created At">{{ item.created_at }}</td>
			      <td>
			      	<a href="#" @click="edit(item)" class="button is-primary is-small">Edit</a>
			      	<a href="#" @click="remove(item)" class="delete"></a>
			      </td>
			      
			    </tr>
			   
			    
			  </tbody>
			</table>
			
			<nav class="pagination-bulma">
				<laravel-pagination :data="travelsData" v-on:pagination-change-page="getTravels"></laravel-pagination >
			</nav>
		</div>
	</div>
</template>
<script>
    import LaravelPagination from 'laravel-vue-pagination'
    import draggable from 'vuedraggable'
    import reservation from './BlockReservation.vue';
	export default {
		components: {
            draggable,
            reservation,
            LaravelPagination
           
        },
        data(){
        	return {
        		reservationsData:{},
        		travelsData:{},
        		reservations:[],
        		travels:[],
        		vehicles:[],
        		travel:{
        			vehicle:0,
        			reservations:[],
        			reservationsDeleted:[]
        			
        		},
        		search:'',
        		total_people:0,
        		max_capacity:0
        		

        	}
        },
      
        computed:{
        	
        	countReservation(){
        		return this.travel.reservations.length;
        		//myArray.find(x => x.id === '45')
        	},
        	
        	maxReservation(){
        		
        		if(this.travel.reservations.length)
        		{
	        		
	        		let people = 0;
	        		
	        	
	        		for (var i = this.travel.reservations.length - 1; i >= 0; i--) {
	        			people += this.travel.reservations[i].adults + this.travel.reservations[i].children
	        		}
	        		
	        		this.total_people = people;

        			return people >= this.max_capacity;
        		}
        		
        		return false;
        		//myArray.find(x => x.id === '45')

        	}
        },
        methods:{
        	onEnd(event){

        		if(this.travel.id)
        			this.travel.reservationsDeleted.push($(event.item).data('id'));
        		
        	},
        	updateAssigned(id,assigned){

        		axios.put('/reservations/'+ id + '/assigned', {assigned: assigned} ).then((response) => {
                    
              
                    
                  }, (response) => {
                              // console.log(response.response.data)
                              this.errors = response.response.data;
                  });
        	},
        	clearForm(){
        		this.travel = {
        			vehicle:0,
        			reservations:[],
        			reservationsDeleted:[]
        		};
        		this.total_people = 0;
        		this.max_capacity = 0;
        	},
        	getPeople(reservation){
        		return reservation.adults + reservation.children 
        	},
        	selectedVehicle(){

        		let vehicle = this.vehicles.find(r => r.id === this.travel.vehicle);
        		
        		this.max_capacity = vehicle.maximum_capacity;
        	
        	},
        
        	save(){
        		 
        		 if(this.travel.id)
              {
                    axios.put('/travels/'+ this.travel.id, this.travel ).then((response) => {
                    
                   
                    
                     //bus.$emit('updateListReservations', response.data);
                     this.getReservations();
                     this.getTravels();

                     bus.$emit('alert', 'Travel Saved','success');
                     
                     for(var res in this.reservationsNoAssigned)
                     {

                     	this.updateAssigned(res, 0)
                     }
                     this.clearForm()
                    
                  }, (response) => {
                              // console.log(response.response.data)
                              this.errors = response.response.data;
                  });


              }else{
        		 axios.post('/travels', this.travel ).then((response) => {
                      
                     
                      
                       this.getReservations();
                       this.getTravels();

                       bus.$emit('alert', 'Travel Saved','success');
                      
                       this.clearForm()
                      
                    }, (response) => {
                     
                                // console.log(response.response.data)
                                this.errors = response.response.data;
                    });
        		}
        	},
        	edit(item) {
			   
	          	//bus.$emit('editReservation', reservation);
	          	this.travel.id = item.id;
	          	this.travel.vehicle = item.vehicles[0].id;
	          	this.max_capacity =   item.vehicles[0].maximum_capacity;
	          	this.travel.reservations = item.reservations;
	          
	        },//edit

	        remove(item){
	           
	        	 axios.delete('/travels/'+item.id).then((response) => {
                	
                	let index = this.travelsData.data.indexOf(item)
	                this.travelsData.data.splice(index, 1);

	                this.getReservations();
	               
	                bus.$emit('alert', 'Travel Deleted','success');
	                // console.log(response);
	                
	                this.clearForm()
	                
	              }, (response) => {
	                          //console.log(response.data)
	                          this.errors = response.response.data;
	              });
	           

	          }, //remove
        	getVehicles(){
        		axios.get('/vehicles/list').then((response) => {
                      
                      this.vehicles = response.data;
                      
                    }, (response) => {
                                console.log(response.data)
                                //this.errors = response;
                    });
        	},
        	onSearch:_.debounce(function(search) {
	           

	         this.getReservations();
					

		    }, 500),

        	getReservations(page) {
				if (typeof page === 'undefined') {
					page = 1;
				}

				// Using vue-resource as an example
				axios.get('/reservations/list?except=-1&assigned=0&q='+ this.search +'&page=' + page).then((response) => {
                      
                     
                      
                      this.reservationsData = response.data;
                      this.reservations = response.data.data;
                      
                    }, (response) => {
                                console.log(response.data)
                                //this.errors = response;
                    });

				
			},

			getTravels(page) {
				if (typeof page === 'undefined') {
					page = 1;
				}

				// Using vue-resource as an example
				axios.get('/travels/list?page=' + page).then((response) => {
                      
                     
                      
                      this.travelsData = response.data;
                      this.travels = response.data.data;
                      
                    }, (response) => {
                                console.log(response.data)
                                //this.errors = response;
                    });

				
			},
        },
        created(){

			this.getReservations();
			this.getTravels();
			this.getVehicles();
        }

	}
</script>