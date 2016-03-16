<?php
namespace Granam\Tests\Exceptions\Tools;

class RuntimeTagWithoutBaseTagTest extends AbstractExceptionsHierarchyTest
{

    /**
     * @test
     * @expectedException \Granam\Exceptions\Tools\Exceptions\InvalidTagInterfaceHierarchy
     * @expectedExceptionMessageRegExp ~^Runtime tag interface .+ is not a child of .+\\Exception$$~
     */
    public function My_exceptions_are_in_family_tree()
    {
        parent::My_exceptions_are_in_family_tree();
    }

    protected function getTestedNamespace()
    {
        return __NAMESPACE__ . '\DummyExceptionsHierarchy\RuntimeTagWithoutBaseTag';
    }

    protected function getExceptionsSubDir()
    {
        return false;
    }

    protected function getRootNamespace()
    {
        return $this->getTestedNamespace();
    }

}
