<?php
namespace Jadic\Exceptions;

use Psr\Container\NotFoundExceptionInterface;
use \Exception;
use Throwable;

class NotFoundException extends Exception implements NotFoundExceptionInterface
{
    public function __construct($message = "", $code = 0, Throwable $previous = null)
    {
        parent::__construct($message, $code, $previous);
    }

    public function __toString()
    {
        return __CLASS__ . ": [{$this->code}]: {$this->message}\n";
    }
}