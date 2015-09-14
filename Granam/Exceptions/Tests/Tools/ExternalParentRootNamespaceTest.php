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
        return false;
    }

    protected function getExternalRootNamespaces()
    {
        // skipping some namespace chain up from root namespace
        return array('\Granam');
    }

}
