<?php
use AgroEgw\App;
use EGroupware\Api\Header\ContentSecurityPolicy as CSP;

define('DEBUG_MODE', false);

require_once __DIR__.'/../vendor/autoload.php';

App::setName('appname');
App::Start();
require_once __DIR__.'/../../header.inc.php';
require_once __DIR__.'/../classes/autoload.php';
require_once __DIR__.'/../classes/functions/autoload.php';
App::Clean();

CSP::add_script_src(['self', 'unsafe-inline']);

function JavaScriptLoad()
{
    $time = strtotime(date('Y-m-d', time())); ?>
	<?php
}

function SideBoxLoad()
{
    ?>

	<?php
}
