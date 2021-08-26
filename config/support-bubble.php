<?php

return [

    /*
     * Use this setting to enable the support form.
     */
    'enabled' => env('SUPPORT_FORM_ENABLED', true),

    /*
     * Route name
     */
    'form_action_route' => 'SupportBubble.submit',

    /*
     * Form submission rules
     */
    'rules' => [
        'name' => 'required',
        'email' => 'required|email',
        'subject' => 'required',
        'message' => 'required',
    ],

    'prefill_logged_in_user' => true,

    /*
     * If configured we'll set-up an event listener for you that
     * will e-mail any chat bubble responses to this address.
     */
    'mail_to' => null,
];
