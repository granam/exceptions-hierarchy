<?php
namespace Granam\Exceptions\Tests\Tools;

class LogicTagWithoutBaseTagTest extends AbstractTestOfExceptionsHierarchy
{

    /**
     * @test
     * @expectedException \Granam\Exceptions\Tools\Exceptions\InvalidTagInterfaceHierarchy
     * @expectedExceptionMessageRegExp ~^Logic tag interface .+ is not a child of .+\\Exception$$~
     */
    public function My_tag_interfaces_are_in_hierarchy()
    {
        parent::My_tag_interfaces_are_in_hierarchy();
    }

    protected function getTestedNamespace()
    {
        return __NAMESPACE__ . '\DummyExceptionsHierarchy\LogicTagWithoutBaseTag';
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
