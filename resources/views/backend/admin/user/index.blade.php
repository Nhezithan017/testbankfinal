@extends('layouts.app')

@section('content')
<v-app>
        <v-container>
@if ($flash=session('message'))

<div class="container">
	<div class="alert alert-success" role="alert" id = "Delete">
	    {{ $flash }}
	</div>
</div> 
@endif
<div class="container">
        <v-btn-toggle>
                   <v-btn round color="success" dark href="/users"><v-icon right small dark>menu </v-icon>User</v-btn>
               <v-btn round color="primary"dark href="/create/user"><v-icon right small dark>add </v-icon>Add User</v-btn>
        </v-btn-toggle>
   <v-container>
<table class="table table-striped table-inverse table-responsive offset-lg-2">
    <thead class="thead-inverse bg-dark text-light">
        <tr>
            <th>Name</th>
            <th>Email</th>
            <th>User Status</th>
            <th>Create At</th>
            <th></th>
        </tr>
        </thead>
        <tbody>
              @foreach($users as $user)
            <tr>
            <td scope="row">{{ $user->name }}</td>
                <td>{{ $user->email }}</td>
                <td>{{ $user->end_user }}</td>
                <td>{{ $user->created_at->diffForHumans() }}</td>
 
            <td>
                    <v-btn fab dark small color="cyan" href="/edit/user/{{$user->id}}"> <v-icon dark>edit</v-icon></v-btn>
                @if(auth()->user()->end_user == 'admin')
                   <v-btn fab dark small color="red" data-toggle="modal" data-target="#exampleModal"> <v-icon dark>delete</v-icon></v-btn>
                   <form method="POST" action="{{ route('admin.delete', ['user' => $user->id]) }}">
                        @method('DELETE')
                           @csrf
      <div class="modal fade" id="exampleModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="exampleModalLabel">Notification</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body">
       <h5>Would you like to delete user <i>{{ $user->name }} </i> ?</h5>
      </div>
      <div class="modal-footer">
          
        <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
        <button type="submit"  name="delete" class="btn btn-danger">Delete</button>
      
    </div>
    </div>
  </div>
</div>
</form>
  @endif
        </td>
        </tr>
        @endforeach
        </tbody>
</table>
</ul>
</v-container>
<div class="d-flex justify-content-center">
    {{ $users->links() }}
    </div>
</div>
</v-container>
</v-app>
@endsection