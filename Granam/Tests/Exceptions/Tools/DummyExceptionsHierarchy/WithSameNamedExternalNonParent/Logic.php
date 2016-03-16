<?php
namespace Granam\Tests\Exceptions\Tools\DummyExceptionsHierarchy\WithSameNamedExternalNonParent;

interface Logic extends Exception, \Granam\Tests\Exceptions\Tools\DummyExceptionsHierarchy\WithSameNamedParent\Logic
{

}
