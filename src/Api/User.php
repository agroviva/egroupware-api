<?php

namespace AgroEgw\Api;

use AgroEgw\DB;
use EGroupware\Api;
use EGroupware\Api\Accounts;
use FuzzyWuzzy\Fuzz;

class User
{
    public static function Me()
    {
        return $GLOBALS['egw_info']['user']['account_id'];
    }

    public static function Self()
    {
        return Accounts::getInstance()->read(self::Me());
    }

    public static function Read($id_or_username)
    {
        if (is_string($id_or_username) || is_int($id_or_username)) {
            return Accounts::getInstance()->read($id_or_username);
        }

        throw new \Exception("\AgroEgw\Api\User::Read($id_or_username): Couldn't read the user with given parameters: id_or_username = {$id_or_username}", 1);
    }

    public static function Expired($data)
    {
        return Accounts::is_expired($data);
    }

    public static function setActive($id_or_username)
    {
        if (is_int($id_or_username)) {
            if (self::is_expired($id_or_username)) {
                return new DB("UPDATE egw_accounts SET account_expires = '-1', account_status = 'A' WHERE account_id = '{$id_or_username}'");
            } else {
                return new DB("UPDATE egw_accounts SET account_status = 'A' WHERE account_id = '{$id_or_username}'");
            }
        } elseif (is_string($id_or_username)) {
            if (self::is_expired($id_or_username)) {
                return new DB("UPDATE egw_accounts SET account_expires = '-1', account_status = 'A' WHERE account_lid = '{$id_or_username}'");
            } else {
                return new DB("UPDATE egw_accounts SET account_status = 'A' WHERE account_lid = '{$id_or_username}'");
            }
        }

        return false;
    }

    public static function Active($data)
    {
        return Accounts::is_active($data);
    }

    public static function Exists($account_id)
    {
        return Accounts::getInstance()->exists($account_id);
    }

    public static function activeUsers()
    {
        return Accounts::getInstance()->search([
            'type'      => 'accounts',
            'active'    => true,
        ]);
    }

    public static function expiredUsers()
    {
        return Accounts::getInstance()->search([
            'type'      => 'accounts',
            'active'    => false,
        ]);
    }

    public static function Search($query = '', $type = 'account', $account_type = 'accounts')
    {
        $app = $_REQUEST['app'] ?? 'addressbook';
        $type = $_REQUEST['type'] ?? $type;
        $query = $_REQUEST['query'] ?? $query;
        $options = [];
        $links = [];
        if ($type == 'account') {
            // Only search if a query was provided - don't search for all accounts
            if ($query) {
                $options['account_type'] = $_REQUEST['account_type'] ?? $account_type;
                $links = Api\Accounts::link_query($query, $options);
            }
        } else {
            $links = Api\Link::query($app, $query, $options);
        }

        $results = [];
        foreach ($links as $id => $name) {
            $results[] = ['id' => $id, 'label' => $name];
        }

        $fuzz = new Fuzz();

        usort($results, function ($a, $b) use ($query, $fuzz) {
            $a_label = is_array($a['label']) ? $a['label']['label'] : $a['label'];
            $b_label = is_array($b['label']) ? $b['label']['label'] : $b['label'];

            $percent_a = $fuzz->tokenSetRatio($query, $a_label);
            $percent_b = $fuzz->tokenSetRatio($query, $b_label);

            return $percent_a === $percent_b ? 0 : ($percent_a > $percent_b ? -1 : 1);
        });
        // switch regular JSON response handling off
        Api\Json\Request::isJSONRequest(false);

        return $results;
    }
}
