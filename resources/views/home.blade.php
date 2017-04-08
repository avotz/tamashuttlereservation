@extends('layouts.app')

@section('content')
<div class="content">
    
       <div class="content">
					<h1>Travels</h1>
					
				
					 
				   <table class="table">
					  <thead>
					    
					    <tr>
					      <th><abbr title="ID">Vehicle</abbr></th>
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
					     
					     
					    </tr>
					  </thead>
					  
					  <tbody>

						@foreach($travels as $travel)
					    <tr class="color-reservation is-{!! \Lang::get('utils.service_color.'. $travel->service_color)  !!}">
					      <th  class="header-vehicle">
					        {{ $travel->vehicle }}  {{ $travel->maximum_capacity }} PAX
					 		</th>
					      <th> {{ $travel->date }}</th>
					      <td>
					       {{ $travel->pickup }}
					      </td>
					      <td> 
					       {{ $travel->dropoff }} 
					      
					      <td>{{ $travel->flight }} </td>
					      <td>{{ $travel->customer_name }}</td>
					       <td>{{ $travel->adults + $travel->children  }}</td>
					       <td>{{ $travel->rate }}</td>
					       <td>{{ ($travel->adults + $travel->children) * $travel->rate }}</td>
					       <td>{{ \Lang::get('utils.status.'. $travel->status)  }}</td>
					       <td>{{ $travel->notes }}</td>
					      
					    </tr>
					    @endforeach
					    
					    
					  </tbody>
					</table>
					

					 @if ($travels)
                        <div class="pagination-bulma">{!!$travels->render()!!}</div>
                    @endif
				</div>
		
    
       
<form method="post" id="form-delete" data-confirm="Are you sure?">
  <input name="_method" type="hidden" value="DELETE">{{ csrf_field() }}
</form>
              
</div>
@endsection
