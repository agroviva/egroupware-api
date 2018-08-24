<?php
namespace AgroEgw;

class App
{	

	private static $flags = array(
        'currentapp' => '',
        'noheader'   => true,
        'nonavbar'   => true,
	);
	static function setName($name){
		self::$flags["currentapp"] = $name;
	}

    static function Start(){
    	$_GET['cd'] = 'no';
		$GLOBALS['egw_info']['flags'] = self::$flags;
		ob_start();
    }

    static function Clean(){
    	return ob_get_clean();
    }
}