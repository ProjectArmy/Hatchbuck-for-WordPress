<?php
/*
Plugin Name: Hatchbuck
Plugin URI: https://www.projectarmy.net
Description: Hatchbuck for WordPress allows you to easily embed Hatchbuck forms inside any pages or posts using simple shortcodes. Also, includes page tracking and scroll box features.     
Version: 1.4.0
Author: ProjectArmy
Author URI: https://www.projectarmy.net
Text Domain: Hatchbuck
License: GPLv3 or later
*/

/*
This program is free software; you can redistribute it and/or
modify it under the terms of the GNU General Public License
as published by the Free Software Foundation; either version 2
of the License, or (at your option) any later version.

This program is distributed in the hope that it will be useful,
but WITHOUT ANY WARRANTY; without even the implied warranty of
MERCHANTABILITY or FITNESS FOR A PARTICULAR PURPOSE.  See the
GNU General Public License for more details.

You should have received a copy of the GNU General Public License
along with this program; if not, write to the Free Software
Foundation, Inc., 51 Franklin Street, Fifth Floor, Boston, MA  02110-1301, USA.
*/

ob_start();

// error_reporting(E_ALL);
define('PLUGIN_NAME','Hatchbuck');
define('HATCHBUCK_PLUGIN_FILE',__FILE__);
define('HATCHBUCK_VERSION','1.4.0');
define('HATCHBUCK_TABLE','hatchbuck_shortcode');

require( dirname( __FILE__ ) . '/hatchbuck-functions.php' );

require( dirname( __FILE__ ) . '/add_shortcode_tynimce.php' );

require( dirname( __FILE__ ) . '/admin/addons/addons.php' );

require( dirname( __FILE__ ) . '/admin/install.php' );

require( dirname( __FILE__ ) . '/admin/menu.php' );

require( dirname( __FILE__ ) . '/shortcode-handler.php' );

require( dirname( __FILE__ ) . '/ajax-handler.php' );

require( dirname( __FILE__ ) . '/admin/uninstall.php' );

require( dirname( __FILE__ ) . '/direct_call.php' );

require( dirname( __FILE__ ) . '/hatchbuck-admin-menu.php' );

/*********** Get Started link on the Plugins page *******************/

function hatchbuck_add_settings_link( $links ) {
    $tutorial_link = '<a href="admin.php?page=hatchbuck-help">' . __( 'Tutorial' ) . '</a>';
	$settings_link = '<a href="admin.php?page=hatchbuck-manage">' . __( 'Get Started &raquo;' ) . '</a>';
    array_push( $links, $tutorial_link, $settings_link );
  	return $links;
}
$plugin = plugin_basename( __FILE__ );
add_filter( "plugin_action_links_$plugin", 'hatchbuck_add_settings_link' );

/*********** Disable Display of any kinds of errors and warnings *******************/
//Errors will be logged in hatchbuck/debug.log
error_reporting( E_ALL );
ini_set( 'display_errors', 0 );
ini_set( 'log_errors', 1 );
ini_set( 'error_log', dirname( __FILE__ ) . '/debug.log' );
?>
