<?php
namespace Granam\Tests\Exceptions\Tools\DummyExceptionsHierarchy\WithSameNamedExternalNonParent;

interface Runtime extends Exception, \Granam\Tests\Exceptions\Tools\DummyExceptionsHierarchy\WithSameNamedParent\Runtime
{

}
