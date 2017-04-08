@extends('layouts.app')

@section('content')
  <div class="columns ">
    <div class="column is-half is-offset-one-quarter ">
		<div class="content">

			<h1>Vehicle</h1>
			<form method="POST" action="{{ url('/vehicles') }}" class="form-horizontal">
		         {{ csrf_field() }}
		         @include('vehicles/partials/form')
		    </form>
		</div>
	</div>
  </div>
	


@endsection