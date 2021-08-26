@php
    $position = $positionY === 'bottom' ? 'bottom-0 ' : 'top-0 ';
    $position .= $positionX === 'right' ? 'right-0 items-end ' : 'left-0';
@endphp

<div class="spatie-support-bubble fixed {{$position}} z-10 flex-col m-4 gap-3" style="max-width: 300px; display: none;">
    <div class="spatie-support-bubble__container bg-white shadow-xl border border-gray-300 rounded p-4" style="display: none">
        <div class="spatie-support-bubble__form">
            @include('support-bubble::includes.form', compact('email'))
        </div>

        <div class="spatie-support-bubble__response" style="display: none">
        </div>
    </div>

    <div class="spatie-support-bubble__button">
        @include('support-bubble::includes.button')
    </div>
</div>

@include('support-bubble::includes.script')
