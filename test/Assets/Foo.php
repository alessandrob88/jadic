<?php
namespace Jadic\Test\Assets;

class Foo
{
    private $bar;

    public function __construct(Bar $bar)
    {
        $this->bar = $bar;
    }
}