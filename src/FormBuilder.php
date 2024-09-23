<?php

namespace BalajiDharma\LaravelFormBuilder;

use BalajiDharma\LaravelFormBuilder\Events\AfterFormCreation;
use Illuminate\Contracts\Container\Container;
use Illuminate\Contracts\Events\Dispatcher as EventDispatcher;

class FormBuilder
{
    /**
     * @var Container
     */
    protected $container;

    /**
     * @var FormHelper
     */
    protected $formHelper;

    /**
     * @var EventDispatcher
     */
    protected $eventDispatcher;

    /**
     * @param  Container  $container
     *
     * @var string
     */
    protected $plainFormClass = Form::class;

    public function __construct(Container $container, FormHelper $formHelper, EventDispatcher $eventDispatcher)
    {
        $this->container = $container;
        $this->formHelper = $formHelper;
        $this->eventDispatcher = $eventDispatcher;
    }

    /**
     * Fire an event.
     *
     * @param  object  $event
     * @return array|null
     */
    public function fireEvent($event)
    {
        return $this->eventDispatcher->dispatch($event);
    }

    /**
     * Create a Form instance.
     *
     * @param  string  $formClass  The name of the class that inherits \BalajiDharma\LaravelFormBuilder\Form.
     * @return Form
     */
    public function create($formClass, array $options = [], array $data = [])
    {
        $class = $this->getNamespaceFromConfig().$formClass;

        if (! class_exists($class)) {
            throw new \InvalidArgumentException(
                'Form class with name '.$class.' does not exist.'
            );
        }

        $form = $this->setDependenciesAndOptions($this->container->make($class), $options, $data);

        $form->getAppendage($form->getMethod());

        $form->buildForm();

        $this->eventDispatcher->dispatch(new AfterFormCreation($form));

        $form->filterFields();

        return $form;
    }

    /**
     * @return mixed
     */
    public function createByArray($items, array $options = [], array $data = [])
    {
        $form = $this->setDependenciesAndOptions(
            $this->container->make($this->plainFormClass),
            $options,
            $data
        );

        $this->buildFormByArray($form, $items);

        $this->eventDispatcher->dispatch(new AfterFormCreation($form));

        $form->filterFields();

        return $form;
    }

    public function buildFormByArray($form, $items)
    {
        foreach ($items as $item) {
            if (! isset($item['name'])) {
                throw new \InvalidArgumentException(
                    'Name is not set in form array.'
                );
            }
            $name = $item['name'];
            $type = isset($item['type']) && $item['type'] ? $item['type'] : '';
            $modify = isset($item['modify']) && $item['modify'] ? $item['modify'] : false;
            unset($item['name']);
            unset($item['type']);
            unset($item['modify']);
            $form->add($name, $type, $item, $modify);
        }
    }

    /**
     * Get the namespace from the config
     *
     * @return string
     */
    protected function getNamespaceFromConfig()
    {
        $namespace = $this->formHelper->getConfig('default_namespace');

        if (! $namespace) {
            return '';
        }

        return $namespace.'\\';
    }

    /**
     * Get instance of the empty form which can be modified
     * Get the plain form class.
     *
     * @return string
     */
    public function getFormClass()
    {
        return $this->plainFormClass;
    }

    /**
     * Set the plain form class.
     *
     * @param  string  $class
     */
    public function setFormClass($class)
    {
        $parent = Form::class;
        if (! is_a($class, $parent, true)) {
            throw new \InvalidArgumentException("Class must be or extend $parent; $class is not.");
        }

        $this->plainFormClass = $class;
    }

    /**
     * Get instance of the empty form which can be modified.
     *
     * @return \BalajiDharma\LaravelFormBuilder\Form
     */
    public function plain(array $options = [], array $data = [])
    {
        $form = $this->setDependenciesAndOptions(
            $this->container->make($this->plainFormClass),
            $options,
            $data
        );

        $form->getAppendage($form->getMethod());

        $this->eventDispatcher->dispatch(new AfterFormCreation($form));

        $form->filterFields();

        return $form;
    }

    /**
     * Set depedencies and options on existing form instance
     *
     * @param  \BalajiDharma\LaravelFormBuilder\Form  $instance
     * @return \BalajiDharma\LaravelFormBuilder\Form
     */
    public function setDependenciesAndOptions($instance, array $options = [], array $data = [])
    {
        return $instance
            ->setData($data)
            ->setRequest($this->container->make('request'))
            ->setFormHelper($this->formHelper)
            ->setEventDispatcher($this->eventDispatcher)
            ->setFormBuilder($this)
            ->setValidator($this->container->make('validator'))
            ->setFormOptions($options);
    }
}
