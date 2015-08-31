<?php
namespace Granam\Exceptions\Tests\Tools\DummyExceptionsHierarchy\BrokenLineage\RuntimeTagWithoutParent;

interface Runtime extends Exception /* missing parent Runtime here */
{

}
