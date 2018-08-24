<?php

namespace AgroEgw\Api;

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
