<?php
namespace Granam\Tests\Exceptions\Tools;

use Granam\Exceptions\Tools\TestOfExceptionsHierarchy;

class InvalidRootNamespaceTest extends ExceptionsHierarchyTest
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
