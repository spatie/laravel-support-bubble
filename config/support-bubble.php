<?php

return [

    /*
     * Use this setting to enable the support form.
     */
    'enabled' => env('SUPPORT_BUBBLE_ENABLED', true),

    /*
     * Route name
     */
    'form_action_route' => 'supportBubble.submit',

    'fields' => [
        'name' => true,
        'email' => true,
        'subject' => true,
        'message' => true,
    ],

    'prefill_logged_in_user' => true,

    /*
     * If configured we'll set-up an event listener for you that
     * will e-mail any chat bubble responses to this address.
     */
    'mail_to' => null,

    /*
     * A mail will be sent to `mail_to` as if it was sent by the
     * user details submitted in the support bubble.
     *
     * This is useful for sending mails directly to a support desk.
     */
    'impersonate_mail_from_user' => false,
];
