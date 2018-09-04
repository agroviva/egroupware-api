<?php

namespace AgroEgw\Api\Timesheet;

class TimesheetSchema
{
    public $ts_project = null;
    public $ts_title;
    public $ts_description = null;
    public $ts_start;
    public $ts_duration = 0;
    public $ts_quantity;
    public $ts_unitprice = null;
    public $cat_id = 0;
    public $ts_owner;
    public $ts_modified;
    public $ts_modifier;
    public $pl_id = 0;
    public $ts_status;

    public function __construct()
    {
        $this->ts_start = time();
    }

    public function setOwner(int $uid)
    {
        if ($uid && $uid != 0) {
            $this->ts_owner = $uid;
            $this->ts_modifier = $uid;
            $this->setDateModified(time());
        } else {
            throw new \Exception("Error at: AgroEgw\\Api\\Timesheet\\TimesheetSchema::setOwner($uid)");
        }
    }

    public function setDateModified(int $timestamp)
    {
        $this->ts_modifier = $timestamp;
    }
}
