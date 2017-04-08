@extends('layouts.app')
@section('styles')
<!-- <link href="{{ asset('css/vendor/classic.css') }}" rel="stylesheet">
<link href="{{ asset('css/vendor/classic.date.css') }}" rel="stylesheet">
<link href="{{ asset('css/vendor/classic.time.css') }}" rel="stylesheet"> -->
<!-- <link href="{{ asset('css/vendor/bootstrap.min.css') }}" rel="stylesheet"> -->
<!-- <link href="{{ asset('css/vendor/bootstrap-datetimepicker.min.css') }}" rel="stylesheet"> -->

@endsection
@section('content')

	 <div class="columns">
        	<div class="column">

			    <reservations-form></reservations-form>
			</div>
			<div class="column ">
				
				<reservations-list ></reservations-list>
					
				
			   
			</div>
        </div>

    
       

@endsection
@section('scripts')

 <script src="{{ asset('js/vendor/jquery-2.2.3.min.js') }}"></script>
<!--  <script src="{{ asset('js/vendor/picker.js') }}"></script>
 <script src="{{ asset('js/vendor/picker.date.js') }}"></script>
 <script src="{{ asset('js/vendor/picker.time.js') }}"></script> -->
 <!-- <script src="https://cdnjs.cloudflare.com/ajax/libs/moment.js/2.11.2/moment.min.js"></script> -->
 <!-- <script src="{{ asset('js/vendor/bootstrap.min.js') }} "></script> -->
 <!-- <script src="{{ asset('js/vendor/bootstrap-datetimepicker.min.js') }}"></script>  -->
 <script>
 	 (function ($) {

 	 	 /*$('.datepicker').datetimepicker({
            format:'YYYY-MM-DD',
           
            
         });*/
 		/*$('.datepicker').pickadate({
 			format: 'yyyy-mm-dd',
 		});
 		$('.timepicker').pickatime({
 			format: 'H:i',
 			formatSubmit: 'H:i',
 		})*/
 		

 	})(jQuery);
 	 
 </script>
@endsection