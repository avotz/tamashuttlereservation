<template>
 <div class="panel" :data-id=" element.id ">
 <div :class="{ important: parseInt(element.last_minute)  }" class="panel-heading" @click="showInfo = !showInfo">
     <span class="client">{{ element.customer_name }}</span> <div class="is-pulled-right "><span class="tag is-info is-small" v-show="!isCompact"> Total: ${{ getPrice(element) }}</span> <span class="tag is-success">People: {{  getPeople(element) }} </span> <span class="tag is-default" v-if="parseInt(element.last_minute)" v-show="!isCompact">Last minute</span> <span class="tag is-dark">{{ element.date }} </span>
     </div>
  </div>
  <div class="panel-content" v-show="showInfo">
  	  <a class="panel-block">
	    <span class="panel-icon">
	      <i class="fa fa-map-marker"></i>
	    </span>
	    Pick up: {{ element.pickup }}
	  </a>
	  <a class="panel-block">
	    <span class="panel-icon">
	      <i class="fa fa-map-marker"></i>
	    </span>
	      Drop off: {{ element.dropoff }}
	  </a>
	  <a class="panel-block">
	    <span class="panel-icon">
	      <i class="fa fa-users"></i>
	    </span>
	    Total ({{ getPeople(element)}}) =
	    Adults: {{ element.adults }} Children: {{ element.children }} Infants: {{ element.infants }} baby seat: {{ element.baby_seat }} 
	  </a>
	  <a class="panel-block">
	    <span class="panel-icon">
	      <i class="fa fa-usd"></i>
	    </span>
	    Rate x person: ${{ element.rate }}  
	  </a>
	  <a class="panel-block">
	    <span class="panel-icon">
	      <i class="fa fa-long-arrow-right" v-if="element.type_service == 'One Way'"></i>
	      <i class="fa fa-undo" v-else></i>
	    </span>
	     {{ element.type_service }}
	  </a>
	   <a class="panel-block">
	    <span class="panel-icon">
	      <i class="fa fa-thumb-tack"></i>
	    </span>
	     {{ getNameFromService(element.service_color) }} 
	  </a>
	  <a class="panel-block">
	    <span class="panel-icon">
	      <i class="fa fa-check-square-o"></i>
	    </span>
	     {{ getNameFromStatus(element.status) }} 
	  </a>
	  <a class="panel-block">
	    <span class="panel-icon">
	      <i class="fa fa-commenting-o"></i>
	    </span>
	     {{ element.notes }}
	  </a>
  </div>
  </div>
</template>


<script>
	export default {
		 props: ['element','isCompact'],
		 data(){
		 	return{
		 		showInfo:false,
        		status:[
        		'',
        		'Confirmed',
        		'Not Confirmed',
        		'Paid',
        		'Charge',
        		'Not Charge',
        		'CC'
        		],
        		service_colors:[
        		  '',
                  'Tamarindo - Airport',
                  'Private Services',
                  'External tour',
                  'Out of Tamarindo',
                  'Airport - Tamarindo',
                  'Weddings'

                ],
		 	}

		 },
		 methods:{
        	getNameFromStatus(index) {
		    
		      return this.status[index];
		    },
		    getNameFromService(index) {
		    
		      return this.service_colors[index];
		    },
        	getPrice(reservation){
	            let people =parseInt((reservation.adults) ? reservation.adults : 0 ) + parseInt((reservation.children) ? reservation.children : 0);
	            let rate = (reservation.rate) ? reservation.rate : 0;
	            
	            return rate * people;

	          },
        	getPeople(reservation){
        		return  parseInt(reservation.adults) + parseInt(reservation.children);
        	},

		 }


	}
</script>

