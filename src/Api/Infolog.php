<?php

namespace AgroEgw\Api;

use AgroEgw\Api\Infolog\InfologSchema;
use AgroEgw\DB;
use EGroupware\Api;

class Infolog
{
    public static function Get($info_id)
    {
        $info_id = (int) $info_id;
        $infolog = (new DB("
            SELECT * FROM egw_infolog WHERE info_id = $info_id;
        "))->Fetch();

        return !empty($infolog) ? (object) $infolog : [];
    }

    public static function New(InfologSchema $info_data)
    {
        $tables = $values = '(';
        $i = 0;
        $count = count((array) $info_data);
        foreach ($info_data as $key => $value) {
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

        $sql = "INSERT INTO egw_infolog $tables VALUES $values";

        $query = new DB($sql);
        if ($query) {
            return true;
        } else {
            return false;
        }
    }

    public static function Update(int $info_id, InfologSchema $info_data)
    {
        $info_type = $info_data->info_type;
        $info_from = $info_data->info_from;
        $info_addr = $info_data->info_addr;
        $info_subject = $info_data->info_subject;
        $info_des = $info_data->info_des;
        $info_owner = $info_data->info_owner;
        $info_responsible = $info_data->info_responsible;
        $info_access = $info_data->info_access;
        $info_cat = $info_data->info_cat;
        $info_datemodified = $info_data->info_datemodified;
        $info_startdate = $info_data->info_startdate;
        $info_enddate = $info_data->info_enddate;
        $info_id_parent = $info_data->info_id_parent;
        $info_planned_time = $info_data->info_planned_time;
        $info_used_time = $info_data->info_used_time;
        $info_status = $info_data->info_status;
        $info_confirm = $info_data->info_confirm;
        $info_modifier = $info_data->info_modifier;
        $info_link_id = $info_data->info_link_id;
        $info_priority = $info_data->info_priority;
        $pl_id = $info_data->pl_id;
        $info_price = $info_data->info_price;
        $info_percent = $info_data->info_percent;
        $info_datecompleted = $info_data->info_datecompleted;
        $info_location = $info_data->info_location;
        $info_custom_from = $info_data->info_custom_from;
        $info_uid = $info_data->info_uid;
        $info_replanned_time = $info_data->info_replanned_time;
        $info_cc = $info_data->info_cc;
        $caldav_name = $info_data->caldav_name;
        $info_etag = $info_data->info_etag;
        $info_created = $info_data->info_created;
        $info_creator = $info_data->info_creator;

        if (self::Exists($info_id)) {
        } else {
            throw new Exception("Infolog doesen't exists! at:  AgroEgw\\Api\\Infolog::Update()");
        }
    }

    public static function Exists(int $id)
    {
        $infolog = (new DB("SELECT * FROM `egw_infolog` WHERE `info_id` = $id"))->Fetch();

        return is_array($infolog) ? true : false;
    }

    public static function InfoTypes()
    {
        $info_types = self::Config()->types;

        return is_array($info_types) ? $info_types : [];
    }

    public static function InfoStatus()
    {
        $info_statuses = self::Config()->status;

        if (is_array($info_statuses)) {
            foreach ($info_statuses as $info_key => $info_type) {
                if ($info_key != 'defaults') {
                    foreach ($info_type as $key => $status) {
                        $info_statuses[$info_key][$key] = lang($status);
                    }
                }
            }
        }

        return is_array($info_statuses) ? $info_statuses : [];
    }

    public static function getDefaultStatus($info_type)
    {
    }

    public static function Config()
    {
        return (object) Api\Config::read('infolog');
    }
}
