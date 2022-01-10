<?php

namespace App\Traits;

trait Paginatable
{
    protected static function getPageFromQueryString($url, $parameter = 'page')
    {
        $qs = parse_url($url, PHP_URL_QUERY);
        $qs = explode("&", $qs);

        foreach ($qs as $q) {
            list($k, $v) = explode("=", $q, 2);

            if ($k == $parameter) {
                return intval($v);
            }
        }
    }
}
