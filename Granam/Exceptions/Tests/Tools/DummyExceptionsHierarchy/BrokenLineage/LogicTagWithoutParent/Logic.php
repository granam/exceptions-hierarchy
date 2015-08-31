<?php
namespace Granam\Exceptions\Tests\Tools\DummyExceptionsHierarchy\BrokenLineage\LogicTagWithoutParent;

interface Logic extends Exception /* missing parent Logic here */
{

}
