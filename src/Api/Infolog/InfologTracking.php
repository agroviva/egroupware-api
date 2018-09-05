<?php

namespace AgroEgw\Api\Infolog;

/*
 * InfoLog - history and notifications
 *
 * @link http://www.egroupware.org
 * @author Ralf Becker <RalfBecker-AT-outdoor-training.de>
 * @package tracker
 * @copyright (c) 2007-16 by Ralf Becker <RalfBecker-AT-outdoor-training.de>
 * @license http://opensource.org/licenses/gpl-license.php GPL - GNU General Public License
 * @version $Id$
 */

use EGroupware\Api;
use EGroupware\Api\Link;

/**
 * Tracker - tracking object for the tracker.
 */
class InfologTracking extends Api\Storage\Tracking
{
    /**
     * Application we are tracking (required!).
     *
     * @var string
     */
    public $app = 'infolog';
    /**
     * Name of the id-field, used as id in the history log (required!).
     *
     * @var string
     */
    public $id_field = 'info_id';
    /**
     * Name of the field with the creator id, if the creator of an entry should be notified.
     *
     * @var string
     */
    public $creator_field = 'info_owner';
    /**
     * Name of the field with the id(s) of assinged users, if they should be notified.
     *
     * @var string
     */
    public $assigned_field = 'info_responsible';
    /**
     * Translate field-names to 2-char history status.
     *
     * @var array
     */
    public $field2history = [
        'info_type'          => 'Ty',
        'info_from'          => 'Fr',
        'info_addr'          => 'Ad',
        'info_link_id'       => 'Li',
        'info_id_parent'     => 'parent',
        'info_cat'           => 'Ca',
        'info_priority'      => 'Pr',
        'info_owner'         => 'Ow',
        'info_access'        => 'Ac',
        'info_status'        => 'St',
        'info_percent'       => 'Pe',
        'info_datecompleted' => 'Co',
        'info_location'      => 'Lo',
        'info_startdate'     => 'st',
        'info_enddate'       => 'En',
        'info_responsible'   => 'Re',
        'info_cc'            => 'cc',
        'info_subject'       => 'Su',
        'info_des'           => 'De',
        'info_location'      => 'Lo',
        // PM fields
        'info_planned_time'    => 'pT',
        'info_replanned_time'  => 'replanned',
        'info_used_time'       => 'uT',
        'pl_id'                => 'pL',
        'info_price'           => 'pr',
        // all custom fields together
        'custom'             => '#c',
    ];
    /**
     * Translate field-names to labels.
     *
     * @note The order of these fields is used to determine the order for CSV export
     *
     * @var array
     */
    public $field2label = [
        'info_type'          => 'Type',
        'info_from'          => 'Contact',
        'info_subject'       => 'Subject',
        'info_des'           => 'Description',
        'info_addr'          => 'Phone/Email',
        'info_link_id'       => 'primary link',
        'info_id_parent'     => 'Parent',
        'info_cat'           => 'Category',
        'info_priority'      => 'Priority',
        'info_owner'         => 'Owner',
        'info_modifier'      => 'Modifier',
        'info_access'        => 'Access',
        'info_status'        => 'Status',
        'info_percent'       => 'Completed',
        'info_datecompleted' => 'Date completed',
        'info_datemodified'  => 'Last changed',
        'info_location'      => 'Location',
        'info_startdate'     => 'Start date',
        'info_enddate'       => 'Due date',
        'info_responsible'   => 'Responsible',
        'info_cc'            => 'Cc',
        // PM fields
        'info_planned_time'    => 'planned time',
        'info_replanned_time'  => 're-planned time',
        'info_used_time'       => 'used time',
        'pl_id'                => 'pricelist',
        'info_price'           => 'price',
        // custom fields
        'custom'             => 'custom fields',
    ];

    /**
     * Instance of the infolog_bo class calling us.
     *
     * @var infolog_bo
     */
    private $infolog;

    /**
     * Constructor.
     *
     * @param botracker $botracker
     *
     * @return tracker_tracking
     */
    public function __construct()
    {
        parent::__construct('infolog');	// add custom fields from infolog
    }
}
