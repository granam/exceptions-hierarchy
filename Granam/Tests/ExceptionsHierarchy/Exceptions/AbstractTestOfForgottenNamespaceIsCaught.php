<?php
namespace Granam\Tests\ExceptionsHierarchy\Exceptions;

use Granam\ExceptionsHierarchy\TestOfExceptionsHierarchy;

abstract class AbstractTestOfForgottenNamespaceIsCaught extends \PHPUnit_Framework_TestCase
{

    abstract protected function getTestedNamespace();

    abstract protected function getRootNamespace();

    /**
     * @test
     * @expectedException \Granam\ExceptionsHierarchy\Exceptions\MissingNamespace
     * @expectedExceptionMessageRegExp ~given NULL$~
     */
    public function I_am_stopped_if_forgot_return_of_tested_namespace()
    {
        new TestOfExceptionsHierarchy($this->getTestedNamespace(), $this->getRootNamespace());
    }

}
