<?php
namespace Granam\Tests\Exceptions\Tools\DummyExceptionsHierarchy\WithSameNamedNonParent;

interface Logic extends Exception, \Granam\Tests\Exceptions\Tools\DummyExceptionsHierarchy\Logic
{

}
