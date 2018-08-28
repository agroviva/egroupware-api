<?php
use EGroupware\Api;
use EGroupware\Api\Vfs;
use EGroupware\Api\Header\ContentSecurityPolicy as CSP;
use appname\DB;
use appname\Settings;
use appname\FileImport;
use appname\Request;
use AgroEgw\Api\Enqueue;

Include_Once(__DIR__."/../api/app.php");

class appname_ui
{
	var $public_functions = array(
		"init"		=> True,
	);

	function __construct()
	{
		CSP::add_script_src(array('self', 'unsafe-eval', 'unsafe-inline'));
		$this->me = $GLOBALS['egw_info']["user"];

	}

	public function init() {
	
	}

	/**
	* function create_header
	* this is creating the header for our non e-template approach
	*/
	public function create_header () {
		common::egw_header();
		echo parse_navbar();
	}

	/**
	* function create_footer
	* this is creating the footer for our non e-template approach
	*/
	public function create_footer () {
		common::egw_footer();
	}
}