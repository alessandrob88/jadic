<?php
declare(strict_types=1);
namespace Jadic\Test\Entities;

use Jadic\Entities\Container;
use PHPUnit\Framework\TestCase;
use Jadic\Test\Assets\Bar;
use Jadic\Test\Assets\Foo;

final class ContainerTest extends TestCase
{
    public function testHasFunctionWithUnexistingClass()
    {
        $container = new Container;
        $bar = $container->get(Bar::Class);
        $container->set(Foo::class, [$bar]);
        $this->assertFalse(!$container->has(Foo::class));
    }

    public function testHasFunctionWithExistingObject()
    {
        $container = new Container;
        $bar = $container->get(Bar::Class);
        $container->set(Foo::class, [$bar]);
        $this->assertTrue($container->has(Foo::class));
    }

    public function testSetFunction()
    {
        $container = new Container;
        $bar = $container->get(Bar::Class);
        $container->set(Foo::class, [$bar]);

        $this->assertTrue($container->has(Foo::class));
    }

    public function testGetFunction()
    {
        $container = new Container();
        $bar = $container->get(Bar::Class);
        $foo = $container->get(Foo::class, [$bar]);

        $this->assertInstanceOf(Foo::class, $foo);
    }
}

