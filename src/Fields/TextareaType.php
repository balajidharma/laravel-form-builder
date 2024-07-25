<?php

namespace BalajiDharma\LaravelFormBuilder\Fields;

class TextareaType extends FormField
{
    /**
     * {@inheritdoc}
     */
    protected function getTemplate()
    {
        return 'textarea';
    }
}
