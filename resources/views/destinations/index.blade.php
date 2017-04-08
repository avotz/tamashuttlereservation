@extends('layouts.app')

@section('content')

				<div class="content">
					<h2>Destinations</h2>
					@include('destinations.partials.search')
					<a href="/destinations/create" class="button is-success">Create New destination</a>
				   <table class="table">
					  <thead>
					    <tr>
					      <th><abbr title="ID">ID</abbr></th>
					      <th><abbr title="Name">Name</abbr></th>
					      <th><abbr title="Created">Created</abbr></th>
					      <th></th>
					     
					    </tr>
					  </thead>
					  <tfoot>
					    <tr>
					       <th><abbr title="ID">ID</abbr></th>
					      <th><abbr title="Name">Name</abbr></th>
					      <th><abbr title="Created">Created</abbr></th>
					      <th></th>
					     
					    </tr>
					   
					  </tfoot>
					  <tbody>
					    @foreach($destinations as $destination)
					    <tr>
					      <th>{{ $destination->id }}</th>
					      <td><a href="/destinations/{{ $destination->id }}/edit" title="{{ $destination->name }}">{{ $destination->name }}</a>
					      </td>
					      <td>{{ $destination->created_at }}</td>
					      <td>
					      	 <button type="submit" class="button is-danger" form="form-delete" formaction="{!! url('/destinations/'.$destination->id) !!}"><i class="fa fa-remove"></i></button>
					      </td>
					    </tr>
					    @endforeach
					    
					    
					  </tbody>
					</table>
					 @if ($destinations)
                        <div class="pagination-bulma">{!!$destinations->appends(['q' => $search['q'] ])->render()!!}</div>
                    @endif
					
				</div>
		
    
       
<form method="post" id="form-delete" data-confirm="Are you sure?">
  <input name="_method" type="hidden" value="DELETE">{{ csrf_field() }}
</form>
@endsection