<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Matchingtype extends Model 
{
    protected $guarded = [];
    
    public function courses(){
    	return $this->belongsTo('App\Course','course_id', 'id');
    }
}
