<?php

namespace AgroEgw\Api\Infolog;

class InfologSchema
{
    public $info_type = 'task';
    public $info_from = null;
    public $info_addr = null;
    public $info_subject = null;
    public $info_des = null;
    public $info_owner;
    public $info_responsible = 0;
    public $info_access = 'public';
    public $info_cat = 0;
    public $info_datemodified;
    public $info_startdate = 0;
    public $info_enddate = 0;
    public $info_id_parent = 0;
    public $info_planned_time = 0;
    public $info_used_time = 0;
    public $info_status = 'done';
    public $info_confirm = 'not';
    public $info_modifier = 0;
    public $info_link_id = 0;
    public $info_priority = 1;
    public $pl_id = null;
    public $info_price = null;
    public $info_percent = 0;
    public $info_datecompleted = null;
    public $info_location = null;
    public $info_custom_from = null;
    public $info_uid = null;
    public $info_replanned_time = null;
    public $info_cc = null;
    public $caldav_name = null;
    public $info_etag = 0;
    public $info_created = null;
    public $info_creator = null;

    public function __construct()
    {
        $this->info_datemodified = time();
    }

    public function setOwner(int $uid)
    {
        if ($uid && $uid != 0) {
            $this->info_owner = $uid;
        } else {
            throw new \Exception("Error at: AgroEgw\\Api\\Infolog\\InfologSchema::setOwner($uid)");
        }
    }

    public function setDateModified(int $timestamp)
    {
        $this->info_datemodified = $timestamp;
    }
}
