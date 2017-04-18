@extends('layouts.app')

@section('content')

				<div class="content">
					<h2>Vehicles</h2>
					@include('vehicles.partials.search')
					<a href="/vehicles/create" class="button is-success">Create New vehicle</a>
				   <div id="no-more-tables">
				   		<table class="table">
						  <thead>
						    <tr>
						      <th><abbr title="ID">ID</abbr></th>
						      <th><abbr title="Name">Name</abbr></th>
						      <th><abbr title="Email">Driver</abbr></th>
						      <th><abbr title="Role">Maximum Capacity</abbr></th>
						      <th><abbr title="Created">Created</abbr></th>
						      <th></th>
						     
						    </tr>
						  </thead>
						 
						  <tbody>
						    @foreach($vehicles as $vehicle)
						    <tr>
						      <td data-title="ID">{{ $vehicle->id }}</td>
						      <td data-title="Name"><a href="/vehicles/{{ $vehicle->id }}/edit" title="{{ $vehicle->name }}">{{ $vehicle->name }}</a>
						      </td>
						      <td data-title="Driver">{{ $vehicle->driver }}</td>
						      <td data-title="Capacity">{{ $vehicle->maximum_capacity }}</td>
						      <td data-title="Created">{{ $vehicle->created_at }}</td>
						      <td>
						       @if(auth()->user()->hasRole('admin'))
						      	 <button type="submit" class="button is-danger" form="form-delete" formaction="{!! url('/vehicles/'.$vehicle->id) !!}"><i class="fa fa-remove"></i></button>
						      	@endif
						      </td>
						    </tr>
						    @endforeach
						    
						    
						  </tbody>
						</table>
						 @if ($vehicles)
	                        <div class="pagination-bulma">{!!$vehicles->appends(['q' => $search['q'] ])->render()!!}</div>
	                    @endif
				   </div>
				   
					
				</div>
		
    
       
<form method="post" id="form-delete" data-confirm="Are you sure?">
  <input name="_method" type="hidden" value="DELETE">{{ csrf_field() }}
</form>
@endsection