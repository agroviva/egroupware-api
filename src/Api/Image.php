<?php

namespace AgroEgw;

class Image
{
    public static function ShowAvatar(int $uid, $image = false)
    {
        $_GET['cd'] = 'no';
        $GLOBALS['egw_info']['flags']['currentapp'] = Api::appname();

        ob_start();
        include_once '/header.inc.php';
        $user_data = (new DB("SELECT * FROM egw_addressbook WHERE account_id = {$uid}"))->Fetch();
        if (!empty($user_data['contact_jpegphoto'])) {
            ob_end_clean();

            $etag = '"'.$user_data['account_id'].':"';
            header('Content-type: image/jpeg');
            header('ETag: '.$etag);
            // if etag parameter given in url, we can allow browser to cache picture via an Expires header
            // different url with different etag parameter will force a reload
            if (isset($_GET['etag'])) {
                Api\Session::cache_control(30 * 86400); // cache for 30 days
            }
            // if servers send a If-None-Match header, response with 304 Not Modified, if etag matches
            if (isset($_SERVER['HTTP_IF_NONE_MATCH']) && $_SERVER['HTTP_IF_NONE_MATCH'] === $etag) {
                header('HTTP/1.1 304 Not Modified');
            } else {
                ob_start();
                echo $user_data['contact_jpegphoto'];
                $content_length = ob_get_length();
                $image = ob_get_clean();
                header('Content-length: '.$content_length);
                echo $image;
            }
        } else {
            if ($image && is_string($image)) {
                header("Location: $image");
            } else {
                header('HTTP/1.0 404 Not Found');
            }
        }
        die();
    }
}
