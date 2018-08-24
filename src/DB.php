<?php

namespace AgroEgw;

class DB
{
    private $DB;

    public function __construct($sql = false)
    {
        if ($sql) {
            $this->Query($sql);
        }
    }

    public function Query($sql)
    {
        $this->DB = $GLOBALS['egw']->db->query($sql, __LINE__, __FILE__, 0, -1, false, 2);

        return $this;
    }

    public function Fetch()
    {
        $output = $this->DB->fetch();

        return $output ? $output : false;
    }

    public function FetchAll()
    {
        $output = $this->DB->GetAll();

        return $output ? $output : false;
    }

    public static function HaveTable($table_name)
    {
        if (is_string($table_name)) {
            return $GLOBALS['egw']->db->query("SHOW TABLES LIKE '$table_name'", __LINE__, __FILE__, 0, -1, false, 2)->fetch() !== false ? true : false;
        }

        return false;
    }

    public static function HaveColumn($table_name, $column_name)
    {
        if (is_string($table_name) && is_string($column_name)) {
            return $GLOBALS['egw']->db->query("SHOW COLUMNS FROM `{$table_name}` LIKE '{$column_name}'", __LINE__, __FILE__, 0, -1, false, 2)->fetch() !== false ? true : false;
        }

        return false;
    }
}
