<?php
namespace Granam\Tests\Exceptions\Tools;

class WithSameNamedExternalParentExceptionHierarchyTest extends AbstractExceptionsHierarchyTest
{
    /**
     * @return string
     */
    protected function getTestedNamespace()
    {
        return $this->getRootNamespace();
    }

    /**
     * @return string
     */
    protected function getRootNamespace()
    {
        return __NAMESPACE__ . '\DummyExceptionsHierarchy\WithSameNamedExternalParent';
    }

    /**
     * @return false
     */
    protected function getExceptionsSubDir()
    {
        return false; // exceptions are directly in the tested namespace
    }

    protected function getExternalRootNamespaces()
    {
        return array(
            __NAMESPACE__ . '\DummyExceptionsHierarchy\WithSameNamedParent\Children\IAmHereForWithSameNamedExternalParent',
        );
    }

    /**
     * @return false
     */
    protected function getExternalRootExceptionsSubDir()
    {
        return false; // exceptions are directly in the external root namespace
    }
}
