<?php

/**
 * Kimchi daemon controller.
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
// B O O T S T R A P
///////////////////////////////////////////////////////////////////////////////

$bootstrap = getenv('CLEAROS_BOOTSTRAP') ? getenv('CLEAROS_BOOTSTRAP') : '/usr/clearos/framework/shared';
require_once $bootstrap . '/bootstrap.php';

///////////////////////////////////////////////////////////////////////////////
// D E P E N D E N C I E S
///////////////////////////////////////////////////////////////////////////////

use \clearos\apps\base\Daemon as Daemon_Class;

require clearos_app_base('base') . '/controllers/daemon.php';

///////////////////////////////////////////////////////////////////////////////
// C L A S S
///////////////////////////////////////////////////////////////////////////////

/**
 * Kimchi daemon controller.
 *
 * @category   apps
 * @package    kimchi
 * @subpackage controllers
 * @author     Marc Laporte
 * @copyright  2017 Marc Laporte
 * @license    http://www.gnu.org/copyleft/gpl.html GNU General Public License version 3 or later
 * @link       https://github.com/eglooca/app-kimchi
 */

class Server extends Daemon
{
    function __construct()
    {
        parent::__construct('wokd', 'kimchi');
    }

    /**
     * Status.
     *
     * @return view
     */

    function status()
    {
        header('Cache-Control: no-cache, must-revalidate');
        header('Content-type: application/json');

        $this->load->library('nginx/NGINX');
        $this->load->library('kimchi/Wok');
        $this->load->library('base/Daemon', 'libvirtd');

        $nginx_running = $this->nginx->get_running_state();
        $wok_running = $this->wok->get_running_state();
        $libvirt_running = $this->daemon->get_running_state();

        $status['status'] = ($nginx_running && $wok_running && $libvirt_running) ? Daemon_Class::STATUS_RUNNING : Daemon_Class::STATUS_STOPPED;

        echo json_encode($status);
    }

    /**
     * Start.
     *
     * @return view
     */

    function start()
    {
        $this->load->library('nginx/NGINX');
        $this->load->library('kimchi/Wok');
        $this->load->library('base/Daemon', 'libvirtd');

        try {
            $this->daemon->set_running_state(TRUE);
            $this->daemon->set_boot_state(TRUE);
        } catch (Exception $e) {
            // Keep going
        }

        try {
            $this->nginx->set_running_state(TRUE);
            $this->nginx->set_boot_state(TRUE);
        } catch (Exception $e) {
            // Keep going
        }

        try {
            $this->wok->set_running_state(TRUE);
            $this->wok->set_boot_state(TRUE);
        } catch (Exception $e) {
            // Keep going
        }

    }

    /**
     * Stop.
     *
     * @return view
     */

    function stop()
    {
        $this->load->library('nginx/NGINX');
        $this->load->library('kimchi/Wok');
        $this->load->library('base/Daemon', 'libvirtd');

        try {
            $this->wok->set_running_state(FALSE);
            $this->wok->set_boot_state(FALSE);
        } catch (Exception $e) {
            // Keep going
        }

        try {
            $this->nginx->set_running_state(FALSE);
            $this->nginx->set_boot_state(FALSE);
        } catch (Exception $e) {
            // Keep going
        }

        try {
            $this->daemon->set_running_state(FALSE);
            $this->daemon->set_boot_state(FALSE);
        } catch (Exception $e) {
            // Keep going
        }
    }
}
