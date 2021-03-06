<?php

namespace App\Http\Requests;
use Auth;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;

class StoreLecturePost extends FormRequest
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
            'title' => 'required|max:10',
            'teacher' => 'required',
            'timed' => 'required',
            'week' => [
                'required',
                Rule::unique('lectures')->ignore($this->input('id'))->where(function($query) {
                    $query->where('user_id', Auth::user()->id)->where('timed', $this->input('timed'));
                }),
            ],
        ];
    }

    public function messages()
    {
    return [
        'title.required' => 'タイトルを入力してください',
        'title.max' => '授業名は10文字以内で入力してください',
        'teacher.required'  => '教授名を入力してください',
        "week.unique" => 'すでにこの時間は登録されている授業があります。',
    ];
    }

}
