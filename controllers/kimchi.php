<?php

/**
 * Kimchi controller.
 *
 * @category   apps
 * @package    kimchi
 * @subpackage controllers
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
// C L A S S
///////////////////////////////////////////////////////////////////////////////

/**
 * Kimchi controller.
 *
 * @category   apps
 * @package    kimchi
 * @subpackage controllers
 * @author     Marc Laporte
 * @copyright  2017 Marc Laporte
 * @license    http://www.gnu.org/copyleft/gpl.html GNU General Public License version 3 or later
 * @link       https://github.com/eglooca/app-kimchi
 */

class Kimchi extends ClearOS_Controller
{
    /**
     * Kimchi default controller.
     *
     * @return view
     */

    function index()
    {
        // Load dependencies
        //------------------

        $this->lang->load('kimchi');
        $this->load->library('base/Stats');


        // Load view data
        //---------------

        try {
            $compatible = $this->stats->get_cpu_vt_state();
        } catch (Exception $e) {
            $this->page->view_exception($e);
            return;
        }

        // Load views
        //-----------

        if ($compatible) {
            $views = array('kimchi/server', 'kimchi/settings');

            $this->page->view_forms($views, lang('kimchi_app_name'));
        } else {
            $this->page->view_form('kimchi/incompatible', $data, lang('kimchi_app_name'));
        }
    }
}
