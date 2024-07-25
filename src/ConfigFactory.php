<?php

namespace BalajiDharma\LaravelFormBuilder;

use BalajiDharma\LaravelFormBuilder\Exceptions\FormBuilderException;

class ConfigFactory
{
    /**
     * Get documentation config.
     *
     * @param  string|null  $documentation
     *
     * @throws FormBuilderException
     */
    public function formConfig(?string $form = null): array
    {
        if ($form === null) {
            $form = config('form-builder.default');
        }

        $defaults = config('form-builder.defaults', []);
        $forms = config('form-builder.forms', []);

        if (! isset($forms[$form])) {
            throw new FormBuilderException('Form builder config not found');
        }

        return $this->mergeConfig($defaults, $forms[$form]);
    }

    private function mergeConfig(array $defaults, array $config): array
    {
        $merged = $defaults;

        foreach ($config as $key => &$value) {
            if (isset($defaults[$key])
                && $this->isAssociativeArray($defaults[$key])
                && $this->isAssociativeArray($value)
            ) {
                $merged[$key] = $this->mergeConfig($defaults[$key], $value);

                continue;
            }

            $merged[$key] = $value;
        }

        return $merged;
    }

    private function isAssociativeArray($value): bool
    {
        return is_array($value) && count(array_filter(array_keys($value), 'is_string')) > 0;
    }
}
