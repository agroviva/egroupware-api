<?php

namespace AgroEgw\Api;

use EGroupware\Api\Contacts as Addressbook;

class Contacts
{
    public static $Addressbook;

    public static function init_static()
    {
        self::$Addressbook = new Addressbook();
    }

    public static function Read($contact_id)
    {
        return self::$Addressbook->read($contact_id);
    }

    public static function Fullname($contact_id)
    {
        return self::$Addressbook->fullname(self::Read($contact_id));
    }
}
Contacts::init_static();
