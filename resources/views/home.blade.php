@extends('layouts.app')
@section('styles')
<link rel="stylesheet" href="https://unpkg.com/flatpickr/dist/flatpickr.min.css">
<link rel="stylesheet" href="{{ asset('css/vendor/tooltipster.bundle.min.css') }}">
@endsection
@section('content')
<div class="content">
    
       <div class="content">
					<h1>Travels</h1>
					
				@include('search')
				<div id="no-more-tables"> 
				   <table class="table">
					  <thead>
					    
					    <tr>
					      <th><abbr title="Vehicle">Vehicle</abbr></th>
					      <th><abbr title="Date">Date</abbr></th>
					      <th><abbr title="From">From</abbr></th>
					      <th><abbr title="To">To</abbr></th>
					      <th><abbr title="Flight">Flight</abbr></th>
						  <th><abbr title="Name">Name</abbr></th>
						  <th><abbr title="PAX">PAX</abbr></th>
						  <th><abbr title="Rate">Rate</abbr></th>
						  <th><abbr title="$">$</abbr></th>
						  <th><abbr title="Status">Status</abbr></th>
						  <th><abbr title="Notes">Notes</abbr></th>
					     
					     
					    </tr>
					  </thead>
					  
					  <tbody>

						@foreach($travels as $travel)
					    <tr class="color-reservation is-{!! \Lang::get('utils.service_color.'. $travel->service_color)  !!}">
					      <td data-title="Vehicle" class="header-vehicle">
					        {{ $travel->vehicle }}  {{ $travel->maximum_capacity }} PAX
					 		</td>
					      <td data-title="Date"> {{ $travel->date }}</td>
					      <td data-title="From">
					       {{ $travel->pickup }}
					      </td>
					      <td data-title="To"> 
					       {{ $travel->dropoff }} 
					      
					      <td data-title="Flight">{{ ($travel->flight) ? $travel->flight : '--' }} </td>
					      <td data-title="Name">{{ $travel->customer_name }}</td>
					       <td data-title="PAX">{{ $travel->adults + $travel->children  }}</td>
					       <td data-title="Rate">{{ $travel->rate }}</td>
					       <td data-title="$">{{ $travel->price }}</td>
					       <td data-title="Status">{{ \Lang::get('utils.status.'. $travel->status)  }}</td>
					       <td data-title="Notes">@if($travel->hidden_notes)<span class="tooltip" title="{{ $travel->hidden_notes }}"><i class="fa fa-eye"></i></span>@endif {{ $travel->notes }}</td>
					      
					    </tr>
					    @endforeach
					    
					    
					  </tbody>
					</table>
					

					 @if ($travels)
                        <div class="pagination-bulma">{!!$travels->render()!!}</div>
                    @endif
                   </div>
		</div>
		
    
       
<form method="post" id="form-delete" data-confirm="Are you sure?">
  <input name="_method" type="hidden" value="DELETE">{{ csrf_field() }}
</form>
              
</div>
@endsection
@section('scripts')

 <script src="{{ asset('js/vendor/jquery-2.2.3.min.js') }}"></script>

<script src="https://unpkg.com/flatpickr"></script>
 <script src="{{ asset('js/vendor/tooltipster.bundle.min.js') }}"></script>

<!--  <script src="{{ asset('js/vendor/picker.js') }}"></script>
 <script src="{{ asset('js/vendor/picker.date.js') }}"></script>
 <script src="{{ asset('js/vendor/picker.time.js') }}"></script> -->
 <!-- <script src="https://cdnjs.cloudflare.com/ajax/libs/moment.js/2.11.2/moment.min.js"></script> -->
 <!-- <script src="{{ asset('js/vendor/bootstrap.min.js') }} "></script> -->
 <!-- <script src="{{ asset('js/vendor/bootstrap-datetimepicker.min.js') }}"></script>  -->
 <script>
 	 (function ($) {
 	 	$(".date").flatpickr({
   		
 	 		onChange: function(selectedDates, dateStr, instance) {
		       $('.filters').find('form').submit();
		    },
 	 	});
 	 	$('.tooltip').tooltipster({
 	 		interactive: true
 	 	});
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
