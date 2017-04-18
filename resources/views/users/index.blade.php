@extends('layouts.app')

@section('content')

				<div class="content">
					<h2>Users</h2>
					@include('users.partials.search')
					<a href="/users/create" class="button is-success">Create New User</a>
				   <table class="table">
					  <thead>
					    <tr>
					      <th><abbr title="ID">ID</abbr></th>
					      <th><abbr title="Name">Name</abbr></th>
					      <th><abbr title="Email">Email</abbr></th>
					      <th><abbr title="Role">Role</abbr></th>
					      <th><abbr title="Created">Created</abbr></th>
					      <th></th>
					     
					    </tr>
					  </thead>
					  <tfoot>
					    <tr>
					       <th><abbr title="ID">ID</abbr></th>
					      <th><abbr title="Name">Name</abbr></th>
					      <th><abbr title="Email">Email</abbr></th>
					      <th><abbr title="Role">Role</abbr></th>
					      <th><abbr title="Created">Created</abbr></th>
					      <th></th>
					     
					    </tr>
					   
					  </tfoot>
					  <tbody>
					    @foreach($users as $user)
					    <tr>
					      <th>{{ $user->id }}</th>
					      <td><a href="/users/{{ $user->id }}/edit" title="{{ $user->name }}">{{ $user->name }}</a>
					      </td>
					      <td>{{ $user->email }}</td>
					      <td>{{ $user->roles->first()->name }}</td>
					      <td>{{ $user->created_at }}</td>
					      <td>
					      	 @if(auth()->user()->hasRole('admin'))
					      	 <button type="submit" class="button is-danger" form="form-delete" formaction="{!! url('/users/'.$user->id) !!}"><i class="fa fa-remove"></i></button>
					      	 @endif
					      </td>
					    </tr>
					    @endforeach
					    
					    
					  </tbody>
					</table>

			    	 @if ($users)
                        <div class="pagination-bulma">{!!$users->appends(['q' => $search['q'],'role'=> $search['role'] ])->render()!!}</div>
                    @endif
					   
					
				</div>
		
    
       
<form method="post" id="form-delete" data-confirm="Are you sure?">
  <input name="_method" type="hidden" value="DELETE">{{ csrf_field() }}
</form>
@endsection