<div class="panel filters">
	<div class="panel-heading">
		Search
	</div>
	<div class="panel-block">
		<form action="/users" method="GET">
          
                <div class="field is-horizontal" >
                <div class="field-body">
				    <div class="field is-grouped">
				      <div class="control is-expanded has-icon">
				        <input type="text" name="q" class="input" placeholder="By name..." value="{{ isset($search) ? $search['q'] : '' }}">
				         <span class="icon is-small">
					        <i class="fa fa-search"></i>
					      </span>
				      </div>
				    </div>
				    <div class="field ">
				      <div class="control is-expanded ">
				      	<div class="select is-fullwidth">
					        <select class="input" style="width: 100%;" id="role" name="role" placeholder="-- Selecciona Tipo --">
                             <option value="" >Search by Role</option>
                            @foreach($roles as $role)
                                <option value="{{$role->name}}" @if(isset($search['role']) && $search['role'] == $role->name) {{ 'selected' }} @endif > {{ $role->name }}</option>
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