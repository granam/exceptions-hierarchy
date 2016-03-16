<?php
namespace Granam\Tests\Exceptions\Tools;

class RuntimeExceptionAsLogicExceptionTest extends AbstractExceptionsHierarchyTest
{
    /**
     * @test
     * @expectedException \Granam\Exceptions\Tools\Exceptions\InvalidExceptionHierarchy
     * @expectedExceptionMessageRegExp ~should be child of \\LogicException$~
     */
    public function My_exceptions_are_in_family_tree()
    {
        parent::My_exceptions_are_in_family_tree();
    }

    protected function getTestedNamespace()
    {
        return __NAMESPACE__ . '\DummyExceptionsHierarchy\RuntimeExceptionAsLogicException';
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
