<?php
namespace Jadic\Entities;

use Jadic\Exceptions\ContainerException;
use Jadic\Exceptions\NotFoundException;
use Psr\Container\ContainerInterface;
use ReflectionClass;

/**
 * Class Container
 * @package Jadic\Entities\Container
 * Main class of Jadic Container Library
 */
class Container implements ContainerInterface
{
    private $instances = array();

    /**
     * Finds an entry of the container by its identifier and returns it.
     *
     * @param string $className Identifier of the entry to look for.
     * @param array $arguments arguments of searched class
     *
     * @return mixed class object.
     *
     * @throws ContainerException
     * @throws NotFoundException
     * @throws \ReflectionException
     */
    public function get($className, $arguments = null)
    {
        if($this->has($className)){
            return $this->instances[$className];
        }

        $this->instances[$className] = $this->resolve($className, $arguments);

        return $this->instances[$className];
    }

    /**
     * Returns true if the container can return an entry for the given identifier.
     * Returns false otherwise.
     *
     * @param string $className Identifier of the entry to look for.
     *
     * @return bool
     */
    public function has($className)
    {
        if(isset($this->instances[$className]))
        {
            return true;
        }

        return false;
    }

    /**
     * Set a dependency only if it's not already set
     *
     * @param string $className
     * @param array $arguments
     *
     * @throws ContainerException
     * @throws NotFoundException
     * @throws \ReflectionException
     */
    public function set($className, $arguments = null)
    {
        if(!$this->has($className))
        {
            $this->instances[$className] = $this->resolve($className, $arguments);
        }
    }

    /**
     * Get class instance
     *
     * @param string $className name of the class
     * @param array $arguments optional class parameters
     *
     * @return object a class instance
     *
     * @throws ContainerException
     * @throws NotFoundException
     * @throws \ReflectionException
     */
    private function resolve($className, $arguments = null)
    {
        if(!class_exists($className)){
            throw new NotFoundException("Class {$className} is not found");
        }

        $reflectionObj = new ReflectionClass($className);

        if (!$reflectionObj->isInstantiable()) {
            throw new ContainerException("Class {$className} is not instantiable");
        }

        // creating an instance of the class
        if($arguments !== null || count($arguments) > 0)
        {
            if(!is_array($arguments))
            {
                $arguments = array($arguments);
            }
            $obj = $reflectionObj->newInstanceArgs($arguments);
        }
        else
        {
            $obj = new $className;
        }

        return $obj;
    }
}