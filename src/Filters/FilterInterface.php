<?php

namespace BalajiDharma\LaravelFormBuilder\Filters;

/**
 * Interface FilterInterface
 *
 * @author  Djordje Stojiljkovic <djordjestojilljkovic@gmail.com>
 */
interface FilterInterface
{
    /**
     * Returns the result of filtering $value.
     *
     * @param  mixed  $value
     * @param  array  $options
     * @return mixed
     *
     * @throws \Exception If filtering $value is impossible.
     */
    public function filter($value, $options = []);

    /**
     * Returns the filter name so we can use this as alias for easily
     * removing, adding filters.
     *
     * @return string
     */
    public function getName();
}
