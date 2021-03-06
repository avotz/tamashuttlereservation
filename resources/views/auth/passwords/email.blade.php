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
                    <form class="form-horizontal" role="form" method="POST" action="{{ route('password.email') }}">
                        {{ csrf_field() }}

                        <div class="field">
                            <label for="email" class="label">E-Mail Address</label>

                                <p class="control">
                                    <input id="email" type="email" class="input" name="email" value="{{ old('email') }}" required>
                                 </p>
                                @if ($errors->has('email'))
                                    <span class="help is-warning">
                                        <strong>{{ $errors->first('email') }}</strong>
                                    </span>
                                @endif
                           
                        </div>

                        <div class="field">
                            <p class="control">
                                <button type="submit" class="button is-success">
                                    Send Password Reset Link
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
