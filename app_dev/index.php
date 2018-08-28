<?php

$_GET['cd'] = 'no';
$GLOBALS['egw_info']['flags'] = [
        'currentapp'    => 'appname',
        'noheader'      => true,
        'nonavbar'      => true,
];
include '../header.inc.php';
$GLOBALS['egw']->redirect_link('/appname/graph/index.php');
