<?php
namespace Granam\Exceptions\Tests\Tools;

class ExternalRuntimeTagMissingTest extends AbstractTestOfExceptionsHierarchy
{
    protected function getTestedNamespace()
    {
        return __NAMESPACE__ . '\DummyExceptionsHierarchy\ExternalRuntimeTagMissing';
    }

    protected function getRootNamespace()
    {
        return $this->getTestedNamespace();
    }

    protected function getExceptionsSubDir()
    {
        return '';
    }

    protected function getExternalRootNamespace()
    {
        // skipping some namespace chain up from root namespace
        return '\Granam\Exceptions';
    }

    protected function getExternalRootExceptionsSubDir()
    {
        return false;
    }

    /**
     * @test
     * @expectedException \Granam\Exceptions\Tools\Exceptions\InvalidTagInterfaceHierarchy
     * @expectedExceptionMessageRegExp ~^Tag interface .+\\Runtime should extends external parent tag interface .+~
     */
    public function My_exceptions_are_in_family_tree()
    {
        parent::My_exceptions_are_in_family_tree();
    }

}
