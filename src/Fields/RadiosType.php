<?php

namespace BalajiDharma\LaravelFormBuilder\Fields;

class RadiosType extends FormField
{
    protected $valueProperty = 'selected';

    protected function getTemplate()
    {
        return 'radios';
    }

    public function getDefaults()
    {
        return [
            'choices' => [],
            'option_attributes' => [],
            'selected' => null,
        ];
    }
}
