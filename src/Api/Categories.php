<?php
namespace AgroEgw\Api;

use EGroupware\Api;

class Categories
{

	static $Categories;

	static function init_static(){
		self::$Categories = new Api\Categories(User::Me(), "timesheet");
	}

	static function Read(){
		return self::$Categories->return_array('all', 0, true, '', 'ASC','', true, null, -1, '', null);
	}
}
Categories::init_static();