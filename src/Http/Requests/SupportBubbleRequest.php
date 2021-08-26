<?php

namespace Spatie\SupportBubble\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class SupportBubbleRequest extends FormRequest
{
    public function rules()
    {
        return config('support-bubble.rules');
    }
}
