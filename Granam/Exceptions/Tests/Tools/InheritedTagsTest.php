<?php
namespace Granam\Exceptions\Tests\Tools;

class InheritedTagsTest extends AbstractTestOfExceptionsHierarchy
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
}
