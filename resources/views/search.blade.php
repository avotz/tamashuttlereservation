<div class="panel filters">
	<div class="panel-heading">
		Search 
		<div class="is-pulled-right">
	        <button class="button is-small is-info is-outlined btn-print">Print</button>
	    </div>
	</div>
	<div class="panel-block">
		<form action="/" method="GET">
          
               <div class="field is-horizontal" >
	                <div class="field-body">
					    <div class="field is-grouped">
					      <div class="control is-expanded has-icon">
					        <input type="text" name="date" class="input date" placeholder="By name..." value="{{ isset($search) ? $search['date'] : '' }}">
					         <span class="icon is-small">
						        <i class="fa fa-calendar"></i>
						      </span>
					      </div>
					    </div>
					    <div class="field ">
					      <div class="control is-expanded ">
					      	<div class="select is-fullwidth">
						        <select class="input" style="width: 100%;" id="vehicle" name="vehicle" placeholder="-- Selecciona Tipo --">
	                             <option value="" >Vehicle(Driver)</option>
	                            @foreach($vehicles as $vehicle)
	                                <option value="{{$vehicle->id}}" @if(isset($search['vehicle']) && $search['vehicle'] == $vehicle->id) {{ 'selected' }} @endif > {{ $vehicle->name }}</option>
	                            @endforeach
	                           
	                          </select>
	                      	</div>
					      </div>
					     
					    </div>
					    
					 </div>

        			</div>

         
         
      </form>
      
	</div>
</div>