<?php
namespace Granam\Tests\Exceptions\Tools\DummyExceptionsHierarchy\BrokenLineage\LogicTagWithoutParent;

interface Logic extends Exception /* missing parent Logic here */
{

}
