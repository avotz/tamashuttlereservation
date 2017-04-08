@extends('layouts.app')

@section('content')
<div class="content">
    
        <h1>You are logged in!</h1>
       <div class="content">
					<h2>Travels</h2>
					
					@foreach($travels as $travel)
					 
				   <table class="table">
					  <thead>
					    <tr>
					    	<th colspan="11" class="header-vehicle">
					        {{ $travel->vehicles->first()->name }}  {{ $travel->vehicles->first()->maximum_capacity }} PAX
					 		</th>
					    </tr>
					    <tr>
					      <th><abbr title="ID">Date</abbr></th>
					      <th><abbr title="Name">From</abbr></th>
					      <th><abbr title="Name">To</abbr></th>
					      <th><abbr title="Name">flight</abbr></th>
						  <th><abbr title="Name">Name</abbr></th>
						  <th><abbr title="Name">PAX</abbr></th>
						  <th><abbr title="Name">Rate</abbr></th>
						  <th><abbr title="Name">$</abbr></th>
						  <th><abbr title="Name">Status</abbr></th>
						  <th><abbr title="Name">Notes</abbr></th>
					      <th></th>
					     
					    </tr>
					  </thead>
					  
					  <tbody>

					     @foreach($travel->reservations as $reservation)
					    <tr class="color-reservation is-{!! \Lang::get('utils.service_color.'. $reservation->service_color)  !!}">
					      <th> {{ $reservation->date }}</th>
					      <td>
					       {{ $reservation->pickup }}
					      </td>
					      <td> 
					       {{ $reservation->dropoff }} 
					      
					      <td></td>
					      <td>{{ $reservation->customer_name }}</td>
					       <td>{{ $reservation->adults + $reservation->children  }}</td>
					       <td>{{ $reservation->rate }}</td>
					       <td>{{ $reservation->price }}</td>
					       <td>{{ $reservation->status }}</td>
					       <td>{{ $reservation->notes }}</td>
					      <td>
					      	 <button type="submit" class="button is-danger" form="form-delete" formaction="{!! url('/travels/'.$travel->id) !!}"><i class="fa fa-remove"></i></button>
					      </td>
					    </tr>
					    @endforeach
					    
					    
					  </tbody>
					</table>
					@endforeach

					 @if ($travels)
                        <div class="pagination-bulma">{!!$travels->render()!!}</div>
                    @endif
				</div>
		
    
       
<form method="post" id="form-delete" data-confirm="Are you sure?">
  <input name="_method" type="hidden" value="DELETE">{{ csrf_field() }}
</form>
              
</div>
@endsection
