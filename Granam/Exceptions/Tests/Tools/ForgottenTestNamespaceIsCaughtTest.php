<?php
namespace Granam\Exceptions\Tests\Tools;

class ForgottenTestNamespaceIsCaughtTest extends AbstractTestOfForgottenNamespaceIsCaught
{

    protected function getTestedNamespace()
    {
        /** @noinspection PhpExpressionResultUnusedInspection */
        'foo'; // intentionally "forgotten" return
    }

    protected function getRootNamespace()
    {
        return __NAMESPACE__;
    }

}
