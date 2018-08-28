<?php
use EGroupware\Api;
use EGroupware\Api\Vfs;
use EGroupware\Api\Header\ContentSecurityPolicy as CSP;
use appname\DB;
use appname\Request;

use AgroEgw\App;
use AgroEgw\Api\Enqueue;

define('DEBUG_MODE', false);

Require_Once(__DIR__.'/../vendor/autoload.php');

App::setName("appname");
App::Start();
Require_Once(__DIR__.'/../../header.inc.php');
Require_Once(__DIR__."/../classes/autoload.php");
Require_Once(__DIR__."/../classes/functions/autoload.php");
App::Clean();

CSP::add_script_src(array("self","unsafe-inline"));

function JavaScriptLoad()
{
	$time = strtotime(date("Y-m-d", time()));
	?>
	<?php
}

function SideBoxLoad()
{
	?>

	<?php
}