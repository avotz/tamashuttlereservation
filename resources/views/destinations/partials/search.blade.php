<div class="panel filters">
	<div class="panel-heading">
		Search
	</div>
	<div class="panel-block">
		<form action="/destinations" method="GET">
          
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
				    
				    
				 </div>
              
               
                   
                  
                  
              
              
          
          
        </div>

         
         
      </form>
	</div>
</div>