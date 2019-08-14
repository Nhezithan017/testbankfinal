<?php

namespace App\Http\Controllers;

use App\Trueorfalse;
use App\Course;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Mail;
use App\Mail\UserMailQuestion;
class TrueorfalseController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function getTF(Course $courses)
    {
 
    $questions_tf = $courses->trueorfalse;
    
     return response()->json([
         'data' => $questions_tf,
         'msg' => 'Fetch',
         'status' => 200
     ]);
    }

    public function upsert(Request $request,Course $courses)
    {
        
       
        $ques_tf = $request->post('item');
        foreach($ques_tf as $qtf)
        {
        

            if($qtf['id'])
            {
                Trueorfalse::where('id', $qtf['id'])->update($qtf);
            }else{
                Trueorfalse::create($qtf + ['course_id' => $courses->id ]);
                if($courses->trueorfalse->count() == 5){
                    Mail::to($courses->user->email)->send(
                        new UserMailQuestion($courses)
                    );
                }
            }
        }

       
        return ['success' => true];
    }
    public function removeTf(Trueorfalse $tfId){

            $tfId->delete();
    }
    public function searchQue(Request $request)
    {    
        $request->validate([
             'dept_name' => 'required',
             'course_name' => 'required',
             'trimester' => 'required',
             'period' => 'required',
 
        ]);
        $msg = "";
        $deptName = $request->get('dept_name');
        $courseName = $request->get('course_name');
        $trimester = $request->get('trimester');
        $period = $request->get('period');
     
        $course= new Course;
        $courses = $course->search($deptName,$courseName,$trimester,$period);
         
       
         return response()->json([
             'data' => $courses,
             'status' => 200,
           
         ]);
    }
    public function addImport(Course $courses,Trueorfalse $trueorfalse){
 
    
        $input = [
             'ques_name' => $trueorfalse->ques_name,
             'isCorrect' => $trueorfalse->isCorrect,
        ];
           $trueorfalse =  Trueorfalse::create($input + ['course_id' => $courses->id]);
           return response()->json([
               'success' => true,
               'msg' => 'Successfully imported ' . 'you have ' . $courses->trueorfalse->count() . ' items'
           ]);
    }
    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Trueorfalse  $trueorfalse
     * @return \Illuminate\Http\Response
     */
    public function show(Trueorfalse $trueorfalse)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Trueorfalse  $trueorfalse
     * @return \Illuminate\Http\Response
     */
    public function edit(Trueorfalse $trueorfalse)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Trueorfalse  $trueorfalse
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Trueorfalse $trueorfalse)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Trueorfalse  $trueorfalse
     * @return \Illuminate\Http\Response
     */
    public function destroy(Trueorfalse $trueorfalse)
    {
        //
    }
}
