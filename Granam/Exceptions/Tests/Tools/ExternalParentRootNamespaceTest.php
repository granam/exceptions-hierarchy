<?php
namespace Granam\Exceptions\Tests\Tools;

class ExternalParentRootNamespaceTest extends AbstractTestOfExceptionsHierarchy
{
    protected function getTestedNamespace()
    {
        return __NAMESPACE__ . '\DummyExceptionsHierarchy\ExternalParentRootNamespace';
    }

    protected function getRootNamespace()
    {
        return $this->getTestedNamespace();
    }

    protected function getExceptionsSubDir()
    {
        return '';
    }

    protected function getExternalParentRootNamespace()
    {
        // skipping some namespace chain up from root namespace
        return '\Granam\Exceptions';
    }

}
