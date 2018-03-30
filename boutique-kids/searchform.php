<?php
/**
 * The template for displaying search forms in boutique
 *
 * @package WordPress
 * @subpackage boutique
 * @since boutique 1.0
 */

if ( ! defined( 'ABSPATH' ) ) exit;

?>
	<form method="get" class="searchform" action="<?php echo esc_url( home_url( '/' ) ); ?>">
		<label for="s" class="assistive-text"><?php esc_html_e( 'Search', 'boutique-kids' ); ?></label>
		<input type="text" class="field searchstring" name="s" id="s" placeholder="<?php esc_html_e( 'Search', 'boutique-kids' ); ?>" />
		<input type="submit" class="searchsubmit" name="submit" value="<?php esc_attr_e( 'Go', 'boutique-kids' ); ?>" />
	</form>
