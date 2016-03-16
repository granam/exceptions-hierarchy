<?php
namespace Granam\Tests\Exceptions\Tools\DummyExceptionsHierarchy\WithSameNamedExternalParent;

/**
 * This class intentionally skips IAmHereForWithSameNamedExternalParent namespace part,
 * @see \Granam\Tests\Exceptions\Tools\DummyExceptionsHierarchy\WithSameNamedExternalParent\Exception for who not
 */
class IAmSameNamed extends \Granam\Tests\Exceptions\Tools\DummyExceptionsHierarchy\WithSameNamedParent\Children\IAmSameNamed
    implements Logic
{

}
