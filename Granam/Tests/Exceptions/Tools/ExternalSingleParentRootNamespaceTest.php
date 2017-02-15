<?php
namespace Granam\Tests\Exceptions\Tools;

class ExternalSingleParentRootNamespaceTest extends ExternalParentRootNamespaceTest
{
    protected function getExternalRootNamespaces()
    {
        return '\Granam\ExceptionsHierarchy'; // string instead of array
    }

}
