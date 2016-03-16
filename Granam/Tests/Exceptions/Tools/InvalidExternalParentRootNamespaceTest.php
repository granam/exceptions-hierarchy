<?php
namespace Granam\Tests\Exceptions\Tools;

use Granam\Exceptions\Tools\TestOfExceptionsHierarchy;

class InvalidExternalParentRootNamespaceTest extends ExceptionsHierarchyTest
{
    protected function getTestedNamespace()
    {
        return __NAMESPACE__ . '\DummyExceptionsHierarchy\ExternalParentRootNamespace';
    }

    protected function getRootNamespace()
    {
        return $this->getTestedNamespace();
    }

    protected function getExceptionsSubDir()
    {
        return '';
    }

    protected function getExternalRootNamespaces()
    {
        // intentionally wrong external namespace
        return array($this->getRootNamespace());
    }

    protected function getExternalRootExceptionsSubDir()
    {
        return '';
    }

    protected function setUp()
    {
        // disabling original set up
        return false;
    }

    /**
     * @test
     * @expectedException \Granam\Exceptions\Tools\Exceptions\ExternalRootNamespaceHasToBeSuperior
     * @expectedExceptionMessageRegExp ~^External root namespace .+ should differ to local root namespace~
     */
    public function I_can_not_use_inner_namespace_as_external()
    {
        new TestOfExceptionsHierarchy(
            $this->getTestedNamespace(),
            $this->getRootNamespace(),
            $this->getExceptionsSubDir(),
            $this->getExternalRootNamespaces(),
            $this->getExternalRootExceptionsSubDir()
        );
    }

    /**
     * @test
     * @expectedException \Granam\Exceptions\Tools\Exceptions\ExternalRootNamespaceHasToBeSuperior
     * @expectedExceptionMessageRegExp ~^External root namespace .+ should not be subordinate to local root namespace~
     */
    public function I_can_not_use_external_namespace_subordinated_to_internal()
    {
        new TestOfExceptionsHierarchy(
            $this->getTestedNamespace(),
            $this->getRootNamespace(),
            $this->getExceptionsSubDir(),
            array($this->getTestedNamespace() . '\\InvalidExternalParent'),
            ''
        );
    }

    public function My_exceptions_are_in_family_tree()
    {
        // disabling original test
        return false;
    }

}
