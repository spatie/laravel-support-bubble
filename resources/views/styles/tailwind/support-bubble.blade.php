@php
    $position = $positionY === 'bottom' ? 'bottom-0 ' : 'top-0 ';
    $position .= $positionX === 'right' ? 'right-0 items-end ' : 'left-0';
@endphp

<div class="spatie-support-form fixed {{$position}} z-10 flex flex-col m-4 gap-3">
    <div class="spatie-support-form__container bg-white w-64 shadow-xl border border-gray-300 rounded p-2" style="display: none">
        <div class="spatie-support-form__form">
            @include('support-form::styles.tailwind.includes.form')
        </div>

        <div class="spatie-support-form__response" style="display: none">
        </div>
    </div>

    <div class="spatie-support-form__button">
        @include('support-form::styles.tailwind.includes.button')
    </div>
</div>

@include('support-form::includes.script')
