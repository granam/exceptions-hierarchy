<?php
namespace Granam\Tests\Exceptions\Tools;

class TestOfExceptionHierarchyTest extends AbstractExceptionsHierarchyTest
{
    /**
     * @return string
     */
    protected function getTestedNamespace()
    {
        return 'Granam\Exceptions\Tools';
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