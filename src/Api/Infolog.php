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
        if (self::Exists($info_id)) {
            return $info_data;
        } else {
            throw new \Exception("Infolog doesen't exists! at:  AgroEgw\\Api\\Infolog::Update()");
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

    public static function defaultStatus($info_type)
    {
        $info_statuses = self::Config()->status;
        $defaults = $info_statuses['defaults'];

        return !empty($defaults[$info_type]) ? $defaults[$info_type] : '';
    }

    public static function Config()
    {
        return (object) Api\Config::read('infolog');
    }

    public static function LastInsertedId()
    {
        $last_infolog = (new DB('SELECT * FROM egw_infolog ORDER BY info_id DESC;'))->Fetch();

        return $last_infolog['info_id'] ?: 0;
    }

    public static function Link($appname, $infolog_id, $ids)
    {
        if (!is_array($ids)) {
            $ids = [$ids];
        }
        $links = [];
        foreach ($ids as $id) {
            $links[] = Link::Create('infolog', $appname, (int) $infolog_id, (int) $id);
        }

        return $links;
    }
}
