<?php
namespace Granam\Tests\Exceptions\Tools\DummyExceptionsHierarchy\WithSameNamedExternalParent;

interface Runtime extends Exception, \Granam\Tests\Exceptions\Tools\DummyExceptionsHierarchy\WithSameNamedParent\Children\IAmHereForWithSameNamedExternalParent\Runtime
{

}
