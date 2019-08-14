<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\DB;

class Course extends Model
{
    protected $guarded = [];

    public function questions(){
        return $this->hasMany('App\Question');
    }
    public function trueorfalse(){
        return $this->hasMany('App\Trueorfalse');
    }
    public function matchingtype(){
        return $this->hasMany('App\Matchingtype');
    }
    public function user(){
    	return $this->belongsTo('App\User');
    }
    public function search($deptName,$courseName,$trimester,$period){
        $courses = 
                    Course::
                    where('dept_name',$deptName)        
                    ->where('course_name',$courseName)
                    ->where('trimester',$trimester)
                    ->where('period',$period)
                    ->with(["questions","trueorfalse","matchingtype"])
                    ->get();

        return $courses;
                    
    }
  
}
