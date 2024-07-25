<?php

namespace BalajiDharma\LaravelFormBuilder\Fields;

class DatalistType extends FormField
{
    protected function getTemplate()
    {
        return 'datalist';
    }

    public function getAllAttributes()
    {
        return [];
    }
}
