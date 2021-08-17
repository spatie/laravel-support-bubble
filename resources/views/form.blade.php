<div class="support-form-form">
    <form method="post" action="{{ route('supportForm.submit') }}">
        @csrf

        <div>
            <label for="email"></label>
            <input type="email" name="email">
        </div>

        <div>
            <label for="text"></label>
            <textarea name="text"></textarea>
        </div>

        <button type="submit">Submit</button>
    </form>
</div>
