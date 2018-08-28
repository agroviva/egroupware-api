<?php
$_GET['cd'] = 'no';
$GLOBALS['egw_info']['flags'] = array(
        'currentapp'    => 'appname',
        'noheader'   => True,
        'nonavbar'   => True,
);
Include('../header.inc.php');
$GLOBALS['egw']->redirect_link('/appname/graph/index.php');