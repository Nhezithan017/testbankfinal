<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\User;
use Illuminate\Support\Facades\Crypt;
use App\Course;

use Illuminate\Support\Facades\Hash;
class AdminController extends Controller
{
    public function __construct()
    {
   

    }
    public function index(){
        
        
        $users = User::latest()->paginate(5);

        if(auth()->user()->end_user == 'dean'){
            $users = User::where('end_user','!=','admin')->paginate(5);
        }   
        return view('backend.admin.user.index', compact('users'));
    }
    public function viewTest(){

    	$courses = Course::latest()->paginate(5);
        
    	return view('backend.admin.view.index',compact('courses'));
    }
    public function facultyTest(){
        
    	$courses = User::where('end_user','faculty')->with('courses')->get();
    
    	return view('backend.admin.view.faculty',compact('courses'));
    }
    public function create(){
       
        return view('backend.admin.user.create', compact('user_type'));
    }
    public function store(Request $request){
        $request->validate([
            'name' => ['required', 'string', 'max:255'],
            'email' => ['required', 'string', 'email', 'max:255', 'unique:users'],
            'password' => ['required', 'string', 'min:8'],
        ]);

        User::create([
            'name' => request('name'),
            'email' => request('email'),
            'password' => Hash::make(request('password')),
            'end_user' => request('end_user'),
        ]);

        session()->flash('message','New user created!');

        return redirect('/users');
    }
    public function edit(User $user){
      
        return view('backend.admin.user.edit', compact('user'));
    }
    public function update(User $user, Request $request){

        $request->validate([
            'name' => ['required', 'string', 'max:255'],
            'email' => ['required', 'string', 'email', 'max:255'],
            'password' => ['required', 'string', 'min:8'],
        ]);

        $user->update([
            'name' => request('name'),
            'email' => request('email'),
            'password' => Hash::make(request('password')),
            'end_user' => request('end_user'),
        ]);

        session()->flash('message','user edited!');
   
        return redirect('/users');
    }
    public function destroy(User $user){
        
        $user->delete();

        session()->flash('message','user deleted!');

        return redirect()->back();

    }
    public function deleteImport(Course $courses){
        
        $courses->delete();

        session()->flash('message','Department deleted!');

        return redirect()->back();

    }
}
