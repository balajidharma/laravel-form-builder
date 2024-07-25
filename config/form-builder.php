<?php

return [
    'default' => 'default',
    'forms' => [
        'default' => [

        ],
    ],
    'defaults' => [
        'wrapper_show' => true,
        'wrapper_class' => 'form-group',
        'wrapper_error_class' => 'has-error',
        'label_class' => 'control-label',
        'label_error_class' => '',
        'field_class' => 'form-control',
        'field_error_class' => '',
        'help_block_class' => 'help-block',
        'error_class' => 'text-danger',
        'required_class' => 'required',
        'help_block_tag' => 'p',
        // Templates
        'templates' => [
            'datalist' => 'laravel-form-builder::datalist',
            'form' => 'laravel-form-builder::form',
            'text' => 'laravel-form-builder::text',
            'textarea' => 'laravel-form-builder::textarea',
            'button' => 'laravel-form-builder::button',
            'buttongroup' => 'laravel-form-builder::buttongroup',
            'radio' => 'laravel-form-builder::radio',
            'radios' => 'laravel-form-builder::radios',
            'checkbox' => 'laravel-form-builder::checkbox',
            'checkboxes' => 'laravel-form-builder::checkboxes',
            'select' => 'laravel-form-builder::select',
            'repeated' => 'laravel-form-builder::repeated',
            'child_form' => 'laravel-form-builder::child_form',
            'collection' => 'laravel-form-builder::collection',
            'static' => 'laravel-form-builder::static',
        ],
    ],
];
