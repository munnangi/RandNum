<?php

/**
 * Created by PhpStorm.
 * User: munna
 * Date: 7/31/2017
 * Time: 7:25 PM
 */

namespace RandNumGenBundle\Model\Services;
class GenerateRandNum
{
    public function generateNum($min,$max)
    {
        $randNumber = rand($min,$max);

        return $randNumber;
    }


}