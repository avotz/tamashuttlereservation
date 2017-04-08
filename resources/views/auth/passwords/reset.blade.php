@extends('layouts.app')

@section('content')
<div class="columns ">
    <div class="column is-half is-offset-one-quarter">
        <div class="content">
            <div class="panel panel-default">
                <div class="panel-heading">Reset Password</div>

               
                     @if (session('status'))
                    <div class="panel-block">
                        <p class="help is-success">
                            {{ session('status') }}
                        </p>
                    </div>
                    @endif
                    <div class="panel-block">
                    <form class="form-horizontal" role="form" method="POST" action="{{ route('password.request') }}">
                        {{ csrf_field() }}

                        <input type="hidden" name="token" value="{{ $token }}">

                        <div class="field">
                            <label for="email" class="label">E-Mail Address</label>

                            <p class="control">
                                <input id="email" type="email" class="input" name="email" value="{{ $email or old('email') }}" required autofocus>

                            </p>
                             @if ($errors->has('email'))
                                    <span class="help is-warning">
                                        <strong>{{ $errors->first('email') }}</strong>
                                    </span>
                                @endif
                           
                        </div>

                        <div class="field">
                            <label for="password" class="label">Password</label>

                            <p class="control">
                                <input id="password" type="password" class="input" name="password" required>

                            </p>

                                @if ($errors->has('password'))
                                    <span class="help is-warning">
                                        <strong>{{ $errors->first('password') }}</strong>
                                    </span>
                                @endif
                        </div>

                        <div class="field">
                            <label for="password-confirm" class="label">Confirm Password</label>
                             <p class="control">
                                <input id="password-confirm" type="password" class="input" name="password_confirmation" required>
                             </p>

                                @if ($errors->has('password_confirmation'))
                                    <span class="help is-warning">
                                        <strong>{{ $errors->first('password_confirmation') }}</strong>
                                    </span>
                                @endif
                           
                        </div>

                       <div class="field">
                            <p class="control">
                                <button type="submit" class="button is-success">
                                    Reset Password
                                </button>
                            </p>
                            
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
