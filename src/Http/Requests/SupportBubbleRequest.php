<?php

namespace Spatie\SupportBubble\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;

class SupportBubbleRequest extends FormRequest
{
    public function rules()
    {
        return [
            'name' => Rule::requiredIf(config('support-bubble.fields.name')),
            'email' => [
                'email',
                Rule::requiredIf(config('support-bubble.fields.email')),
            ],
            'subject' => Rule::requiredIf(config('support-bubble.fields.subject')),
            'message' => Rule::requiredIf(config('support-bubble.fields.message')),
            'url' => ['required', 'url'],
        ];
    }
}
