<form
    method="post"
    action="{{ route(config('support-bubble.form_action_route')) }}"
    class="flex flex-col gap-4"
>
    <p class="text-base">{!! __('support-bubble::support-bubble.intro') !!}</p>

    <p class="spatie-support-bubble__error | text-red-600" style="display: none"></p>

    <x-honeypot />

    <input type="hidden" name="url" value="{{ request()->url() }}">

    @if($hasField('name'))
        <label for="support-bubble-name" class="font-medium {{ $name ? 'hidden' : '' }}">
            {!! __('support-bubble::support-bubble.name_label') !!}
            <input type="text" name="name" id="support-bubble-name" required value="{{ $name }}" class="input text-base">
        </label>
    @endif

    @if($hasField('email'))
        <label for="support-bubble-email" class="font-medium {{ $email ? 'hidden' : '' }}">
            {!! __('support-bubble::support-bubble.email_label') !!}
            <input type="email" name="email" id="support-bubble-email" required value="{{ $email }}"
                   class="input text-base">
        </label>
    @endif

    @if($hasField('subject'))
    <label for="support-bubble-subject" class="font-medium">
        {!! __('support-bubble::support-bubble.subject_label') !!}
        <input type="text" name="subject" id="support-bubble-subject" required class="input text-base">
    </label>
    @endif

    @if($hasField('message'))
        <label for="support-bubble-message" class="font-medium">
            {!! __('support-bubble::support-bubble.message_label') !!}
            <textarea name="message" id="support-bubble-message" rows="4" required class="input text-base"></textarea>
        </label>
    @endif

    <button type="submit" class="button">Submit</button>
</form>
