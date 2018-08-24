<?php
namespace AgroEgw\Api\Infolog;
use EGroupware\Api;

class InfologSchema
{

	public $info_type 			= "task";
	public $info_from 			= NULL;
	public $info_addr 			= NULL;
	public $info_subject 		= NULL;
	public $info_des 			= NULL;
	public $info_owner;
	public $info_responsible 	= 0;
	public $info_access 		= "public";
	public $info_cat 			= 0;
	public $info_datemodified;
	public $info_startdate 		= 0;
	public $info_enddate 		= 0;
	public $info_id_parent 		= 0;
	public $info_planned_time 	= 0;
	public $info_used_time 		= 0;
	public $info_status 		= "done";
	public $info_confirm 		= "not";
	public $info_modifier 		= 0;
	public $info_link_id 		= 0;
	public $info_priority 		= 1;
	public $pl_id 				= NULL;
	public $info_price 			= NULL;
	public $info_percent 		= 0;
	public $info_datecompleted 	= NULL;
	public $info_location 		= NULL;
	public $info_custom_from 	= NULL;
	public $info_uid 			= NULL;
	public $info_replanned_time = NULL;
	public $info_cc 			= NULL;
	public $caldav_name 		= NULL;
	public $info_etag 			= 0;
	public $info_created 		= NULL;
	public $info_creator 		= NULL;

    public function __construct()
    {
        $this->info_datemodified = time();
    }

    public function setOwner(int $uid){
    	if ($uid && $uid != 0) {
    		$this->info_owner = $uid;	
    	} else {
    		throw new \Exception("Error at: AgroEgw\\Api\\Infolog\\InfologSchema::setOwner($uid)");
    	}
    }

    public function setDateModified(int $timestamp) {
    	$this->info_datemodified = $timestamp;
    }
}