<div class="support-form-inner">
    <form method="post" action="{{ route(config('support-form.form_action_route')) }}">
        <div>
            <label for="email"></label>
            <input type="email" name="email" value="yo@lkolc.om">
        </div>

        <div>
            <label for="text"></label>
            <textarea name="text">test</textarea>
        </div>

        <button type="submit">Submit</button>
    </form>
</div>
