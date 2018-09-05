<?php

namespace AgroEgw\Api\Timesheet;

use AgroEgw\Api\User;

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
    public $pl_id = null;
    public $ts_status = null;

    public function __construct()
    {
        $this->ts_start = time();
        $this->setDateModified();
        $this->setOwner();
    }

    public function setOwner(int $uid = 0)
    {
        $uid = $uid ?: User::Me();
        $this->ts_owner = $uid;
        $this->ts_modifier = $uid;
        $this->setDateModified(time());
    }

    public function setDateModified(int $timestamp = 0)
    {
        $this->ts_modified = $timestamp ?: time();
    }
}
