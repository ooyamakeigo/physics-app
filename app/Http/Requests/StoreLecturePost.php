<?php

namespace App\Http\Requests;

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
            'title' => 'required|max:255',
            'comment' => 'required',
            'timed' => 'required',
            'week' => [
                'required',
                Rule::unique('lectures')->ignore($this->input('id'))->where(function($query) {
                    $query->where('timed', $this->input('timed'));
                }),
            ],
        ];
    }

    public function messages()
{
    return [
        'title.required' => 'タイトルを入力してください',
        'comment.required'  => 'コメントを入力してください!',
        "week.unique" => 'すでにこの時間は登録されている授業があります。',
    ];
}

}
