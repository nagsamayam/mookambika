<?php

namespace App\Http\Requests;

class FooterRequest extends BaseRequest
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
            'title' => 'required',
            'col1_titles.*' => 'sometimes',
            'col1_links.*' => 'sometimes',
            'col2_titles.*' => 'sometimes',
            'col2_links.*' => 'sometimes',
            'col3_titles.*' => 'sometimes',
            'col3_links.*' => 'sometimes'
        ];
    }

    public function messages()
    {
        $messages = [];
        foreach ($this->get('col1_titles') as $key => $val) {
            $messages['col1_titles.' . $key . '.required'] = 'Column one title with index ' . $key . '" is required.';
        }
        foreach ($this->get('col1_links') as $key => $val) {
            $messages['col1_links.' . $key . '.required'] = 'Column one link with index ' . $key . '" is required.';
        }
        foreach ($this->get('col2_titles') as $key => $val) {
            $messages['col2_titles.' . $key . '.required'] = 'Column two title with index ' . $key . '" is required.';
        }
        foreach ($this->get('col2_links') as $key => $val) {
            $messages['col2_links.' . $key . '.required'] = 'Column two link with index ' . $key . '" is required.';
        }
        foreach ($this->get('col3_titles') as $key => $val) {
            $messages['col3_titles.' . $key . '.required'] = 'Column three title with index ' . $key . '" is required.';
        }
        foreach ($this->get('col3_links') as $key => $val) {
            $messages['col3_links.' . $key . '.required'] = 'Column three link with index ' . $key . '" is required.';
        }
        return $messages;
    }

    public function filters()
    {
        return [
            'title' => 'strip_tags|trim|capitalize_first_letter',
        ];
    }
}
