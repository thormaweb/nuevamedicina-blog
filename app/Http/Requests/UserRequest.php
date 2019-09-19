<?php

namespace App\Http\Requests;

use Illuminate\Validation\Rule;
use Illuminate\Foundation\Http\FormRequest;

class UserRequest extends FormRequest
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
        if ($this->request->has('user_id')) {
            return [
                'name' => 'required',
                'email' => 'required|unique:users,email,'.$this->request->get('user_id'),
                'role_id' => 'required',
            ];
        }

        return [
            'name' => 'required',
            'email' => 'required|unique:users',
            'role_id' => 'required',
        ];
    }
}
