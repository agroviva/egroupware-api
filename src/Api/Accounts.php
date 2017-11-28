<?php

namespace AgroEgw;

use EGroupware\Api;
use EGroupware\Api\Accounts as EGW_Accounts;
use AgroEgw\DB as DB;
/**
* 
*/
class Accounts
{

	private static $Accounts;

	static function Self(){
		return EGW_Accounts::getInstance()->read($GLOBALS['egw_info']['user']['account_id']);
	}

	static function Read($id_or_username){
		if (is_string($id_or_username) || is_int($id_or_username)) {
			return EGW_Accounts::getInstance()->read($id_or_username);
		}
		throw new \Exception("\AgroEgw\Accounts::Read($id_or_username): Couldn't read the user with given parameters: id_or_username = {$id_or_username}", 1);
	}

	static function Active(){
		return EGW_Accounts::getInstance()->search(array(
			"type" 		=> "accounts",
			"active"	=> true
		));
	}

	static function is_expired($data){
		return EGW_Accounts::is_expired($data);
	}

	static function set_active($id_or_username){
		if (is_int($id_or_username)) {
			if (self::is_expired($id_or_username)) {
				return (new DB("UPDATE egw_accounts SET account_expires = '-1', account_status = 'A' WHERE account_id = '{$id_or_username}'"));
			} else {
				return (new DB("UPDATE egw_accounts SET account_status = 'A' WHERE account_id = '{$id_or_username}'"));
			}
		} elseif (is_string($id_or_username)) {
			if (self::is_expired($id_or_username)) {
				return (new DB("UPDATE egw_accounts SET account_expires = '-1', account_status = 'A' WHERE account_lid = '{$id_or_username}'"));
			} else {
				return (new DB("UPDATE egw_accounts SET account_status = 'A' WHERE account_lid = '{$id_or_username}'"));
			}
		}
		return false;
	}

	static function is_active($data){
		return EGW_Accounts::is_active($data);
	}

	static function exists($account_id){
		return EGW_Accounts::getInstance()->exists($account_id);
	}
}	