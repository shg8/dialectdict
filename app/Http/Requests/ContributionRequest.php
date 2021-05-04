<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class ContributionRequest extends FormRequest
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
            'english' => 'required|max:50',
            'chinese' => 'required_without_all:pronunciation,definition|max:50',
            'pronunciation' => 'required|max:50',
            'definition' => 'required_without_all:chinese,pronunciation|max:1000',
            'upload' => 'nullable|file|mimes:mp3,wav,m4a',
            'tags' => 'required|exists:App\Models\Tag,id'
        ];
    }
}
