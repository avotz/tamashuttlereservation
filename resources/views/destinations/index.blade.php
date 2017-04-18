@extends('layouts.app')

@section('content')

				<div class="content">
					<h2>Destinations</h2>
					@include('destinations.partials.search')
					<a href="/destinations/create" class="button is-success">Create New destination</a>
				   <div id="no-more-tables">
					   <table class="table">
						  <thead>
						    <tr>
						      <th><abbr title="ID">ID</abbr></th>
						      <th><abbr title="Name">Name</abbr></th>
						      <th><abbr title="Type">Type</abbr></th>
						      <th><abbr title="Created">Created</abbr></th>
						      <th></th>
						     
						    </tr>
						  </thead>
						 
						  <tbody>
						    @foreach($destinations as $destination)
						    <tr>
						      <td data-title="ID">{{ $destination->id }}</td>
						      <td data-title="Name"><a href="/destinations/{{ $destination->id }}/edit" title="{{ $destination->name }}">{{ $destination->name }}</a>
						      </td>
						      <td data-title="Type">{{ \Lang::get('utils.type.'. $destination->type)  }}</td>
						      <td data-title="Created">{{ $destination->created_at }}</td>
						      <td>
						      @if(auth()->user()->hasRole('admin'))
						      	 <button type="submit" class="button is-danger" form="form-delete" formaction="{!! url('/destinations/'.$destination->id) !!}"><i class="fa fa-remove"></i></button>
						      	 @endif
						      </td>
						    </tr>
						    @endforeach
						    
						    
						  </tbody>
						</table>
						 @if ($destinations)
	                        <div class="pagination-bulma">{!!$destinations->appends(['q' => $search['q'] ])->render()!!}</div>
	                    @endif
                    </div>
					
				</div>
		
    
       
<form method="post" id="form-delete" data-confirm="Are you sure?">
  <input name="_method" type="hidden" value="DELETE">{{ csrf_field() }}
</form>
@endsection