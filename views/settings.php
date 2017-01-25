<?php

/**
 * Kimchi settings view.
 *
 * @category   apps
 * @package    kimchi
 * @subpackage views
 * @author     Marc Laporte
 * @copyright  2017 Marc Laporte
 * @license    http://www.gnu.org/copyleft/gpl.html GNU General Public License version 3 or later
 * @link       https://github.com/eglooca/app-kimchi
 */

///////////////////////////////////////////////////////////////////////////////
//
// This program is free software: you can redistribute it and/or modify
// it under the terms of the GNU General Public License as published by
// the Free Software Foundation, either version 3 of the License, or
// (at your option) any later version.
//
// This program is distributed in the hope that it will be useful,
// but WITHOUT ANY WARRANTY; without even the implied warranty of
// MERCHANTABILITY or FITNESS FOR A PARTICULAR PURPOSE.  See the
// GNU General Public License for more details.
//
// You should have received a copy of the GNU General Public License
// along with this program.  If not, see <http://www.gnu.org/licenses/>.  
//  
///////////////////////////////////////////////////////////////////////////////

///////////////////////////////////////////////////////////////////////////////
// Load dependencies
///////////////////////////////////////////////////////////////////////////////

$this->lang->load('base');
$this->lang->load('kimchi');

///////////////////////////////////////////////////////////////////////////////
// Form - Not Running
///////////////////////////////////////////////////////////////////////////////

echo "<div id='kimchi_not_running' style='display:none;'>";

echo infobox_warning(
    lang('kimchi_admin_console'),
    lang('kimchi_admin_console_not_running_help'),
    $options
);

echo "</div>";

///////////////////////////////////////////////////////////////////////////////
// Form - Running
///////////////////////////////////////////////////////////////////////////////

echo "<div id='kimchi_running' style='display:none;'>";

$options['buttons']  = array(
    anchor_custom($admin_url, lang('kimchi_go_to_admin_console'), 'high', array('target' => '_blank'))
);

echo infobox_highlight(
    lang('kimchi_admin_console'),
    lang('kimchi_admin_console_help'),
    $options
);

echo "</div>";
