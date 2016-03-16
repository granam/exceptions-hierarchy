<?php
namespace Granam\Tests\Exceptions\Tools;

class GreedyExceptionTest extends AbstractExceptionsHierarchyTest
{

    /**
     * @test
     * @expectedException \Granam\Exceptions\Tools\Exceptions\ExceptionIsNotTaggedProperly
     * @expectedExceptionMessageRegExp ~ can not be tagged by Runtime interface and Logic interface at the same time$~
     */
    public function My_exceptions_are_in_family_tree()
    {
        parent::My_exceptions_are_in_family_tree();
    }

    protected function getTestedNamespace()
    {
        return __NAMESPACE__ . '\DummyExceptionsHierarchy\GreedyException';
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
