<?php
namespace Granam\Exceptions\Tests\Tools;

class LogicExceptionAsRuntimeExceptionTest extends AbstractTestOfExceptionsHierarchy
{
    /**
     * @test
     * @expectedException \Granam\Exceptions\Tools\Exceptions\InvalidExceptionHierarchy
     * @expectedExceptionMessageRegExp ~should be child of \\RuntimeException$~
     */
    public function My_exceptions_are_in_family_tree()
    {
        parent::My_exceptions_are_in_family_tree();
    }

    protected function getTestedNamespace()
    {
        return __NAMESPACE__ . '\DummyExceptionsHierarchy\LogicExceptionAsRuntimeException';
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
