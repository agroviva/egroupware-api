<?php

use EGroupware\Api;
use EGroupware\Api\Header\ContentSecurityPolicy as CSP;

include_once __DIR__.'/../api/app.php';

class appname_ui
{
    public $public_functions = [
        'init'		=> true,
    ];

    public function __construct()
    {
        CSP::add_script_src(['self', 'unsafe-eval', 'unsafe-inline']);
        $this->me = $GLOBALS['egw_info']['user'];
    }

    public function init()
    {
    }

    /**
     * function create_header
     * this is creating the header for our non e-template approach.
     */
    public function create_header()
    {
        common::egw_header();
        echo parse_navbar();
    }

    /**
     * function create_footer
     * this is creating the footer for our non e-template approach.
     */
    public function create_footer()
    {
        common::egw_footer();
    }
}
