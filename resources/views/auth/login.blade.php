@extends('layouts.app')

@section('content')
  <div class="columns ">
    <div class="column is-half is-offset-one-quarter ">
       <div class="content">
           <h1>Login</h1>
           <form class="form-horizontal" role="form" method="POST" action="{{ route('login') }}">
              {{ csrf_field() }}

              <div class="field">
                <p class="control has-icon">
                  <input id="email" class="input " type="email" name="email" placeholder="Email" value="{{ old('email') }}" required autofocus>
                  <span class="icon is-small">
                    <i class="fa fa-envelope"></i>
                  </span>
                   
                </p>
                @if ($errors->has('email'))
                          <span class="help is-danger">
                              {{ $errors->first('email') }}
                          </span>
                      @endif
              </div>
              <div class="field">
                <p class="control has-icon">
                  <input id="password" class="input" type="password" name="password" placeholder="Password" required>
                 
                  <span class="icon is-small">
                    <i class="fa fa-lock"></i>
                  </span>
                  
                </p>
                @if ($errors->has('email'))
                          <span class="help is-danger">
                              {{ $errors->first('email') }}
                          </span>
                      @endif
              </div>
              <div class="field">
                <p class="control">
                  <label class="checkbox ">
                    <input type="checkbox" name="remember" {{ old('remember') ? 'checked' : '' }}>
                    Remember me
                  </label>
                </p>
              </div>
              <div class="field">
                <p class="control">
                  <button type="submit" class="button is-success">
                      Login
                  </button>

                  <a class="button is-link" href="{{ route('password.request') }}">
                      Forgot Your Password?
                  </a>
                </p>
              </div>

          </form>
             
      </div>
       
                    
    </div>
  </div>

       
               
@endsection
