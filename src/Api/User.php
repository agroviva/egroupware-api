<?php

namespace AgroEgw\Api;

use AgroEgw\Api;

class User
{
    public static function Me()
    {
        return $GLOBALS['egw_info']['user']['account_id'];
    }

    public static function Search($query)
    {
        $app = $_REQUEST['app'];
        $type = $_REQUEST['type'];
        $query = $_REQUEST['query'] ?? $query;
        $options = [];
        $links = [];
        if ($type == 'account') {
            // Only search if a query was provided - don't search for all accounts
            if ($query) {
                $options['account_type'] = $_REQUEST['account_type'];
                $links = Api\Accounts::link_query($query, $options);
            }
        } else {
            $links = Api\Link::query($app, $query, $options);
        }

        $results = [];
        foreach ($links as $id => $name) {
            $results[] = ['id' => $id, 'label' => $name];
        }

        usort($results, function ($a, $b) use ($query) {
            $a_label = is_array($a['label']) ? $a['label']['label'] : $a['label'];
            $b_label = is_array($b['label']) ? $b['label']['label'] : $b['label'];

            similar_text($query, $a_label, $percent_a);
            similar_text($query, $b_label, $percent_b);

            return $percent_a === $percent_b ? 0 : ($percent_a > $percent_b ? -1 : 1);
        });
        // switch regular JSON response handling off
        Api\Json\Request::isJSONRequest(false);

        header('Content-Type: application/json; charset=utf-8');
        echo json_encode($results);
        exit;
    }
}
