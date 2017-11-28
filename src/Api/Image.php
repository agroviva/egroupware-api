<?php
namespace AgroEgw;
use EGroupware\Api;
use AgroEgw\DB;
/**
* 
*/
class Image
{
	
	public static function ShowAvatar(int $user, $image = fals){
		if (!empty($_GET['id'])) {
			$id = (int)$_GET['id'];
			$_GET['cd'] = "no";
			$GLOBALS['egw_info']['flags']['currentapp'] = \AgroEgw\Api::appname();
			if (is_numeric($id) && $id) {
				ob_start();
				Include_Once(ROOT_DIR.'/header.inc.php');
				$user_data = (new DB("SELECT * FROM egw_addressbook WHERE account_id = {$id}"))->Fetch();
				if (!empty($user_data['contact_jpegphoto'])) {
					ob_end_clean();

					$etag = '"'.$user_data['account_id'].':"';
					header('Content-type: image/jpeg');
					header('ETag: '.$etag);
					// if etag parameter given in url, we can allow browser to cache picture via an Expires header
					// different url with different etag parameter will force a reload
					if (isset($_GET['etag']))
					{
						Api\Session::cache_control(30*86400);	// cache for 30 days
					}
					// if servers send a If-None-Match header, response with 304 Not Modified, if etag matches
					if (isset($_SERVER['HTTP_IF_NONE_MATCH']) && $_SERVER['HTTP_IF_NONE_MATCH'] === $etag)
					{
						header("HTTP/1.1 304 Not Modified");
					}
					else
					{
						header('Content-length: '.bytes($user_data['contact_jpegphoto']));
						echo $user_data['contact_jpegphoto'];
					}
					exit();
				} else {
					if ($image && is_string($image)) {
						header("Location: $image");
					} else {
						header("HTTP/1.0 404 Not Found");
						die();
					}
					exit;
				}
				ob_end_clean();
			}
		}
	}

}