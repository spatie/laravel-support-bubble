<?php

return [

    /*
     * Use this setting to completely disable the support bubble.
     */

    'enabled' => env('SUPPORT_BUBBLE_ENABLED', true),

    /*
     * The default route and controller will be registered using this route name.
     * This is a good place to hook in your own route and controller if necessary.
     */
    'form_action_route' => 'supportBubble.submit',

    /*
     * Enable or disable fields in the support bubble.
     * Keep in mind that `name` and `email` will be hidden automatically
     * when a logged in user is detected and `prefill_logged_in_user` is set.
     */
    'fields' => [
        'name' => true,
        'email' => true,
        'subject' => true,
        'message' => true,
    ],

    /*
     * When set to true we'll use currently logged in user to fill in
     * the name and email fields. Both fields will also be hidden.
     */
    'prefill_logged_in_user' => true,

    /*
     * If configured, we'll set-up an event listener that will
     * send any chat bubble responses to this e-mail address.
     *
     * Default: null
     */
    'mail_to' => null,

    /*
     * We can try to impersonate the user that submitted the support form.
     * The mail sent to the `mail_to` address will appear as if it came
     * from the email address that was submitted in the support form.
     *
     * This is useful when sending mails directly to a support desk.
     */
    'impersonate_mail_from_user' => false,
];
