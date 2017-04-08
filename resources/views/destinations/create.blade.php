@extends('layouts.app')

@section('content')
  <div class="columns ">
    <div class="column is-half is-offset-one-quarter ">
		<div class="content">

			<h1>Destination</h1>
			<form method="POST" action="{{ url('/destinations') }}" class="form-horizontal">
		         {{ csrf_field() }}
		         @include('destinations/partials/form')
		    </form>
		</div>
	</div>
  </div>
	


@endsection