<?php
namespace Granam\Tests\Exceptions\Tools;

use Granam\Tests\Exceptions\Tools\DummyExceptionsHierarchy\PerfectFamily\Mama;
use Granam\Tests\Exceptions\Tools\DummyExceptionsHierarchy\PerfectFamily\Papa;

class UsedCustomExceptionsAreNotReportedAsUnusedTest extends AbstractExceptionsHierarchyTest
{
    public function TakeGarbage()
    {
        try {
            throw new Mama();
        } catch (Mama $mama) {
            throw new Papa();
        }
    }

    /**
     * @return string
     */
    protected function getTestedNamespace()
    {
        return __NAMESPACE__ . '\\DummyExceptionsHierarchy\\PerfectFamily';
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

    protected function getExceptionsUsageRootDir()
    {
        return __DIR__;
    }

}