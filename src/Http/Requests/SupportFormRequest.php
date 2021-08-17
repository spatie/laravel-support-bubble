<?php

namespace Spatie\SupportForm\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class SupportFormRequest extends FormRequest
{
    public function rules()
    {
        return [
            'email' => 'required|email',
            'text' => 'required',
        ];
    }
}