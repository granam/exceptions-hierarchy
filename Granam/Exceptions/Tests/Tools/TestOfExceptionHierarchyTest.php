<?php
namespace Granam\Exceptions\Tests\Tools;

class TestOfExceptionHierarchyTest extends AbstractTestOfExceptionsHierarchy
{
    /**
     * @return string
     */
    protected function getTestedNamespace()
    {
        return 'Granam';
    }

    /**
     * @return string
     */
    protected function getRootNamespace()
    {
        return $this->getTestedNamespace();
    }

    protected function getExceptionsSubDir()
    {
        return 'Exceptions';
    }

}
