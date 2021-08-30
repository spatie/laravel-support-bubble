<div class="spatie-support-bubble | text-base fixed bottom-0 right-0 items-end z-10 flex-col m-4 gap-3" style="max-width: 340px; display: none;">
    <div class="spatie-support-bubble__container | bg-white shadow-xl border border-gray-300 rounded p-6 transition transform translate-x-full opacity-0">
        <div class="spatie-support-bubble__form">
            @include('support-bubble::includes.form')
        </div>

        <div class="spatie-support-bubble__response" style="display: none">
        </div>
    </div>

    <div class="spatie-support-bubble__button">
        @include('support-bubble::includes.bubble')
    </div>
</div>

@once
    @include('support-bubble::includes.script')
@endonce
