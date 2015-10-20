<?php
/*
Plugin Name: WP.org Registration: Log New User
Description: Logs new user registrations into a file.
Author: wordpressdotorg
Author URI: http://wordpress.org/
Version: 1.0
License: GPLv2
License URI: http://www.gnu.org/licenses/old-licenses/gpl-2.0.html
*/

/**
 * Logs new user registrations into /tmp/bb-registration.log.
 *
 * @param int $user_id User ID.
 */
function wporg_log_new_user( $user_id ) {
	$user = get_userdata( $user_id );

	$ip   = $_SERVER['REMOTE_ADDR'];
	$line = "$ip,$user->ID,$user->user_login,$user->user_email,$user->user_registered\n";

	$log = fopen( '/tmp/bb-registration.log', 'a' );
	if ( ! $log ) {
		return false;
	}

	fwrite( $log, $line );
	fclose( $log );
}
add_action( 'user_register', 'wporg_log_new_user' );
