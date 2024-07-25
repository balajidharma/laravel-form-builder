<?php

namespace BalajiDharma\LaravelFormBuilder\Filters\Exception;

use BalajiDharma\LaravelFormBuilder\Filters\FilterInterface;
use Throwable;

/**
 * Class InvalidInstanceException
 *
 * @author  Djordje Stojiljkovic <djordjestojilljkovic@gmail.com>
 */
class InvalidInstanceException extends \Exception
{
    public function __construct($message = '', $code = 0, ?Throwable $previous = null)
    {
        $message = 'Filter object must implement '.FilterInterface::class;
        parent::__construct($message, $code, $previous);
    }
}
