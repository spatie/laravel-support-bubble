<div class="support-form-inner">
    <p class="spatie-support-form__error pb-4 text-red-600 hidden"></p>

    <form method="post" action="{{ route(config('support-form.form_action_route')) }}" class="flex flex-col gap-2">
        <label for="email">
            <input type="email" name="email" required placeholder="E-mail" value="{{ $email }}" class="input">
        </label>

        <label for="text">
            <textarea name="text" required class="input" placeholder="How can we help?"></textarea>
        </label>

        <button type="submit" class="button">Submit</button>
    </form>
</div>
