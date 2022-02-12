<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class UpdateUserRequest extends FormRequest
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
        $rules = [
            'name' => ['required', 'string', 'max:255'],
            'username' => ['required', 'string', 'max:255', "unique:users,username,{$this->user->id}"],
            'email' => ['required', 'string', 'email', 'max:255', "unique:users,email,{$this->user->id}"],
            'password' => ['nullable', 'string', 'min:8'],
            'avatar' => ['nullable', 'string'],
            'roles' => ['required', 'array'],
        ];

        return $rules;
    }
}
