<?php

return [

    /*
     * Use this setting to enable the support form.
     */
    'enabled' => env('SUPPORT_FORM_ENABLED', true),

    /*
     * Route name
     */
    'form_action_route' => 'supportForm.submit',

    /*
     * Form submission rules
     */
    'rules' => [
        'email' => 'required|email',
        'text' => 'required',
    ],

    'prefill_email_from_request' => true,
];
