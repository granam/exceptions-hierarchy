<?php
namespace Granam\Tests\Exceptions\Tools\DummyExceptionsHierarchy\BrokenLineage\RuntimeTagWithoutParent;

interface Runtime extends Exception /* missing parent Runtime here */
{

}
