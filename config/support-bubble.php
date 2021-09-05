<?php

return [
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
     * We'll send any chat bubble responses to this e-mail address.
     *
     * Set this to
     */
    'mail_to' => null,

    /*
     * The TailwindCSS classes used on a couple of key components.
     *
     * To customize the components further, you can publish
     * the views of this package.
     */
    'classes' => [
        'bubble' => 'hidden sm:block | bg-purple-400 rounded-full shadow-lg w-14 h-14 text-white p-4',
        'input' => 'bg-gray-100 border border-gray-200 w-full max-w-full p-2 rounded-sm shadow-input text-gray-800 text-base',
        'button' => 'inline-flex place-center px-4 py-3 h-10 border-0 bg-purple-500 hover:bg-purple-600 active:bg-purple-600 overflow-hidden rounded-sm text-white leading-none no-underline',
    ],

    /**
     * The positioning of the bubble and the form, change this between rtl and ltr, if you want to use RTL, you must have your layout set to RTL like this 
     * <html lang="ar-TN" dir="rtl">
     * By default, the value of this is LTR
     */
    'direction' => 'rtl'
];
