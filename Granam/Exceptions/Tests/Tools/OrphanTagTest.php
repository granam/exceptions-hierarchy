<?php
namespace Granam\Exceptions\Tests\Tools;

class OrphanTagTest extends AbstractTestOfExceptionsHierarchy
{

    /**
     * @test
     * @expectedException \Granam\Exceptions\Tools\Exceptions\TagInterfaceNotFound
     */
    public function My_tag_interfaces_are_in_hierarchy()
    {
        parent::My_tag_interfaces_are_in_hierarchy();
    }

    /**
     * @test
     * @expectedException \Granam\Exceptions\Tools\Exceptions\ExceptionIsNotTaggedProperly
     */
    public function My_exceptions_are_in_family_tree()
    {
        parent::My_exceptions_are_in_family_tree();
    }

    protected function getTestedNamespace()
    {
        return __NAMESPACE__ . '\DummyExceptionsHierarchy\OrphanTag';
    }

    protected function getExceptionsSubDir()
    {
        return false;
    }

    protected function getRootNamespace()
    {
        return $this->getTestedNamespace();
    }

}
