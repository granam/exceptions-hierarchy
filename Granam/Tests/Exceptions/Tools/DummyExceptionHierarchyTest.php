<?php
namespace Granam\Tests\Exceptions\Tools;

class DummyExceptionHierarchyTest extends AbstractExceptionsHierarchyTest
{
    /**
     * @return string
     */
    protected function getTestedNamespace()
    {
        return __NAMESPACE__ . '\\DummyExceptionsHierarchy';
    }

    /**
     * @return string
     */
    protected function getRootNamespace()
    {
        return $this->getTestedNamespace();
    }

    /**
     * @return false
     */
    protected function getExceptionsSubDir()
    {
        return false; // exceptions are directly in the tested namespace
    }

    /**
     * @return array|string[]
     */
    protected function getExceptionClassesSkippedFromUsageTest()
    {
        return [
            'Granam\Tests\Exceptions\Tools\DummyExceptionsHierarchy\IAmLogicException',
            'Granam\Tests\Exceptions\Tools\DummyExceptionsHierarchy\IAmRuntimeException',
        ];
    }
}
