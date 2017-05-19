@extends('layouts.app')

@section('content')
  <div class="columns ">
    <div class="column is-half is-offset-one-quarter ">
		<div class="content">

			<h1>Hotel</h1>
			<form method="POST" action="{{ url('/hotels/'.$hotel->id) }}" class="form-horizontal">
		         {{ csrf_field() }}<input name="_method" type="hidden" value="PUT">
		         @include('hotels/partials/form')
		    </form>
		</div>
	</div>
  </div>
	


@endsection