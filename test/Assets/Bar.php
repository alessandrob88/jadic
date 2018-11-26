<?php
namespace Jadic\Test\Assets;

class Bar
{
    private $a;
    private $c;

    public function __construct($a = 0, $c = -1)
    {
        $this->a = $a;
        $this->c = $c;
    }
}