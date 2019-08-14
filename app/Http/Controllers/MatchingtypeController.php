<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Matchingtype;
use App\Course;
use Illuminate\Support\Facades\Mail;
use App\Mail\UserMailQuestion;

class MatchingtypeController extends Controller
{
    public function getMT(Course $courses)
    {
 
    $question_mt = $courses->matchingtype;
    
     return response()->json([
         'data' => $question_mt,
         'msg' => 'Fetch',
         'status' => 200
     ]);
    }
    public function upsert(Request $request,Course $courses)
    {
        
       
        $ques_mt = $request->post('item');
        foreach($ques_mt as $qmt)
        {
        

            if($qmt['id'])
            {
                Matchingtype::where('id', $qmt['id'])->update($qmt);
            }else{
                Matchingtype::create($qmt + ['course_id' => $courses->id ]);
                if($courses->matchingtype->count() == 5){
                    Mail::to($courses->user->email)->send(
                        new UserMailQuestion($courses)
                    );
                }
            }
        }

        return ['success' => true];
    }
    public function remove(Matchingtype $mtId){

            $mtId->delete();
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
    public function addImport(Course $courses,Matchingtype $matchingtype){
 
    
        $input = [
             'premises' => $matchingtype->premises,
             'responses' => $matchingtype->responses,
        ];
           $matchingtype =  Matchingtype::create($input + ['course_id' => $courses->id]);
           return response()->json([
               'success' => true,
               'msg' => 'Successfully imported ' . 'you have ' . $courses->matchingtype->count() . ' items'
           ]);
    }
}
