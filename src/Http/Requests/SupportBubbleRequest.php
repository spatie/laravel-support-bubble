<?php

namespace Spatie\SupportBubble\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class SupportBubbleRequest extends FormRequest
{
    public function rules()
    {
        return [
            'name' => config('support-bubble.fields.name') ? 'required' : '',
            'email' => [
                'email',
                config('support-bubble.fields.email') ? 'required' : '',
            ],
            'subject' => config('support-bubble.fields.subject') ? 'required' : '',
            'message' => config('support-bubble.fields.message') ? 'required' : '',
        ];
    }
}
