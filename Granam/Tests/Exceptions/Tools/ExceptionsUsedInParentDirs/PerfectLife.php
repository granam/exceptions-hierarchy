<?php
namespace Granam\Tests\Exceptions\Tools\ExceptionsUsedInParentDirs;

use Granam\Tests\Exceptions\Tools\ExceptionsUsedInParentDirs\PerfectSociety\PerfectFamily\Exceptions\Mama;
use Granam\Tests\Exceptions\Tools\ExceptionsUsedInParentDirs\PerfectSociety\PerfectFamily\Exceptions\Papa;
use Granam\Tests\Exceptions\Tools\ExceptionsUsedInParentDirs\PerfectSociety\PerfectFamily\PerfectMamaAtWork;

class PerfectLife
{
    /**
     * @throws Mama
     */
    public function TakeGarbage()
    {
        try {
            $perfectMamaAtWork = new PerfectMamaAtWork();
            $perfectMamaAtWork->cleanHouse();
        } catch (Papa $papa) {
            throw new Mama();
        }
    }

    public static function getClass()
    {
        return __CLASS__;
    }
}