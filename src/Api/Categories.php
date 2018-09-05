<?php

namespace AgroEgw\Api;

use EGroupware\Api;

class Categories
{
    public static $Categories;

    public static function init_static()
    {
        self::$Categories = new Api\Categories(User::Me(), 'timesheet');
    }

    public static function Read()
    {
        return self::$Categories->return_array('all', 0, true, '', 'ASC', '', true, null, -1, '', null);
    }
}
Categories::init_static();
