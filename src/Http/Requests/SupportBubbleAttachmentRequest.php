<?php

namespace Spatie\SupportBubble\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;
use Illuminate\Validation\Rules\File;

class SupportBubbleAttachmentRequest extends FormRequest
{
    public function rules()
    {
        return [
            'attachment' => ['required'],
        ];
    }
}
