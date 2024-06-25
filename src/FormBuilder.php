<?php

namespace BalajiDharma\LaravelFormBuilder;

class FormBuilder
{
    public function create($formClass, array $options = [], array $data = [])
    {
        $form = new $formClass($options, $data);

        $form->buildForm();

        return $form;
    }
}
