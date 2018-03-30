<?php
/**
 * Custom WordPress password protection form output
 *
 * @package Total WordPress theme
 * @subpackage Partials
 * @version 3.5.0
 */

// Exit if accessed directly
if ( ! defined( 'ABSPATH' ) ) {
	exit;
}

// Add label based on post ID
$post_id = wpex_global_obj( 'post_id' );
$rand    = $post_id ? $post_id : rand();
$label   = 'pwbox-'. $rand;

// Main classes
$classes = 'password-protection-box clr';

// Add container for full-screen layout to center it
if ( 'full-screen' == wpex_global_obj( 'post_layout' ) ) {
	$classes .= ' container';
} ?>

<div class="<?php echo esc_attr( $classes ); ?>">
	<form action="<?php echo esc_url( site_url( 'wp-login.php?action=postpass', 'login_post' ) ); ?>" method="post">
		<h2><?php esc_html_e( 'Password Protected', 'total' ); ?></h2>
		<p><?php esc_html_e( 'This content is password protected. To view it please enter your password below:', 'total' ); ?></p>
		<input name="post_password" id="<?php echo esc_attr( $label ); ?>" type="password" size="20" maxlength="20" placeholder="<?php esc_attr_e( 'Password', 'total' ); ?>" /><input type="submit" name="Submit" value="<?php esc_attr_e( 'Submit', 'total' ); ?>" />
	</form>
</div>