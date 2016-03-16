<?php
namespace Granam\Tests\Exceptions\Tools;

class GreedyRuntimeTagTest extends AbstractExceptionsHierarchyTest
{

    /**
     * @test
     * @expectedException \Granam\Exceptions\Tools\Exceptions\InvalidTagInterfaceHierarchy
     * @expectedExceptionMessageRegExp ~Runtime tag interface .+\\Runtime can not be a logic tag~
     */
    public function My_exceptions_are_in_family_tree()
    {
        parent::My_exceptions_are_in_family_tree();
    }

    protected function getTestedNamespace()
    {
        return __NAMESPACE__ . '\DummyExceptionsHierarchy\GreedyRuntimeTag';
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
