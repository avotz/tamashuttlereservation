@extends('layouts.app')

@section('content')

				<div class="content">
					<h2>Clients</h2>
					@include('clients.partials.search')
					<a href="/clients/create" class="button is-success">Create New client</a>
				   <div id="no-more-tables">
					   <table class="table">
						  <thead>
						    <tr>
						      <th><abbr title="ID">ID</abbr></th>
						      <th><abbr title="Name">Name</abbr></th>
						      <th><abbr title="Email">Email</abbr></th>
						      <th><abbr title="Phone">Phone</abbr></th>
						      <th><abbr title="Pickup">pickup</abbr></th>
						      <th><abbr title="Created">Created</abbr></th>
						      <th></th>
						     
						    </tr>
						  </thead>
						 
						  <tbody>
						    @foreach($clients as $client)
						    <tr>
						      <td data-title="ID">{{ $client->id }}</td>
						      <td data-title="Name"><a href="/clients/{{ $client->id }}/edit" title="{{ $client->name }}">{{ $client->name }}</a>
						      </td>
						      <td data-title="Email">{{ $client->email }}</td>
						      <td data-title="Phone">{{ $client->phone }}</td>
						      <td data-title="Pickup">{{ $client->pickup }}</td>
						      <td data-title="Created">{{ $client->created_at }}</td>
						      <td>
						      @if(auth()->user()->hasRole('admin'))
						      	 <button type="submit" class="button is-danger" form="form-delete" formaction="{!! url('/clients/'.$client->id) !!}"><i class="fa fa-remove"></i></button>
						      	 @endif
						      </td>
						    </tr>
						    @endforeach
						    
						    
						  </tbody>
						</table>
						 @if ($clients)
	                        <div class="pagination-bulma">{!!$clients->appends(['q' => $search['q'] ])->render()!!}</div>
	                    @endif
                    </div>
					
				</div>
		
    
       
<form method="post" id="form-delete" data-confirm="Are you sure?">
  <input name="_method" type="hidden" value="DELETE">{{ csrf_field() }}
</form>
@endsection