<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class QuestionPost extends FormRequest
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
            'question' => 'required|min:10',
            'A' => 'required|min:5',
            'B' => 'required|min:5',
            'C' => 'required|min:5',
            'D' => 'required|min:5',
            'answer' => 'required',
        ];
    }
}
