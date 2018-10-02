<?php
/**
 * Created by PhpStorm.
 * User: dawid
 * Date: 02.10.18
 * Time: 21:11
 */

namespace Phpbook;


class Thirteen implements iThirteen
{

    /**
     * Checks if number is thirteen
     * @param int $num
     * @return mixed
     */
    public static function isThirteen(int $num)
    {
        return $num == 13;
    }
}