<?php
namespace Granam\Tests\Exceptions\Tools\DummyExceptionsHierarchy\WithSameNamedExternalParent;

interface Logic extends Exception, \Granam\Tests\Exceptions\Tools\DummyExceptionsHierarchy\WithSameNamedParent\Children\IAmHereForWithSameNamedExternalParent\Logic
{

}
