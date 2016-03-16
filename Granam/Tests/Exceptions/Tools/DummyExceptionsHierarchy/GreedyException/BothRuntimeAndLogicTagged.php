<?php
namespace Granam\Tests\Exceptions\Tools\DummyExceptionsHierarchy\GreedyException;

class BothRuntimeAndLogicTagged extends \Exception implements Runtime, Logic
{

}
