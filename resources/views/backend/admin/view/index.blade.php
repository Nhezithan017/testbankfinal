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
        <div class="row">
            <div class="col-sm-12">
            <table class="table table-striped table-inverse table-responsive offset-lg-1">
                <thead class="thead-inverse">
                    <tr>
                        <th>Department</th>
                        <th>Course</th>
                        <th>SY - Start</th>
                        <th>SY - End</th>
                        <th>Author</th>
                    </tr>
                    </thead>
                    <tbody>
                            @foreach($courses as $course)
                        <tr>
                            <td scope="row">{{ $course->dept_name }}</td>
                            <td> {{$course->course_name }}</td>
                            <td> {{ $course->sy_start }} </td>
                            <td> {{ $course->sy_end }} </td>
                            <td>{{ $course->user->name }}</td>
                            <td>
                            <v-btn fab dark small color="cyan" href="{{ url('tests/pdfexport/' . $course->id) }}" target="_blank" name="delete" ><v-icon dark>cloud_download</v-icon></v-btn>
                           
                             @if(auth()->user()->end_user == 'admin')
                   <v-btn fab dark small color="red" data-toggle="modal" data-target="#exampleModal"> <v-icon dark>delete</v-icon></v-btn>
                   <form method="POST" action="{{ route('import.delete', ['courses' => $course->id]) }}">
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
       <h5>Would you like to delete  <i>{{ $course->course_name }} </i> ?</h5>
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
        </div>
        </div>
    </div>    
    <br>
   <div class="d-flex justify-content-center">
    {{ $courses->links() }} 
   </div> 
</v-container>
</v-app>
@endsection