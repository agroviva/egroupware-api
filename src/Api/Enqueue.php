<?php

namespace AgroEgw\Api;

use AgroEgw\Api\Framework;

class Enqueue
{
    public static function Css(string $file)
    {
        Framework::includeCSS($file);
    }

    public static function Script($file)
    {
        Framework::includeJS($file);
    }
}
