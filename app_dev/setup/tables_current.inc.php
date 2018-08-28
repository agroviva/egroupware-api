<?php
/**
 * eGroupWare - Setup
 * http://www.egroupware.org
 * Created by eTemplates DB-Tools written by ralfbecker@outdoor-training.de
 *
 * @license http://opensource.org/licenses/gpl-license.php GPL - GNU General Public License
 * @package appname
 * @subpackage setup
 * @version $Id$
 */


$phpgw_baseline = array(
	'egw_appname' => array(
		'fd' => array(
			'id'  => array('type' => 'auto','nullable' => False),
			'data' => array('type' => 'varchar','precision' => '255','nullable' => False),
		),
		'pk' => array('id'),
		'fk' => array(),
		'ix' => array(),
		'uc' => array()
	),
	'egw_appname_meta' => array(
		'fd' => array(
			'id' => array('type' => 'auto','precision' => '11','nullable' => False),
			'meta_name' => array('type' => 'varchar','precision' => '255','nullable' => False),
			'meta_connection_id' => array('type' => 'int','precision' => '11','nullable' => False),
			'meta_data' => array('type' => 'longtext')
		),
		'pk' => array('id'),
		'fk' => array(),
		'ix' => array(),
		'uc' => array()
	)
);
