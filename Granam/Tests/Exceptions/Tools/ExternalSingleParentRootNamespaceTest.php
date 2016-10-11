<?php
namespace Granam\Tests\Exceptions\Tools;

class ExternalSingleParentRootNamespaceTest extends ExternalParentRootNamespaceTest
{
    protected function getExternalRootNamespaces()
    {
        return '\Granam\Exceptions\Tools'; // string instead of array
    }

}
