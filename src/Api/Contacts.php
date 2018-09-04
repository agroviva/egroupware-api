<?php
namespace AgroEgw\Api;
use EGroupware\Api\Contacts as Addressbook;
class Contacts
{
	static $Addressbook;

	static function init_static(){
		self::$Addressbook = new Addressbook();
	}

    static function Read($contact_id){
    	return self::$Addressbook->read($contact_id);
    }

    static function Fullname($contact_id){
    	return self::$Addressbook->fullname(self::Read($contact_id));
    }
}
Contacts::init_static();