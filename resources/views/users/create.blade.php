@extends('layouts.app')
@section('styles')

<link href="{{ asset('css/vendor/select2.min.css') }}" rel="stylesheet">


@endsection
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
@section('scripts')

 <script src="{{ asset('js/vendor/jquery-2.2.3.min.js') }}"></script>
 <script src="{{ asset('js/vendor/select2.min.js') }}"></script>
 
 <script>
 	 (function ($) {

 	 	$('.select2').select2();
            
        
 		
 	})(jQuery);
 	 
 </script>
@endsection