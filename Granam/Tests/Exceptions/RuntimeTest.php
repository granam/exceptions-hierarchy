<?php
namespace Granam\Exceptions;

class RuntimeTest extends \PHPUnit_Framework_TestCase {

    /**
     * @test
     * @expectedException \Granam\Exceptions\Runtime
     */
    public function can_marks_exception_and_be_catch()
    {
        throw new TestRuntime;
    }

    /**
     * @test
     * @expectedException \Granam\Exceptions\Exception
     */
    public function origins_at_basic_local_interface()
    {
        throw new TestRuntime;
    }
}

/** inner */
class TestRuntime extends \RuntimeException implements Runtime {

}
