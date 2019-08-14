<?php

namespace App\Http\Controllers;

use App\Question;
use App\Course as Course;
use Illuminate\Http\Request;
use App\Mail\UserMailQuestion;
use Illuminate\Support\Facades\Mail;

use App\Http\Requests\QuestionPost;
// use ridvanbaluyos\sms\Sms as Sms;
// use ridvanbaluyos\sms\providers\PromoTexter as PromoTexter;
class QuestionController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function __construct(){
      
    }
    public function ques(){
       
       return view('backend.questions.ques-editor');
   }
   public function getQuestion(Course $courses)
   {
  
   $questions = $courses->questions;
   
    return response()->json([
        'data' => $questions,
        'msg' => 'Fetch',
        'status' => 200
    ]);
   }
   public function showQuestion(Question $questions){
        return $questions;
   }
   public function addQuestion(QuestionPost $request, $courseId){

    $courses = Course::find($courseId);

   
   
        Question::create($request->validated() + ['course_id' => $courses->id]);
        if($courses->questions->count() == 5){
            Mail::to($courses->user->email)->send(
                new UserMailQuestion($courses)
            );
        }
        return response()->json([
            'msg' => 'Question added successfully'
        ]);
   }
   public function editQuestion(QuestionPost $request,Question $questions)
   {
      $questions->update($request->validated());

      return response()->json([
        'msg' => 'Question updated successfully'
    ]);
   }
   public function searchQue(Request $request)
   {    
       $request->validate([
            'dept_name' => 'required',
            'course_name' => 'required',
            'trimester' => 'required',
            'period' => 'required',

       ]);
  
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
   public function addImport(Course $courses,Question $question){

   
       $input = [
            'question' => $question->question,
            'A' => $question->A,
            'B' => $question->B,
            'C' => $question->C,
            'D' => $question->D,
            'answer' => $question->answer,
       ];
          $questions =  Question::create($input + ['course_id' => $courses->id]);
          return response()->json([
              'success' => true,
              'msg' => 'Successfully imported ' . 'you have ' . $courses->questions->count() . ' questions'
          ]);
   }
   public function removeQuestion(Question $questions){
        $questions->delete();
   }

}
