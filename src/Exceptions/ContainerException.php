<?php
namespace Jadic\Exceptions;

use Exception;
use Psr\Container\ContainerExceptionInterface;
use Throwable;

class ContainerException extends Exception implements ContainerExceptionInterface
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