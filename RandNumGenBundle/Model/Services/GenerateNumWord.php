<?php
/**
 * Created by PhpStorm.
 * User: munna
 * Date: 8/1/2017
 * Time: 7:42 AM
 */

namespace RandNumGenBundle\Model\Services;


class GenerateNumWord
{

    public function NumtoWord($count)
    {
        switch($count)
        {
            case 1: return "first";
            case 2: return "second";
            case 3: return "last";
            default: return "";
        }
    }


}