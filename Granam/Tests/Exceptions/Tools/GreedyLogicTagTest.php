<?php
namespace Granam\Tests\Exceptions\Tools;

class GreedyLogicTagTest extends AbstractExceptionsHierarchyTest
{

    /**
     * @test
     * @expectedException \Granam\Exceptions\Tools\Exceptions\InvalidTagInterfaceHierarchy
     * @expectedExceptionMessageRegExp ~Logic tag interface .+\\Logic can not be a runtime tag~
     */
    public function My_exceptions_are_in_family_tree()
    {
        parent::My_exceptions_are_in_family_tree();
    }

    protected function getTestedNamespace()
    {
        return __NAMESPACE__ . '\DummyExceptionsHierarchy\GreedyLogicTag';
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
