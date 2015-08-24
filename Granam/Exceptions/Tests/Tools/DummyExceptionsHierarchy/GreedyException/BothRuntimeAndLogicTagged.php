<?php
namespace Granam\Exceptions\Tests\Tools\DummyExceptionsHierarchy\GreedyException;

class BothRuntimeAndLogicTagged extends \Exception implements Runtime, Logic
{

}
