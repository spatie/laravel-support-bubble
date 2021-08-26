<form
    method="post"
    action="{{ route(config('support-bubble.form_action_route')) }}"
    class="flex flex-col gap-4"
>
    <p class="text-base">
        Contact Flare support for any questions, suggestions or bugs.<br/>We're available on all weekdays.
    </p>

    <p class="spatie-support-bubble__error | text-red-600" style="display: none"></p>

    <x-honeypot />

    @if($hasField('name'))
        <label for="support-bubble-name" class="font-medium {{ $name ? 'hidden' : '' }}">
            Your name
            <input type="text" name="name" id="support-bubble-name" required value="{{ $name }}" class="input text-base">
        </label>
    @endif

    @if($hasField('email'))
        <label for="support-bubble-email" class="font-medium {{ $email ? 'hidden' : '' }}">
            E-mail address
            <input type="email" name="email" id="support-bubble-email" required value="{{ $email }}"
                   class="input text-base">
        </label>
    @endif

    @if($hasField('subject'))
    <label for="support-bubble-subject" class="font-medium">
        Subject
        <input type="text" name="subject" id="support-bubble-subject" required class="input text-base">
    </label>
    @endif

    @if($hasField('message'))
        <label for="support-bubble-message" class="font-medium">
            How can we help?
            <textarea name="message" id="support-bubble-message" rows="4" required class="input text-base"></textarea>
        </label>
    @endif

    <button type="submit" class="button">Submit</button>
</form>
