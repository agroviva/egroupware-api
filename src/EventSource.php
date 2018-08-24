<?php

namespace AgroEgw;

class EventSource
{
    public static function setHeaders()
    {
        if (!headers_sent()) {
            header('Content-Type: text/event-stream');
            // header('content-type: application/json; charset=UTF-8');
            header('Cache-Control: no-cache');
        } else {
            throw new Exception('Headers are already sent!', 1);
        }
    }

    public static function Send(array $array)
    {
        ob_get_clean();
        ob_get_contents();
        echo 'data: '.json_encode($array)."\n\n";
        ob_flush();
        flush();
    }
}
