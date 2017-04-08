 

    <div class="field">
        <label for="name" class="label">Name</label>
        <div class="control has-icon">
          <input id="name" type="text" class="input {{ ($errors->has('name')) ? 'is-danger': '' }}" name="name" value="{{ isset($vehicle) ? $vehicle->name : old('name') }}" placeholder="Name" required autofocus>
          <span class="icon is-small">
            <i class="fa fa-car"></i>
          </span>
          @if ($errors->has('name'))
                <span class="help is-danger">
                    {{ $errors->first('name') }}
                </span>
            @endif
           
        </div>
       
    </div>
     <div class="field">
        <label for="driver" class="label">Driver</label>
        <div class="control has-icon">
          <input id="driver" type="text" class="input  {{ ($errors->has('driver')) ? 'is-danger': '' }}" name="driver" value="{{ isset($vehicle) ? $vehicle->driver : old('driver') }}" placeholder="Driver's Name" required >
          <span class="icon is-small">
            <i class="fa fa-user"></i>
          </span>
          @if ($errors->has('driver'))
                <span class="help is-danger">
                    {{ $errors->first('driver') }}
                </span>
            @endif
          
        </div>
        
    </div>
    <div class="field">
        <label for="maximum_capacity" class="label">Capacity</label>
        <div class="control has-icon">
          <input id="maximum_capacity" type="number" class="input  {{ ($errors->has('maximum_capacity')) ? 'is-danger': '' }}" name="maximum_capacity" value="{{ isset($vehicle) ? $vehicle->maximum_capacity : old('maximum_capacity') }}" placeholder="Maximum Capacity" required >
          <span class="icon is-small">
            <i class="fa fa-sort-numeric-asc"></i>
          </span>
          @if ($errors->has('maximum_capacity'))
                <span class="help is-danger">
                    {{ $errors->first('maximum_capacity') }}
                </span>
            @endif
          
        </div>
        
    </div>
    
  
    <div class="field">
        <div class="control">
          <button type="submit" class="button is-success">
              Save
          </button>
          <a href="/vehicles" class="button is-danger">Back</a>

        </div>
    </div>
   


