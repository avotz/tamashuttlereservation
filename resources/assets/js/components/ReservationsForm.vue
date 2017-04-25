<template>
      
      <div class="form">
            <div class="content">
              <h1>New Reservation</h1>
            </div>
             <div class="field is-horizontal">
              <div class="field-label">
                <label class="label">Service</label>
              </div>
              <div class="field-body">
                <div class="field ">
                  <div class="control is-expanded">
                  <div class="select is-fullwidth">
                   <select class="input " style="width: 100%;" id="service_color" name="service_color" v-model="form.service_color" @keydown="errors.service_color = []" @change="loadDestinations()">
                          
                              
                              <option :value="item.value" v-for="item in service_colors"> {{ item.text }}</option>
                         
                         
                   </select>
                   </div>
                    
                    <form-error v-if="errors.service_color" :errors="errors" >
                        {{ errors.service_color[0] }}
                    </form-error>
                  </div>
                </div>
              </div>
            </div>
            <div class="field is-horizontal">
              <div class="field-label is-normal">
                <label class="label">Date</label>
              </div>
              <div class="field-body">
                <div class="field is-grouped">
                  <div class="control is-expanded calendarpicker">
                    <!-- <input class="input datepicker" type="text" placeholder="yyyy-mm-dd"  @blur="updateDateInput($event.target.value)" v-model="form.date" @keydown="errors.date = []"> -->
                    <VueFlatpickr :options="fpOptions" v-model="form.date" @blur="errors.date = []" />

                     <form-error v-if="errors.date" :errors="errors" >
                        {{ errors.date[0] }}
                    </form-error>
                  </div>
                </div>
                <div class="field">
                  <div class="control is-expanded calendarpicker">
                    <!-- <input class="input timepicker" type="text" placeholder="00:00"  @blur="updateTimeInput($event.target.value)" v-model="form.time" @keydown="errors.time = []"> @change="updateTimeInput"-->
                    <vue-timepicker v-model="pickertime" @change="updateTimeInput"></vue-timepicker>
                    <form-error v-if="errors.time" :errors="errors" >
                        {{ errors.time[0] }}
                    </form-error>
                    
                  </div>
                  
                </div>
              </div>
            </div>

    

            <div class="field is-horizontal">
              <div class="field-label is-normal">
                <label class="label">Pickup</label>
              </div>
              <div class="field-body">
              
                <div class="field is-grouped">
                  <div class="control is-expanded">
                    
                      <select-destinations @pickup="onSelectPickup" type="pickup"></select-destinations>
                     <form-error v-if="errors.pickup" :errors="errors" >
                        {{ errors.pickup[0] }}
                    </form-error>
                      
                    
                  </div>
                </div>
       
              </div>
            </div>
           <div class="field is-horizontal">
              <div class="field-label is-normal">
                <label class="label">Pickup number</label>
              </div>
              <div class="field-body is-grouped">
                <div class="field ">
                  <div class="control">
                    
                      <input class="input" type="text" placeholder="Pickup number or N/A"   v-model="form.pickup_number" @keydown="errors.pickup_number = []" >
                    <form-error v-if="errors.pickup_number" :errors="errors" >
                        {{ errors.pickup_number[0] }}
                    </form-error>
                    
                  </div>
                </div>

                <div class="field ">
                  <div class="control">
                    
                      <input class="input" type="text" placeholder="Flight"   v-model="form.flight" @keydown="errors.flight = []" >
                    <form-error v-if="errors.flight" :errors="errors" >
                        {{ errors.flight[0] }}
                    </form-error>
                    
                  </div>
                </div>

              </div>
            </div>
            <div class="field is-horizontal">
              <div class="field-label is-normal">
                <label class="label">Drop off</label>
              </div>
              <div class="field-body">
                <div class="field ">
                  <div class="control">
                    
                      <select-destinations @dropoff="onSelectDropoff" type="dropoff"  @keydown="errors.dropoff = []"></select-destinations>
                      <form-error v-if="errors.dropoff" :errors="errors" >
                        {{ errors.dropoff[0] }}
                    </form-error>
                    
                  </div>
                </div>
              </div>
            </div>
   
            <div class="field is-horizontal">
              <div class="field-label is-normal">
                <label class="label">Persons</label>
              </div>
              <div class="field-body">
                <div class="field is-grouped">
                  <div class="control is-expanded has-icon">
                    <input class="input" type="number" placeholder="Adults" v-model="form.adults" min="0" @keydown="errors.adults = []">
                    <span class="icon is-small">
                      <i class="fa fa-male"></i>
                    </span>
                     <form-error v-if="errors.adults" :errors="errors" >
                        {{ errors.adults[0] }}
                    </form-error>
                  </div>
                </div>
                <div class="field">
                  <div class="control is-expanded has-icon">
                    <input class="input" type="number" placeholder="Children" v-model="form.children" min="0" @keydown="errors.children = []">
                    <span class="icon is-small">
                      <i class="fa fa-child"></i>
                    </span>
                     <form-error v-if="errors.children" :errors="errors" >
                        {{ errors.children[0] }}
                    </form-error>
                  </div>
                  
                </div>
                <div class="field">
                  <div class="control is-expanded has-icon">
                    <input class="input" type="number" placeholder="Infants" v-model="form.infants" min="0" @keydown="errors.infants = []">
                      <span class="icon is-small">
                      <i class="fa fa-smile-o"></i>
                    </span>
                     <form-error v-if="errors.infants" :errors="errors" >
                        {{ errors.infants[0] }}
                    </form-error>
                  </div>
                  
                </div>
                <div class="field">
                  <div class="control is-expanded has-icon">
                    <input class="input" type="number" placeholder="Baby Seat" v-model="form.baby_seat" min="0" @keydown="errors.baby_seat = []">
                     <span class="icon is-small">
                      <i class="fa fa-bus"></i>
                    </span>
                     <form-error v-if="errors.baby_seat" :errors="errors" >
                        {{ errors.baby_seat[0] }}
                    </form-error>
                  </div>
                  
                </div>
              </div>
            </div>

            <div class="field is-horizontal">
              <div class="field-label">
                <label class="label">Type</label>
              </div>
              <div class="field-body">
                <div class="field is-narrow">
                  <div class="control">
                    <label class="radio">
                      <input type="radio" name="type_service" v-model="form.type_service" value="One Way" @keydown="errors.type_service = []">
                        One Way <span class="tag is-info"><i class="fa fa-long-arrow-right" title="One Way"></i></span>
        
                    </label>
                    <label class="radio">
                      <input type="radio" name="type_service" v-model="form.type_service" value="Round Trip" @keydown="errors.type_service = []">
                        Round Trip <span class="tag is-warning"><i class="fa fa-undo" title="Round Trip"></i></span>
                    </label>
                    <form-error v-if="errors.type_service" :errors="errors" >
                        {{ errors.type_service[0] }}
                    </form-error>
                  </div>
                </div>
              </div>
            </div>

             <div class="field is-horizontal">
              <div class="field-label is-normal">
                <label class="label">Client</label>
              </div>
              <div class="field-body">
                <div class="field is-grouped">
                  <div class="control is-expanded">
                    <input class="input" type="text" placeholder="Customer's name" v-model="form.customer_name" @keydown="errors.customer_name = []">
                     <form-error v-if="errors.customer_name" :errors="errors" >
                        {{ errors.customer_name[0] }}
                    </form-error>
                  </div>
                </div>
                <div class="field">
                  <div class="control is-expanded">
                    <input class="input" type="email" placeholder="Customer's email" v-model="form.customer_email" @keydown="errors.customer_email = []">
                     <form-error v-if="errors.customer_email" :errors="errors" >
                        {{ errors.customer_email[0] }}
                    </form-error>
                  </div>
                </div>
               
              </div>
            </div>

             <div class="field is-horizontal">
              <div class="field-label is-normal">
                <label class="label">Phone</label>
              </div>
              <div class="field-body">
                <div class="field is-grouped">
                  <div class="control is-expanded">
                    <input class="input" type="text" placeholder="Customer's phone" v-model="form.customer_phone"  @keydown="errors.customer_phone = []">
                    <form-error v-if="errors.customer_phone" :errors="errors" >
                        {{ errors.customer_phone[0] }}
                    </form-error>
                  </div>
                </div>
               
              </div>
            </div>
           
            <div class="field is-horizontal">
              <div class="field-label is-normal">
                <label class="label">Rate</label>
              </div>
              <div class="field-body">
                <div class="field is-grouped">
                  <div class="control is-expanded has-icon">
                    <input class="input" type="text" placeholder="Rate per Person" v-model="form.rate" @keydown="errors.rate = []">
                     <span class="icon is-small">
                      <i class="fa fa-usd"></i>
                    </span>
                     <form-error v-if="errors.rate" :errors="errors" >
                        {{ errors.rate[0] }}
                    </form-error>
                  </div>
                </div>

                <div class="field is-grouped">
                  <div class="control is-expanded">
                    <span class="tag is-info is-large">Total: ${{ price }}</span>
                     
                  </div>
                </div>
               
              </div>
            </div>
            <div class="field is-horizontal">
              <div class="field-label">
                <label class="label">Status</label>
              </div>
              <div class="field-body">
                <div class="field ">
                  <div class="control is-expanded">
                  <div class="select is-fullwidth">
                   <select class="input " style="width: 100%;" id="status" name="status" v-model="form.status" @keydown="errors.status = []">
                          
                              <option value="0"></option>
                              <option :value="item.value" v-for="item in statuses"> {{ item.text }}</option>
                         
                         
                   </select>
                   </div>
                    
                    <form-error v-if="errors.status" :errors="errors" >
                        {{ errors.status[0] }}
                    </form-error>
                  </div>
                </div>
              </div>
            </div>
            <div class="field is-horizontal">
              <div class="field-label">
                <label class="label">Notes</label>
              </div>
              <div class="field-body">
                <div class="field ">
                  <div class="control is-expanded">
                 
                  <textarea class="textarea" placeholder="Notes" v-model="form.notes"  @keydown="errors.notes = []"></textarea>
                   

                    <form-error v-if="errors.notes" :errors="errors" >
                        {{ errors.notes[0] }}
                    </form-error>
                  </div>
                </div>
              </div>
            </div>
            <div class="field is-horizontal">
              <div class="field-label">
                <label class="label">Hidden Notes</label>
              </div>
              <div class="field-body">
                <div class="field ">
                  <div class="control is-expanded">
                 
                  <textarea class="textarea" placeholder="Hidden notes" v-model="form.hidden_notes"  @keydown="errors.hidden_notes = []"></textarea>
                   

                    <form-error v-if="errors.hidden_notes" :errors="errors" >
                        {{ errors.hidden_notes[0] }}
                    </form-error>
                  </div>
                </div>
              </div>
            </div>

            <div class="field is-horizontal">
              <div class="field-label">
                <label class="label">Last Minute</label>
              </div>
              <div class="field-body">
                <div class="field is-narrow">
                  <div class="control">
                    <label class="checkbox">
                      <input type="checkbox" name="last_minute" v-model="form.last_minute" value="1">
                      (Important)
                    </label>
                    
                    <form-error v-if="errors.last_minute" :errors="errors" >
                        {{ errors.last_minute[0] }}
                    </form-error>
                  </div>
                </div>
              </div>
            </div>
            
            <div class="field is-horizontal">
              <div class="field-label">
                <!-- Left empty for spacing -->
              </div>
              <div class="field-body">
                <div class="field">
                  <div class="control">
                    <button class="button is-primary" @click="save()">
                      Save Reservation
                    </button>
                    <img v-show="loading" src="/img/loading.gif" alt="Loading" />
                    
                  </div>
                </div>
              </div>
            </div>
      </div>
      

