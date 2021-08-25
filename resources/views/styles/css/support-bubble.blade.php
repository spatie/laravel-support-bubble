@php
    $position = $positionY === 'bottom' ? 'bottom: 0; ' : 'top: 0; ';
    $position .= $positionX === 'right' ? 'right: 0; align-items: flex-end; ' : 'left: 0;';
@endphp

<div class="spatie-support-form"
     style="position: fixed; {{ $position }} z-index: 10; display: flex; flex-direction: column;">
    <div class="spatie-support-form__container" style="display: none; width: 300px; background: white;">
        <div class="spatie-support-form__form" style="display: flex">
            @include('support-form::style.css.includes.form')
        </div>

        <div class="spatie-support-form__response" style="display: none">
        </div>
    </div>

    <div class="spatie-support-form__button">
        @include('support-form::style.css.includes.button')
    </div>
</div>

@include('support-form::includes.script')
