<?php
/**
 * appname - hooks:.
 *
 * @link http://www.egroupware.org
 *
 * @author Enver Morinaj
 * @copyright (c) 2005-11 by Ralf Becker <RalfBecker-AT-outdoor-training.de>
 * @license http://opensource.org/licenses/gpl-license.php GPL - GNU General Public License
 *
 * @version $Id: class.appname_ui.inc.php $
 */
use EGroupware\Api\Egw;
use EGroupware\Api\Link;

class appname_hooks
{
    /**
     * Hook called by link-class to include test in the appregistry of the linkage.
     *
     * @param array/string $location location and other parameters (not used)
     *
     * @return array with method-names
     */
    public static function search_link($location)
    {
        unset($location);

        return [
            'title'             => 'appname.appname_bo.link_title',
                        'query' => 'appname.appname_bo.link_query',
            'view'              => [
                   'menuaction' => 'appname.appname_ui.index',
                   ],
            'view_id'    => 'appname_id',
            'view_popup' => '850x590',
            'edit_popup' => '850x590',
            'index'      => [
                'menuaction' => 'appname.appname_ui.index',
                ],
            'edit' => [
                'menuaction' => 'appname.appname_ui.edit',
                    ],
            'edit_id'    => 'appname_id',
            'name'       => 'appname',
        ];
    }

    // To register all hooks for the app. on the proper location
    public static function all_hooks($args)
    {
        //var_dump(debug_print_backtrace());
        $appname = 'appname';
        $title = lang($GLOBALS['egw_info']['apps'][$appname]['title']);
        $location = is_array($args) ? $args['location'] : $args;
        // echo "<p>ts_admin_prefs_sidebox_hooks::all_hooks(".print_r($args,True).") appname='$appname', location='$location'</p>\n";

        if ($location == 'sidebox_menu') {
            if ($GLOBALS['egw_info']['user']['apps']['admin'] && $location != 'admin') {
                $file = [
                    'Home'			=> Egw::link('/appname/graph/home.php'),
                ];

                display_sidebox($appname, 'Administrator', $file);
            }
        }

        if ($GLOBALS['egw_info']['user']['apps']['admin'] && $location != 'preferences') {
            $file = [];

            if ($location == 'admin') {
                display_section($appname, $file);
            } else {
                display_sidebox($appname, lang('Admin'), $file);
            }
        }
    }
}
