<?php
/*
Plugin Name: WP.org Registration: Block Username Chars
Description: Block certain types of characters from being in usernames on registration.
Author: wordpressdotorg
Author URI: http://wordpress.org/
Version: 1.0
License: GPLv2
License URI: http://www.gnu.org/licenses/old-licenses/gpl-2.0.html
*/

/**
 * Block certain types of characters from being in usernames on registration.
 *
 * Specifically, no @ symbols.
 *
 * @param string $username Sanitized username.
 * @return string The sanitized username, after removing '@' characters.
 */
function wporg_registration_block_username_chars( $username ) {
	if ( ! $_POST || 'post' !== strtolower( $_SERVER['REQUEST_METHOD'] ) ) {
		return $username;
	}

	if ( false === strpos( $_SERVER['REQUEST_URI'], '/register.php' ) && false === strpos( $_SERVER['REQUEST_URI'], '/list/' ) ) {
		return $username;
	}

	$username = str_replace( '@', '', $username );

	return $username;					
}
add_filter( 'sanitize_user', 'wporg_registration_block_username_chars' );
