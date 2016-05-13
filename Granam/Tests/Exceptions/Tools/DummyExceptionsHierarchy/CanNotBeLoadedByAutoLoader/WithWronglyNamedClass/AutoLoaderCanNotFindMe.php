<?php
namespace Granam\Tests\Exceptions\Tools\DummyExceptionsHierarchy\CanNotBeLoadedByAutoLoader\WithWronglyNamedClass;

class AutoLoaderCanNotFindMeBecauseSomeoneNamedMeWrongly extends \RuntimeException implements Runtime
{

}