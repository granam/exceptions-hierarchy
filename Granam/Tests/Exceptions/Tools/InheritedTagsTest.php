<?php
namespace Granam\Tests\Exceptions\Tools;

class InheritedTagsTest extends AbstractExceptionsHierarchyTest
{
    protected function getTestedNamespace()
    {
        return $this->getRootNamespace() . '\InheritedTags';
    }

    protected function getExceptionsSubDir()
    {
        return false;
    }

    protected function getRootNamespace()
    {
        return __NAMESPACE__ . '\DummyExceptionsHierarchy';
    }

    protected function getExceptionClassesSkippedFromUsageTest()
    {
        return array(
            'Granam\Tests\Exceptions\Tools\DummyExceptionsHierarchy\IAmLogicException',
            'Granam\Tests\Exceptions\Tools\DummyExceptionsHierarchy\IAmRuntimeException',
        );
    }

}
