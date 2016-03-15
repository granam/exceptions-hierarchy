<?php
namespace Granam\Exceptions\Tests\Tools;

use Granam\Exceptions\Tools\TestOfExceptionsHierarchy;

abstract class AbstractTestOfExceptionsHierarchy extends \PHPUnit_Framework_TestCase
{

    /**
     * @var TestOfExceptionsHierarchy
     */
    private $testOfExceptionsHierarchy;

    protected function setUp()
    {
        $this->testOfExceptionsHierarchy = new TestOfExceptionsHierarchy(
            $this->getTestedNamespace(),
            $this->getRootNamespace(),
            $this->getExceptionsSubDir(),
            $this->getExternalRootNamespaces(),
            $this->getExternalRootExceptionsSubDir()
        );
    }

    /**
     * @return TestOfExceptionsHierarchy
     */
    protected function getTestOfExceptionsHierarchy()
    {
        return $this->testOfExceptionsHierarchy;
    }

    abstract protected function getTestedNamespace();

    abstract protected function getRootNamespace();

    protected function getExceptionsSubDir()
    {
        return 'Exceptions';
    }

    /**
     * @return array|string[]
     */
    protected function getExternalRootNamespaces()
    {
        return array();
    }

    protected function getExternalRootExceptionsSubDir()
    {
        return 'Exceptions';
    }

    /**
     * @test
     */
    public function My_exceptions_are_in_family_tree()
    {
        self::assertTrue($this->getTestOfExceptionsHierarchy()->My_exceptions_are_in_family_tree());
    }

}
