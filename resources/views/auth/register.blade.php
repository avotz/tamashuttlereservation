@extends('layouts.app')

@section('content')
  <div class="columns">
    <div class="column is-half is-offset-one-quarter">
       <div class="content">
                <h1>Register</h1>
                
                    <form class="form-horizontal" role="form" method="POST" action="{{ route('register') }}">
                        {{ csrf_field() }}

                        <div class="field">
                            <p class="control has-icon">
                              <input id="name" type="text" class="input" name="name" value="{{ old('name') }}" placeholder="Name" required autofocus>
                              <span class="icon is-small">
                                <i class="fa fa-user"></i>
                              </span>
                               
                            </p>
                            @if ($errors->has('name'))
                                      <span class="help is-danger">
                                          {{ $errors->first('name') }}
                                      </span>
                                  @endif
                        </div>
                         <div class="field">
                            <p class="control has-icon">
                              <input id="email" type="email" class="input" name="email" value="{{ old('email') }}" placeholder="Email" required >
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
                              <input id="password" type="password" class="input" name="password" value="{{ old('password') }}" placeholder="Password" required >
                              <span class="icon is-small">
                                <i class="fa fa-lock"></i>
                              </span>
                              
                            </p>
                             @if ($errors->has('password'))
                                      <span class="help is-danger">
                                          {{ $errors->first('password') }}
                                      </span>
                                  @endif
                        </div>
                        <div class="field">
                            <p class="control has-icon">
                              <input id="password-confirm" type="password" class="input" name="password_confirmation" placeholder="Password Confirmation" value="{{ old('password_confirmation') }}" required >
                              <span class="icon is-small">
                                <i class="fa fa-lock"></i>
                              </span>
                              
                            </p>
                             @if ($errors->has('password_confirmation'))
                                      <span class="help is-danger">
                                          {{ $errors->first('password_confirmation') }}
                                      </span>
                                  @endif
                        </div>
                      
                        <div class="field">
                            <p class="control">
                              <button type="submit" class="button is-success">
                                  Register
                              </button>

                            </p>
                        </div>

                    
                    </form>
                
            </div>
        </div>
    </div>

@endsection
