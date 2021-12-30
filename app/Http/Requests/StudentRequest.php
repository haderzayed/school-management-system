<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class StudentRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     *
     * @return bool
     */
    public function authorize()
    {
        return true;
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules()
    {
        return [
            'name_ar'=>'required',
            'name_en'=>'required',
            'email'=>'required|email|unique:students.email',
            'password'=>'required|string|min:6|max:10',
            'gender_id'=>'required',
            'nationality_id'=>'required',
            'blood_id'=>'required',
            'date_birth'=>'required|date|date_format:Y-M-d',
            'grade_id'=>'required',
            'class_id'=>'required',
            'parent_id'=>'required',
            'academic_year'=>'required',
        ];
    }

    public function messages()
    {
        return [
            'email.required' => trans('validation.required'),
            'email.unique' => trans('validation.unique'),
            'password.required' => trans('validation.required'),
            'name_ar.required' => trans('validation.required'),
            'name_en.required' => trans('validation.required'),
            'gender_id.required' => trans('validation.required'),
            'nationality_id.required' => trans('validation.required'),
            'blood_id.required' => trans('validation.required'),
            'date_birth.required' => trans('validation.required'),
            'grade_id.required' => trans('validation.required'),
            'class_id.required' => trans('validation.required'),
            'parent_id.required' => trans('validation.required'),
            'academic_year.required' => trans('validation.required'),
        ];
    }
}
