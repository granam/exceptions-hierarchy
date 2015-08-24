<?php
namespace Granam\Exceptions;

class ExceptionTest extends \PHPUnit_Framework_TestCase
{

    /** @test */
    public function exception_interface_exists()
    {
        $this->assertTrue(interface_exists('\Granam\Exceptions\Exception'));
    }

    /**
     * @test
     * @expectedException \Granam\Exceptions\Exception
     */
    public function can_mark_an_exception()
    {
        throw new TestException;
    }
}

/** inner */
class TestException extends \Exception implements Exception
{

}
