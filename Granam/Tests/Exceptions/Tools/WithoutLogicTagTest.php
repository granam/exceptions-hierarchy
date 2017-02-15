<?php
namespace Granam\Tests\Exceptions\Tools;

class WithoutLogicTagTest extends AbstractExceptionsHierarchyTest
{

    /**
     * I_am_stopped_if_runtime_tag_is_missing
     *
     * @test
     * @expectedException \Granam\ExceptionsHierarchy\Exceptions\TagInterfaceNotFound
     * @expectedExceptionMessageRegExp ~^Logic tag interface .+\\Logic not found$~
     */
    public function My_exceptions_are_in_family_tree()
    {
        parent::My_exceptions_are_in_family_tree();
    }

    protected function getTestedNamespace()
    {
        return __NAMESPACE__ . '\DummyExceptionsHierarchy\WithoutLogicTag';
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
