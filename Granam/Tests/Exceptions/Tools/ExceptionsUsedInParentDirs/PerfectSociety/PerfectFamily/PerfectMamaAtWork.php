<?php
namespace Granam\Tests\Exceptions\Tools\ExceptionsUsedInParentDirs\PerfectSociety\PerfectFamily;

use Granam\Tests\Exceptions\Tools\ExceptionsUsedInParentDirs\PerfectSociety\PerfectFamily\Exceptions\Papa;

class PerfectMamaAtWork
{
    /**
     * @throws Papa
     */
    public function cleanHouse()
    {
        throw new Papa();
    }

    public static function getClass()
    {
        return __CLASS__;
    }
}