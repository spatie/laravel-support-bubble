@php
$inputClasses = config('support-bubble.classes.input');
@endphp

<label for="support-bubble-{{ $name }}" class="font-medium text-sm {{ $hidden ?? false ? 'hidden' : '' }}">
    {!! $label !!}

    <input type="hidden" name="attachment_key">
    <input type="hidden" name="attachment_name">

    <input
        type="file"
        name="{{ $name }}"
        id="support-bubble-{{ $name }}"
        value="{{ $value ?? '' }}"
        class="{{ $inputClasses }}"
    >
</label>
