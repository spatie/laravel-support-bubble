<div class="spatie-support-bubble | pointer-events-none fixed bottom-0 {{ $direction === 'right-to-left' ? 'left-0' : 'right-0' }} {{ config('support-bubble.classes.container') }}"
     style="max-width: 340px; display: none;">
    <div class="spatie-support-bubble__container | pointer-events-auto bg-white shadow-xl border border-gray-300 rounded p-6 transition transform {{ $direction === 'right-to-left' ? '-translate-x-full' : 'translate-x-full' }} opacity-0">
        <div class="spatie-support-bubble__form">
            @include('support-bubble::includes.form')
        </div>

        <div class="spatie-support-bubble__response" style="display: none">
        </div>
    </div>

    <div class="spatie-support-bubble__button | pointer-events-auto">
        @include('support-bubble::includes.bubble')
    </div>
</div>

@once
    @include('support-bubble::includes.script')
@endonce
