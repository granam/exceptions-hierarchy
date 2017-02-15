<?php
namespace Granam\Tests\Exceptions\Tools;

class TagWithoutTypeTest extends AbstractExceptionsHierarchyTest
{

    /**
     * I_am_stopped_on_tag_without_type
     *
     * @test
     * @expectedException \Granam\ExceptionsHierarchy\Exceptions\ExceptionIsNotTaggedProperly
     * @expectedExceptionMessageRegExp ~ is not tagged by Runtime interface or even Logic interface$~
     */
    public function My_exceptions_are_in_family_tree()
    {
        parent::My_exceptions_are_in_family_tree();
    }

    protected function getTestedNamespace()
    {
        return __NAMESPACE__ . '\DummyExceptionsHierarchy\TagWithoutType';
    }

    protected function getExceptionsSubDir()
    {
        return false;
    }

    protected function getRootNamespace()
    {
        return $this->getTestedNamespace();
    }

    protected function getExceptionClassesSkippedFromUsageTest()
    {
        return [
            'Granam\Tests\Exceptions\Tools\DummyExceptionsHierarchy\TagWithoutType\IAmTagWithoutType',
        ];
    }

}
