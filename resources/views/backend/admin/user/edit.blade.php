@extends('layouts.app')

@section('content')
<v-app>
        <v-container>
@if ($errors->any())
    <div class="container alert alert-outline">
            @foreach ($errors->all() as $error)
                <p class="text-center">{{ $error }}</p>
            @endforeach
        
    </div>
@endif
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
                <div class="card-header bg-primary text-light">Update User</div>

                <div class="card-body">
                    <form method="POST" action="/edit/user/{{$user->id}}">
                        @csrf

                        <div class="form-group row">
                            <label for="name" class="col-md-4 col-form-label text-md-right">Name</label>

                            <div class="col-md-6">
                                <input id="name" type="text" class="form-control" name="name" value="{{ $user->name }}" required autocomplete="name" autofocus>
                            </div>
                        </div>

                        <div class="form-group row">
                            <label for="email" class="col-md-4 col-form-label text-md-right">E-mail Address</label>

                            <div class="col-md-6">
                                <input id="email" type="email" class="form-control" name="email" value="{{ $user->email  }}" required autocomplete="email">
                            </div>
                        </div>

                        <div class="form-group row">
                            <label for="password" class="col-md-4 col-form-label text-md-right">Password</label>

                            <div class="col-md-6">
                                <input id="password" type="password" class="form-control" name="password"  autocomplete="new-password">

                            </div>
                        </div> 

                        <div class="form-group row">
                            <label for="User Type" class="col-md-4 col-form-label text-md-right">User Type</label>
                            <div class="col-md-6">
                                    <div class="form-check form-check-inline">
                                        @if(auth()->user()->end_user == 'admin')
                                        <label class="form-check-label">
                                            <input class="form-check-input" type="radio" name="end_user" id="" value="admin" {{ $user->end_user == 'admin' ? 'checked' : ''  }}>Admin
                                        </label>
                                        @endif
                                        </div>
                                        <div class="form-check form-check-inline">
                                        <label class="form-check-label">
                                                <input class="form-check-input" type="radio" name="end_user" id="" value="dean" {{ $user->end_user == 'dean' ? 'checked' : ''  }}>Dean
                                         </label>
                                         </div>
                                         <div class="form-check form-check-inline">
                                         <label class="form-check-label">
                                                <input class="form-check-input" type="radio" name="end_user" id="" value="faculty" {{ $user->end_user == 'faculty' ? 'checked' : ''  }}>Faculty
                                         </label>
                                    </div>
                                
                            </div>
                        </div>

                        <div class="form-group row mb-0">
                            <div class="col-md-6 offset-md-4">
                                <button type="submit" class="btn btn-primary">
                                    Update
                                </button>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
        </v-container>
</v-app>
@endsection
