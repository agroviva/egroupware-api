<?php

namespace AgroEgw\Api;

use EGroupware\Api;

class Link
{
    public static function Create($first_appname, $second_appname, $first_appid, $second_appid)
    {
        return Api\Link::link($first_appname, $first_appid, $second_appname, $second_appid);
    }
}
