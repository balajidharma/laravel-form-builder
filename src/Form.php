<?php

namespace BalajiDharma\LaravelFormBuilder;

class Form
{
    /**
     * All fields that are added.
     *
     * @var array
     */
    protected $fields = [];

    /**
     * Model to use.
     *
     * @var mixed
     */
    protected $model = [];

    /**
     * Form options.
     *
     * @var array
     */
    protected $formOptions = [
        'method' => 'GET',
        'url' => null,
        'attr' => [],
    ];

    public function add($name, $type, $options = [])
    {
        $this->fields[$name] = compact('name', 'type', 'options');
        return $this;
    }
}