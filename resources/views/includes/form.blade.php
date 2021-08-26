<div class="support-bubble-inner">
    <p class="pb-4">
        Contact Flare support for any questions, suggestions or bugs. We're available on all weekdays.
    </p>

    <p class="spatie-support-bubble__error pb-4 text-red-600" style="display: none"></p>

    <form method="post" action="{{ route(config('support-bubble.form_action_route')) }}"
          class="flex flex-col gap-3">
        <label for="name" class="{{ $name ? 'hidden' : '' }}">
            Your name
            <input type="text" name="name" id="name" required value="{{ $name }}" class="input">
        </label>

        <label for="email" class="{{ $email ? 'hidden' : '' }}">
            E-mail address
            <input type="email" name="email" id="email" required value="{{ $email }}" class="input">
        </label>

        <label for="subject">
            Subject
            <input type="text" name="subject" id="subject" required class="input">
        </label>

        <label for="message">
            How can we help?
            <textarea name="message" id="message" required class="input"></textarea>
        </label>

        <button type="submit" class="button">Submit</button>
    </form>
</div>
