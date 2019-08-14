<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class DepartmentPost extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     *
     * @return bool
     */
 

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules()
    {
        return [
            'dept_name' => 'required',
            'sy_start' => 'required',
            'sy_end' => 'required',
            'course_name' => 'required',
            'course_code' => 'required',
            'trimester' => 'required',
            'period' => 'required'
        ];
    }
}
