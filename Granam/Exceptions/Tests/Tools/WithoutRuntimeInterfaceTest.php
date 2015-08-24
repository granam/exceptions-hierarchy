<?php
namespace Granam\Exceptions\Tests\Tools;

class WithoutRuntimeInterfaceTest extends AbstractTestOfExceptionsHierarchy
{

    /**
     * I_am_stopped_if_runtime_tag_is_missing
     *
     * @test
     * @expectedException \Granam\Exceptions\Tools\Exceptions\TagInterfaceNotFound
     * @expectedExceptionMessageRegExp ~^Runtime tag interface .+ not found$~
     */
    public function My_tag_interfaces_are_in_hierarchy()
    {
        parent::My_tag_interfaces_are_in_hierarchy();
    }

    protected function getTestedNamespace()
    {
        return __NAMESPACE__ . '\DummyExceptionsHierarchy\WithoutRuntimeInterface';
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
