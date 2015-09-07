<?php
namespace Granam\Exceptions\Tests\Tools;

class ExternalParentTagTest extends AbstractTestOfExceptionsHierarchy
{
    protected function getTestedNamespace()
    {
        return __NAMESPACE__ . '\DummyExceptionsHierarchy\ExternalParentTag';
    }

    protected function getRootNamespace()
    {
        return $this->getTestedNamespace();
    }

    protected function getExceptionsSubDir()
    {
        return '';
    }

    protected function getExternalParentTag()
    {
        // skipping some namespace chain up from root namespace
        return \Granam\Exceptions\Exception::class;
    }

}
