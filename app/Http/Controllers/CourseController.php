<?php

namespace App\Http\Controllers;

use App\Course;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

use App\Mail\UserMailQuestion;
use Illuminate\Support\Facades\Mail;
use App\Http\Requests\DepartmentPost;
class CourseController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function __construct()
    {
     
    }
   public function dept(){
        $courses = Auth::user()->courses;
       return view('backend.courses.index', compact('courses'));
   }
    public function index()
    {
        $courses = Auth::user()->courses;

        
        return view('backend.courses.index', compact('courses'));
    }
    public function getDept()
    {
    
         $courses = Auth::user()->courses;
        return response()->json([
            'data' => $courses,
            'msg' => 'Fetch',
            'status' => 200
        ]);
    }
    public function addDept(DepartmentPost $request)
    {
        
        Course::create($request->validated()+ ['user_id' => Auth::id()]);

        return response()->json([
            'add' => 'Deparment Added Successfully'
        ]);
 
    }
    public function removeDept(Course $courses)
    {

       $courses->delete();

    }
    public function updateDept(DepartmentPost $request, Course $courses)
    {
      $courses->update($request->validated());


      return response()->json([
        'update' => 'Deparment updated Successfully'
    ]);
    }


    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $data = [];
        $data['department_name'] = $this->department_name;
        $data['trimester'] = $this->trimester;
        $data['period'] = $this->period;

        return view('backend.courses.create', $data);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function showDept(Course $courses)
    {
        return $courses;
    }
    public function store()
    {
        $this->validate(request(),[
           'dept_name' => 'required',
            'sy_start'=> 'required',
            'sy_end'=> 'required',
            'course_name'=> 'required',
            'trimester'=> 'required',
            'period'=> 'required'
         ]);

      $courses =  Course::create([
         'dept_name' => request('dept_name'),
         'sy_start' => request('sy_start'),
         'sy_end' => request('sy_end'),
         'course_name' => request('course_name'),
         'trimester' => request('trimester'),
         'period' => request('period'),
         'user_id' => Auth::id()
      ]);


      session()->flash('message','New Department created!');
  
    //   Mail::to($courses->user->email)->send(
    //       new UserMailQuestion($courses)
    //   );
      return redirect('/course');

       
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Course  $course
     * @return \Illuminate\Http\Response
     */
    public function show(Course $course)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Course  $course
     * @return \Illuminate\Http\Response
     */
    public function edit(Course $courses)
    {
        $data = [];
        $data['department_name'] =  $this->department_name;
        $data['trimester'] =  $this->trimester;
        $data['period'] =  $this->period;
        $data['courses'] = $courses;
        return view('backend.courses.edit', $data);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Course  $course
     * @return \Illuminate\Http\Response
     */
    public function update(Course $courses, Request $request)
    {
      $course =  $request->validate([
            'dept_name' => 'required',
             'sy_start'=> 'required',
             'sy_end'=> 'required',
             'course_name'=> 'required',
             'trimester'=> 'required',
             'period'=> 'required'
          ]);
   
       

       $courses->update($course);
         
   
         session()->flash('message','Department edited!');
   
         return redirect('/course');

        
    }
    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Course  $course
     * @return \Illuminate\Http\Response
     */
    public function destroy($courseId)
    {
       Course::destroy($courseId);

       session()->flash('message','Department deleted!');

       return redirect()->back();
    }
}
