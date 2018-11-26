<?php

namespace AgroEgw\Api;

use AgroEgw\Api\Timesheet\TimesheetSchema;
use AgroEgw\DB;
use EGroupware\Api;

class Timesheet
{
    public static function Get($ts_id)
    {
        $ts_id = (int) $ts_id;
        $timesheet = (new DB("
            SELECT * FROM egw_timesheet WHERE ts_id = $ts_id;
        "))->Fetch();

        return !empty($timesheet) ? (object) $timesheet : [];
    }

    public static function New(TimesheetSchema $timesheet)
    {
        $tables = $values = '(';
        $i = 0;
        $count = count((array) $timesheet);
        foreach ($timesheet as $key => $value) {
            $i++;
            if ($i < $count) {
                $tables .= "$key, ";
                $values .= "'$value', ";
            } else {
                $tables .= "$key";
                $values .= "'$value'";
            }
        }
        $tables .= ')';
        $values .= ')';

        $sql = "INSERT INTO egw_timesheet $tables VALUES $values";

        $query = new DB($sql);
        if ($query) {
            return true;
        } else {
            return false;
        }
    }

    public static function Update()
    {
    }

    public static function Exists(int $id)
    {
        $timesheet = (new DB("SELECT * FROM `egw_timesheet` WHERE `info_id` = $id"))->Fetch();

        return is_array($timesheet) ? true : false;
    }

    public static function statusLabels()
    {
        return self::Config()->status_labels;
    }

    public static function Config()
    {
        return (object) Api\Config::read('timesheet');
    }

    public static function Categories()
    {
        return Categories::ReadAll('timesheet');
    }

    public static function LastInsertedId()
    {
        $last_infolog = (new DB('SELECT * FROM egw_timesheet ORDER BY ts_id DESC;'))->Fetch();

        return $last_infolog['ts_id'] ?: 0;
    }

    public static function Link($appname, $timesheet_id, $ids)
    {
        if (!is_array($ids)) {
            $ids = [$ids];
        }
        $links = [];
        foreach ($ids as $id) {
            $links[] = Link::Create('timesheet', $appname, (int) $timesheet_id, (int) $id);
        }

        return $links;
    }
}
