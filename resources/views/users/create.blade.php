@extends('layouts.app')

@section('content')
  <div class="columns ">
    <div class="column is-half is-offset-one-quarter ">
		<div class="content">

			<h1>User</h1>
			<form method="POST" action="{{ url('/users') }}" class="form-horizontal">
		         {{ csrf_field() }}
		         @include('users/partials/form')
		    </form>
		</div>
	</div>
  </div>
	


@endsection