</template>

<script>
    import SelectDestinations from './SelectDestinations.vue';
    import FormError from './FormError.vue';
    import VueFlatpickr from 'vue-flatpickr';
    import 'vue-flatpickr/theme/airbnb.css';
    import VueTimepicker from 'vue2-timepicker';

    export default {
        components:{
          SelectDestinations,
          FormError,
          VueFlatpickr,
          VueTimepicker
         
      
        },
        data(){
           return {
              pickertime:{
                  HH:'00',
                  mm:'00'
                },
                form:{
                    
                    date: '',
                    time: '',
                    pickup: '',
                    pickup_number: '',
                    flight:'',
                    dropoff: '',
                    adults: '',
                    children: '',
                    baby_seat: '',
                    infants: '',
                    rate:'',
                    customer_name: '',
                    customer_email: '',
                    customer_phone: '',
                    type_service: 'One Way',
                    last_minute: 0,
                    service_color: '',
                    status: 0,
                    notes: '',
                    hidden_notes: ''
                  },
                  
                  statuses:[
                    {
                      text:'Confirmed',
                      value: 1
                    },
                    {
                      text:'Not Confirmed',
                      value: 2
                    },
                    {
                      text:'Paid',
                      value: 3
                    },
                    {
                      text:'Charge',
                      value: 4
                    },
                    {
                      text:'Not Charge',
                      value: 5
                    },
                    {
                      text:'CC',
                      value: 6
                    }
                  ],
                service_colors:[
                  {
                    text:'Tamarindo - Airport',
                    value: 1
                  },
                  {
                    text:'Private Services',
                    value: 2
                  },
                  {
                    text:'External tour',
                    value: 3
                  },
                  {
                    text:'Out of Tamarindo',
                    value: 4
                  },
                   {
                    text:'Airport - Tamarindo',
                    value: 5
                  },
                  {
                    text:'Weddings',
                    value: 6
                  }

                ],
                fpOptions:{
                  minDate:"today"
                },
                errors:[],
                loading:false

               
              

            }
        },
       
        computed:{
          price(){
            let persons =parseInt((this.form.adults) ? this.form.adults : 0 ) + parseInt((this.form.children) ? this.form.children : 0);
            let rate = (this.form.rate) ? this.form.rate : 0;
            
            return rate * persons;

          },
        },
        methods:{
          clearForm(form){

            /*for(let field in form)
            {

              this.form[field] = '';
            }*/
            this.form = {
                date: '',
                time: '',
                pickup: '',
                pickup_number: '',
                flight:'',
                dropoff: '',
                adults: '',
                children: '',
                baby_seat: '',
                infants: '',
                rate:'',
                customer_name: '',
                customer_email: '',
                customer_phone: '',
                type_service: 'One Way',
                last_minute: 0,
                service_color: '',
                status: 0,
                notes: ''
            };
            this.errors = [];
            this.pickertime = {
                  HH:'00',
                  mm:'00'
                };
            bus.$emit('clearSelect');

          },
          edit(reservation){

         
              
              this.form = reservation
              this.form.adults = parseInt(this.form.adults)
              this.form.children = parseInt(this.form.children)
              this.form.infants = parseInt(this.form.infants)
              this.form.baby_seat = parseInt(this.form.baby_seat)
              this.form.last_minute = parseInt(this.form.last_minute)
              this.form.status = parseInt(this.form.status)
              
              this.pickertime = {
                HH:reservation.time.split(":")[0],
                mm:reservation.time.split(":")[1]
              }
            


          },
         
          updateTimeInput(picker){
      
            this.form.time = picker.data.HH + ':' + picker.data.mm;
            //this.$emit('input')
            
          },
          onSelectPickup(destination){

           
              this.form.pickup = destination;
              this.errors.pickup = [];

          },

           onSelectDropoff(destination){

           
              this.form.dropoff = destination;
              this.errors.dropoff = [];

          },

          loadDestinations(){
            this.form.dropoff = '';
            this.form.pickup = '';
            bus.$emit('clearSelect');

            if(this.form.service_color == 3){

            
               bus.$emit('changeDestinations', 2);

            }else{
               bus.$emit('changeDestinations', 1);
            }
          },

          save(){ 
               this.loading = true;

              if(this.form.id)
              {
                    axios.put('/reservations/'+ this.form.id, this.form ).then((response) => {
                    
                   
                    
                     bus.$emit('updateListReservations', response.data);
                    
                     bus.$emit('alert', 'Reservation Saved','success');
                     
                     this.clearForm();
                     this.loading = false;
                  }, (response) => {
                              // console.log(response.response.data)
                              this.errors = response.response.data;
                              this.loading = false;
                  });


              }else{

                    axios.post('/reservations', this.form ).then((response) => {
                      
                     
                      
                      bus.$emit('updateListReservations', response.data);
                      bus.$emit('alert', 'Reservation Saved','success');
                       //console.log(response);
                       this.clearForm();
                      this.loading = false;
                      
                    }, (response) => {
                     
                                // console.log(response.response.data)
                                this.errors = response.response.data;
                                 this.loading = false;
                    });
            }

          }

        },
        created() {
            console.log('Component created.')

            bus.$on('editReservation', this.edit);
          
            //bus.$on('pickup', this.onSelectPickup);
            //bus.$on('dropoff', this.onSelectDropoff);
        }
    }
</script>
