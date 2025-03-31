<?php

namespace Spatie\SupportBubble\Http\Controllers;

use Illuminate\Http\Request;

class HandleSupportBubbleAttachmentController
{
    public function __invoke(Request $request)
    {
        $request->validate([
            'attachment' => ['required'],
        ]);

        return [
            'key' => $request->file('attachment')->store('support-bubble-attachments', $this->getDisk()),
            'name' => $request->file('attachment')->getClientOriginalName(),
        ];
    }

    protected function getDisk(): string
    {
        if (config('support-bubble.attachment_disk')) {
            return config('support-bubble.attachment_disk');
        }

        return config('filesystems.default');
    }
}
