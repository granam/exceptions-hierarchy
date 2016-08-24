<?php
namespace Granam\Tests\Exceptions\Tools;

class WithSameNamedNonParentExceptionHierarchyTest extends AbstractExceptionsHierarchyTest
{
    /**
     * @return string
     */
    protected function getTestedNamespace()
    {
        return $this->getRootNamespace() . '\\WithSameNamedNonParent\\Children';
    }

    /**
     * @return string
     */
    protected function getRootNamespace()
    {
        return __NAMESPACE__ . '\\DummyExceptionsHierarchy';
    }

    /**
     * @return false
     */
    protected function getExceptionsSubDir()
    {
        return false; // exceptions are directly in the tested namespace
    }

    /**
     * @test
     * @expectedException \Granam\Exceptions\Tools\Exceptions\InvalidExceptionHierarchy
     * @expectedExceptionMessageRegExp ~^Exception .+\\WithSameNamedNonParent\\Children\\IAmSameNamedButNotFromFamily should extends parent .+\\WithSameNamedNonParent\\IAmSameNamedButNotFromFamily~
     */
    public function My_exceptions_are_in_family_tree()
    {
        // overloading parent method annotations
        parent::My_exceptions_are_in_family_tree();
    }

    protected function getExceptionClassesSkippedFromUsageTest()
    {
        return array(
            'Granam\Tests\Exceptions\Tools\DummyExceptionsHierarchy\WithSameNamedNonParent\Children\IAmSameNamedButNotFromFamily',
            'Granam\Tests\Exceptions\Tools\DummyExceptionsHierarchy\WithSameNamedNonParent\IAmSameNamedButNotFromFamily',
            'Granam\Tests\Exceptions\Tools\DummyExceptionsHierarchy\IAmLogicException',
            'Granam\Tests\Exceptions\Tools\DummyExceptionsHierarchy\IAmRuntimeException',
        );
    }

}
