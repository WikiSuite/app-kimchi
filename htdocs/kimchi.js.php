<?php

/**
 * Kimchi ajax helpers.
 *
 * @category   apps
 * @package    kimchi
 * @subpackage javascript
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
// T R A N S L A T I O N S
///////////////////////////////////////////////////////////////////////////////

clearos_load_language('kimchi');

///////////////////////////////////////////////////////////////////////////////
// J A V A S C R I P T
///////////////////////////////////////////////////////////////////////////////

header('Content-Type:application/x-javascript');
?>

///////////////////////////////////////////////////////////////////////////
// M A I N
///////////////////////////////////////////////////////////////////////////

$(document).ready(function() {
    $('#kimchi_not_running').hide();
    $('#kimchi_running').hide();

    getKimchiStatus();
});


// Functions
//----------

function getKimchiStatus() {
    $.ajax({
        url: '/app/kimchi/server/status',
        method: 'GET',
        dataType: 'json',
        success : function(payload) {
            if (payload.status == 'running') {
                $('#kimchi_not_running').hide();
                $('#kimchi_running').show();
            } else {
                $('#kimchi_not_running').show();
                $('#kimchi_running').hide();
            }
            window.setTimeout(getKimchiStatus, 1000);
        },
        error: function (XMLHttpRequest, textStatus, errorThrown) {
            window.setTimeout(getKimchiStatus, 1000);
        }
    });
}

// vim: syntax=javascript
