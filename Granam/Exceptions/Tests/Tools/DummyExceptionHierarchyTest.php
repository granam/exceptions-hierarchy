<?php
namespace Granam\Exceptions\Tests\Tools;

class DummyExceptionHierarchyTest extends AbstractTestOfExceptionsHierarchy
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

}
