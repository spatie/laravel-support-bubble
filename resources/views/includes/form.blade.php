<form
    method="post"
    action="{{ route(config('support-bubble.form_action_route')) }}"
    class="flex flex-col gap-6 text-base"
>
    {!! __('support-bubble::support-bubble.intro') !!}

    <p class="spatie-support-bubble__error | text-red-600" style="display: none"></p>

    <x-honeypot/>

    <input type="hidden" name="url" value="{{ request()->url() }}">

    @if($hasField('name'))
        <x-support-bubble::input-field
            :label="__('support-bubble::support-bubble.name_label')"
            name="name"
            :value="$name"
            :hidden="! empty($name)"
        />
    @endif

    @if($hasField('email'))
        <x-support-bubble::input-field
            type="email"
            :label="__('support-bubble::support-bubble.email_label')"
            name="email"
            :value="$email"
            :hidden="! empty($email)"
        />
    @endif

    @if($hasField('subject'))
        <x-support-bubble::input-field
            :label="__('support-bubble::support-bubble.subject_label')"
            name="subject"
        />
    @endif

    @if($hasField('message'))
        <x-support-bubble::input-field
            type="textarea"
            :label="__('support-bubble::support-bubble.message_label')"
            name="message"
        />
    @endif

    <button type="submit" class="{{ config('support-bubble.classes.button') }}">{{ __('support-bubble::support-bubble.submit_label') }}</button>
</form>
