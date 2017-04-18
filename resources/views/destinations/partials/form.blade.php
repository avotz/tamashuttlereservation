

    <div class="field">
        <label for="name" class="label">Name</label>
        <div class="control has-icon">
          <input id="name" type="text" class="input {{ ($errors->has('name')) ? 'is-danger': '' }}" name="name" value="{{ isset($destination) ? $destination->name : old('name') }}" placeholder="Name"  required autofocus>
          <span class="icon is-small">
            <i class="fa fa-map-marker"></i>
          </span>
            @if ($errors->has('name'))
                <span class="help is-danger">
                    {{ $errors->first('name') }}
                </span>
            @endif
        </div>
       
    </div>

    <div class="field">
      <label for="type" class="label">Type</label>
      <div class="control">
        <label class="radio">
          <input type="radio" name="type" value="1"  {{ (isset($destination)) ? ($destination->type == 1) ? 'checked' : '' : 'checked' }}>
            Location 

        </label>
        <label class="radio">
          <input type="radio" name="type"  value="2" {{ (isset($destination) ) ? ($destination->type == 2) ? 'checked' : '' : '' }}>
            Tour
        </label>
         @if ($errors->has('type'))
                <span class="help is-danger">
                    {{ $errors->first('type') }}
                </span>
            @endif
      </div>
    </div>
    
  
    <div class="field">
        <div class="control">
          <button type="submit" class="button is-success">
              Save
          </button>
          <a href="/destinations" class="button is-danger">Back</a>

        </div>
    </div>
   


