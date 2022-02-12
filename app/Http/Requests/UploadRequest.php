<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class UploadRequest extends FormRequest
{

    public function authorize()
    {
        return true;
    }

    public function rules()
    {
        return [
            'avatar' => ['nullable', 'file'],
            'image' => ['nullable', 'file'],
        ];
    }
}
