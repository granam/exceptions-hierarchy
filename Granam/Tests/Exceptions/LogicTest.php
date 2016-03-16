<?php
namespace Granam\Exceptions;

class LogicTest extends \PHPUnit_Framework_TestCase {

    /**
     * @test
     * @expectedException \Granam\Exceptions\Logic
     */
    public function can_marks_exception_and_be_catch()
    {
        throw new TestLogic;
    }

    /**
     * @test
     * @expectedException \Granam\Exceptions\Exception
     */
    public function origins_at_basic_local_interface()
    {
        throw new TestLogic;
    }
}

/** inner */
class TestLogic extends \LogicException implements Logic {

}
