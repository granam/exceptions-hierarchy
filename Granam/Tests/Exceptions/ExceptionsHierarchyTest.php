<?php
namespace Granam\Tests\Exceptions;

class ExceptionsHierarchyTest extends \Granam\Tests\Exceptions\Tools\ExceptionsHierarchyTest
{
    protected function getTestedNamespace()
    {
        return $this->getRootNamespace();
    }

    protected function getRootNamespace()
    {
        return str_replace('\Tests\\', '\\', __NAMESPACE__);
    }

    protected function getExceptionsSubDir()
    {
        return ''; // no sub-dir for exceptions (its already part of the root namespace)
    }
}
