<?php

namespace App\Http\Requests;

class ReviewRequest extends BaseRequest
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
            'reviewer_name' => 'required|min:3',
            'reviewer_designation' => 'required',
            'reviewer_organization' => 'required',
            'reviewer_location' => 'required:min:3',
            'avatar' => 'sometimes|image|mimes:jpeg,png,jpg,gif',
            'rating' => 'required',
            'content' => 'required',
            'tag_list' => 'required|distinct'
        ];
    }

    public function filters()
    {
        return [
            'reviewer_name' => 'strip_tags|trim|titleize',
            'reviewer_designation' => 'strip_tags|trim|titleize',
            'reviewer_organization' => 'strip_tags|trim|titleize',
            'reviewer_location' => 'strip_tags|trim|titleize',
            'rating' => 'strip_tags|trim',
            'content' => 'trim|capitalize_first_letter',
        ];
    }
}
