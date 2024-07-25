<?php

namespace BalajiDharma\LaravelFormBuilder\Events;

use BalajiDharma\LaravelFormBuilder\Fields\FormField;
use BalajiDharma\LaravelFormBuilder\Form;

class AfterFieldCreation
{
    /**
     * The form instance.
     *
     * @var Form
     */
    protected $form;

    /**
     * The field instance.
     *
     * @var FormField
     */
    protected $field;

    /**
     * Create a new after field creation instance.
     *
     * @return void
     */
    public function __construct(Form $form, FormField $field)
    {
        $this->form = $form;
        $this->field = $field;
    }

    /**
     * Return the event's form.
     *
     * @return Form
     */
    public function getForm()
    {
        return $this->form;
    }

    /**
     * Return the event's field.
     *
     * @return FormField
     */
    public function getField()
    {
        return $this->field;
    }
}
