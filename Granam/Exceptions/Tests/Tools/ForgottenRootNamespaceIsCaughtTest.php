<?php
namespace Granam\Exceptions\Tests\Tools;

class ForgottenRootNamespaceIsCaughtTest extends AbstractTestOfForgottenNamespaceIsCaught
{

    protected function getTestedNamespace()
    {
        return __NAMESPACE__;
    }

    protected function getRootNamespace()
    {
        $this->getTestedNamespace(); // intentionally "forgotten" return
    }

}
