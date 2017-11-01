<?php

namespace App\Http\Requests;

class FaqRequest extends BaseRequest
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
            'title' => 'required|min:3',
            'content' => 'required',
            'published_at' => 'required|date',
            'tag_list' => 'required|distinct'
        ];
    }

    public function filters()
    {
        return [
            'title' => 'strip_tags|trim|capitalize_first_letter',
            'content' => 'trim|capitalize_first_letter',
        ];
    }
}
