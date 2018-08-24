<?php

namespace AgroEgw;

class App
{
    private static $flags = [
        'currentapp' => '',
        'noheader'   => true,
        'nonavbar'   => true,
    ];

    public static function setName($name)
    {
        self::$flags['currentapp'] = $name;
    }

    public static function Start()
    {
        $_GET['cd'] = 'no';
        $GLOBALS['egw_info']['flags'] = self::$flags;
        ob_start();
    }

    public static function Clean()
    {
        return ob_get_clean();
    }
}
