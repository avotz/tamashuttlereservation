@extends('layouts.app')

@section('content')

				<div class="content">
					<h2>Hotels</h2>
					@include('hotels.partials.search')
					<a href="/hotels/create" class="button is-success">Create New hotel</a>
				   <div id="no-more-tables">
					   <table class="table">
						  <thead>
						    <tr>
						      <th><abbr title="ID">ID</abbr></th>
						      <th><abbr title="Name">Name</abbr></th>
						      <th><abbr title="Created">Created</abbr></th>
						      <th></th>
						     
						    </tr>
						  </thead>
						 
						  <tbody>
						    @foreach($hotels as $hotel)
						    <tr>
						      <td data-title="ID">{{ $hotel->id }}</td>
						      <td data-title="Name"><a href="/hotels/{{ $hotel->id }}/edit" title="{{ $hotel->name }}">{{ $hotel->name }}</a>
						      </td>
						      <td data-title="Created">{{ $hotel->created_at }}</td>
						      <td>
						      @if(auth()->user()->hasRole('admin'))
						      	 <button type="submit" class="button is-danger" form="form-delete" formaction="{!! url('/hotels/'.$hotel->id) !!}"><i class="fa fa-remove"></i></button>
						      	 @endif
						      </td>
						    </tr>
						    @endforeach
						    
						    
						  </tbody>
						</table>
						 @if ($hotels)
	                        <div class="pagination-bulma">{!!$hotels->appends(['q' => $search['q'] ])->render()!!}</div>
	                    @endif
                    </div>
					
				</div>
		
    
       
<form method="post" id="form-delete" data-confirm="Are you sure?">
  <input name="_method" type="hidden" value="DELETE">{{ csrf_field() }}
</form>
@endsection