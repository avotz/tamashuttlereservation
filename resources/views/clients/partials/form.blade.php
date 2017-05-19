

    <div class="field">
        <label for="name" class="label">Name</label>
        <div class="control has-icon">
          <input id="name" type="text" class="input {{ ($errors->has('name')) ? 'is-danger': '' }}" name="name" value="{{ isset($client) ? $client->name : old('name') }}" placeholder="Name"  required autofocus>
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
        <label for="email" class="label">Email</label>
        <div class="control has-icon">
          <input id="email" type="text" class="input {{ ($errors->has('email')) ? 'is-danger': '' }}" name="email" value="{{ isset($client) ? $client->email : old('email') }}" placeholder="Email"  required autofocus>
          <span class="icon is-small">
            <i class="fa fa-map-marker"></i>
          </span>
            @if ($errors->has('email'))
                <span class="help is-danger">
                    {{ $errors->first('email') }}
                </span>
            @endif
        </div>
       
    </div>
    <div class="field">
        <label for="phone" class="label">Phone</label>
        <div class="control has-icon">
          <input id="phone" type="text" class="input {{ ($errors->has('phone')) ? 'is-danger': '' }}" name="phone" value="{{ isset($client) ? $client->phone : old('phone') }}" placeholder="Phone"  required autofocus>
          <span class="icon is-small">
            <i class="fa fa-map-marker"></i>
          </span>
            @if ($errors->has('phone'))
                <span class="help is-danger">
                    {{ $errors->first('phone') }}
                </span>
            @endif
        </div>
       
    </div>
    
    <div class="field">
        <label for="pickup" class="label">Pickup</label>
         <div class="control is-expanded ">
          <div class="is-fullwidth">
            <select class="input select2" style="width: 100%;" id="pickup" name="pickup">
               <option value=""></option>
              @foreach($destinations as $destination)
                  <option value="{{$destination->name}}" @if(isset($client) && $client->pickup == $destination->name) {{ 'selected' }} @endif > {{ $destination->name }}</option>
              @endforeach
             
            </select>
             @if ($errors->has('pickup'))
                <span class="help is-danger">
                    {{ $errors->first('pickup') }}
                </span>
            @endif
          </div>
        </div>
       
    </div>
    
  
    <div class="field">
        <div class="control">
          <button type="submit" class="button is-success">
              Save
          </button>
          <a href="/clients" class="button is-danger">Back</a>

        </div>
    </div>
   


