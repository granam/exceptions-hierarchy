<?php
namespace Granam\Exceptions\Tests\Tools;

use Granam\Exceptions\Tools\TestOfExceptionsHierarchy;

class InvalidRootNamespaceTest extends AbstractTestOfExceptionsHierarchy
{

    protected function setUp()
    {
        return; // disabling parent setup
    }

    /**
     * @test
     * @expectedException \Granam\Exceptions\Tools\Exceptions\RootNamespaceHasToBeSuperior
     */
    public function I_am_stopped_on_invalid_root_namespace()
    {
        new TestOfExceptionsHierarchy(
            $this->getTestedNamespace(),
            $this->getRootNamespace(),
            $this->getExceptionsSubDir()
        );
    }

    public function My_tag_interfaces_are_in_hierarchy()
    {
        return; // disabled
    }

    public function My_exceptions_are_in_family_tree()
    {
        return; // disabled
    }

    protected function getTestedNamespace()
    {
        return __NAMESPACE__;
    }

    protected function getRootNamespace()
    {
        return 'invalid root namespace';
    }

}
