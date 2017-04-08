

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
        <div class="control">
          <button type="submit" class="button is-success">
              Save
          </button>
          <a href="/vehicules" class="button is-danger">Back</a>

        </div>
    </div>
   


