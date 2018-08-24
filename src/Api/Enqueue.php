<?php
namespace AgroEgw\Api;
use EGroupware\Api\Framework;
/**
* 
*/
class Enqueue
{
	
	static function Css(string $file){
		Framework::includeCSS($file);
	}

	static function Script($file){
		Framework::includeJS($file);
	}
}