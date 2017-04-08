 

      @if (isset($user))
          <input id="user_id" type="hidden" name="user_id" value="{{ $user->id }}">
      @endif
    <div class="field">
        <label for="name" class="label">Name</label>
        <div class="control has-icon">
          <input id="name" type="text" class="input {{ ($errors->has('name')) ? 'is-danger': '' }}" name="name" value="{{ isset($user) ? $user->name : old('name') }}" placeholder="Name" required autofocus>
          <span class="icon is-small">
            <i class="fa fa-user"></i>
          </span>
           
        </div>
       
    </div>
     <div class="field">
        <label for="email" class="label">Email</label>
        <div class="control has-icon">
          <input id="email" type="email" class="input  {{ ($errors->has('email')) ? 'is-danger': '' }}" name="email" value="{{ isset($user) ? $user->email : old('email') }}" placeholder="Email" required >
          <span class="icon is-small">
            <i class="fa fa-envelope"></i>
          </span>
          
        </div>
        
    </div>
    <div class="field ">
      <label for="role" class="label">Role</label>
      <div class="control is-expanded ">
        <div class="select is-fullwidth">
            <select class="input select2" style="width: 100%;" id="role" name="role[]" required multiple>
                    
                    @foreach($roles as $role)
                        <option value="{{$role->id}}" @if(isset($user) && $user->hasRole($role->name)) {{ 'selected' }} @endif > {{ $role->name }}</option>
                    @endforeach
                   
            </select>
        </div>
      </div>
     
    </div>
    <div class="field">
        <label for="password" class="label">Password</label>
        <div class="control has-icon">
          <input id="password" type="password" class="input {{ ($errors->has('password')) ? 'is-danger': '' }}" name="password" value="{{ old('password') }}" placeholder="Password" >
          <span class="icon is-small">
            <i class="fa fa-lock"></i>
          </span>
          
        </div>
        
    </div>
    <div class="field">
        <label for="password_confirmation" class="label">Password Confirmation</label>
        <div class="control has-icon">
          <input id="password-confirm" type="password" class="input {{ ($errors->has('password')) ? 'is-danger': '' }}" name="password_confirmation" placeholder="Password Confirmation" value="{{ old('password_confirmation') }}" >
          <span class="icon is-small">
            <i class="fa fa-lock"></i>
          </span>
          
        </div>
        
    </div>
  
    <div class="field">
        <div class="control">
          <button type="submit" class="button is-success">
              Save
          </button>
          <a href="/users" class="button is-danger">Back</a>

        </div>
    </div>
    @if (count($errors) > 0)
        <div class="alert alert-danger">
            <ul>
                @foreach ($errors->all() as $error)
                    <li>{{ $error }}</li>
                @endforeach
            </ul>
        </div>
    @endif


