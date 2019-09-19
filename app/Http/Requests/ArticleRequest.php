<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class ArticleRequest extends FormRequest
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
        if ($this->request->has('has_image')) {
            return [
                'name' => 'required',
                'text' => 'required',
                'category_id' => 'required',
            ];

        } else {
            return [
                'name' => 'required',
                'text' => 'required',
                'category_id' => 'required',
                'image' => 'required',
            ];
        }
    }
}
