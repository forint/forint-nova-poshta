<?php
namespace App\Helper;

/**
 * Class Helper
 * @package App\Helper
 */
class Helper
{
    /**
     * Convert seconds to user-friendly time format
     *
     * @param array $seconds
     * @return string
     */
    public static function secondsToTime(array $seconds): string
    {
        $seconds = $seconds['0'];
        $s = $seconds%60;
        $m = floor(($seconds%3600)/60);
        $h = floor(($seconds%86400)/3600);
        $d = floor(($seconds%2592000)/86400);
        $M = floor($seconds/2592000);

        return "$M месяца, $d дней, $h часов, $m минут, $s секунд";
    }
}