<?php
namespace Granam\Tests\Exceptions\Tools;

class WithSameNamedParentExceptionHierarchyTest extends AbstractExceptionsHierarchyTest
{
    /**
     * @return string
     */
    protected function getTestedNamespace()
    {
        return $this->getRootNamespace() . '\\WithSameNamedParent\\Children';
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

    protected function getExceptionClassesSkippedFromUsageTest()
    {
        return [
            'Granam\Tests\Exceptions\Tools\DummyExceptionsHierarchy\WithSameNamedParent\Children\IAmSameNamed',
            'Granam\Tests\Exceptions\Tools\DummyExceptionsHierarchy\WithSameNamedParent\IAmSameNamed',
            'Granam\Tests\Exceptions\Tools\DummyExceptionsHierarchy\IAmLogicException',
            'Granam\Tests\Exceptions\Tools\DummyExceptionsHierarchy\IAmRuntimeException',
        ];
    }

}