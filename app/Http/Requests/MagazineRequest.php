<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class MagazineRequest extends FormRequest
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
        $validationRules = [
            'year' => 'required',
            'month' => 'required',
            'description' => 'required',
            'thumbnail' => 'mimes:jpeg,jpg,png',
            'pdf' => 'mimes:pdf|max:50000',
            'published_on' => 'required'
        ];

        if($this->request->has('issuu_active')) {
            $validationRules['description'] = '';
            $validationRules['issuu_script'] = 'required';
            if(! $this->request->has('in_edition')) {
                $validationRules['thumbnail'] = 'required|mimes:jpeg,jpg,png';
            }
        } else {

            if(! $this->request->has('in_edition')) {
                $validationRules['thumbnail'] = 'required|mimes:jpeg,jpg,png';
                $validationRules['pdf'] = 'required|mimes:pdf|max:50000';
            }
        }

        return $validationRules;
    }
}
