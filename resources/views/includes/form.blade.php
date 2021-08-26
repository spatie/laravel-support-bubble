<div class="support-bubble-inner">
    <p class="pb-4">

    </p>

    <p class="spatie-support-bubble__error pb-4 text-red-600" style="display: none"></p>

    <form method="post" action="{{ route(config('support-bubble.form_action_route')) }}" class="flex flex-col gap-2">
        <label for="name" class="{{ $name ? 'hidden' : '' }}">
            <input type="text" name="name" required placeholder="Your name" value="{{ $name }}" class="input">
        </label>

        <label for="email" class="{{ $email ? 'hidden' : '' }}">
            <input type="email" name="email" required placeholder="E-mail" value="{{ $email }}" class="input">
        </label>

        <label for="subject">
            <input type="text" name="subject" required placeholder="Subject" class="input">
        </label>

        <label for="message">
            <textarea name="message" required class="input" placeholder="How can we help?"></textarea>
        </label>

        <button type="submit" class="button">Submit</button>
    </form>
</div>
