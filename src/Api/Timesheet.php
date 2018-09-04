<?php

namespace AgroEgw;

use AgroEgw\Api\Timesheet\TimesheetSchema;
use AgroEgw\DB;

class Timesheet
{
    static function Get($ts_id){
        $ts_id = (int) $ts_id;
        $timesheet = (new DB("
            SELECT * FROM egw_timesheet WHERE ts_id = $ts_id;
        "))->Fetch();

        return !empty($timesheet) ? (object)$timesheet : array();
    }

    static function New(TimesheetSchema $timesheet){
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

    static function Update(){

    }

    public static function Exists(int $id)
    {
        $infolog = (new DB("SELECT * FROM `egw_timesheet` WHERE `info_id` = $id"))->Fetch();

        return is_array($infolog) ? true : false;
    }
}
