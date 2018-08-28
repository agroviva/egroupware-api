<?php

$setup_info['appname']['name'] = 'appname';
$setup_info['appname']['title'] = 'Appname';
$setup_info['appname']['version'] = '16.1.0';
$setup_info['appname']['app_order'] = 99;
$setup_info['appname']['tables'] = ['egw_appname', 'egw_appname_meta'];
$setup_info['appname']['enable'] = 1;

//The application's hooks rergistered.
$setup_info['appname']['hooks']['admin'] = 'appname_hooks::all_hooks';
$setup_info['appname']['hooks']['sidebox_menu'] = 'appname_hooks::all_hooks';        /* Dependencies for this app to work */
$setup_info['appname']['hooks']['search_link'] = 'appname_hooks::search_link';
$setup_info['appname']['hooks'][] = 'after_navbar';

$setup_info['appname']['depends'][] = [
         'appname'  => 'api',
         'versions' => ['16.1'],
];
