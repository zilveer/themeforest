<?php
/**
 * Header Logo
 *
 * @package Total WordPress Theme
 * @subpackage Partials
 * @version 3.5.3
 */

// Exit if accessed directly
if ( ! defined( 'ABSPATH' ) ) {
	exit;
}

// Define variables
$logo_url     = wpex_header_logo_url();
$logo_img     = wpex_global_obj( 'header_logo' );
$overlay_logo = wpex_global_obj( 'header_overlay_logo' );
$logo_icon    = wpex_header_logo_icon();
$logo_title   = wpex_header_logo_title();

$dims   = '';
$width  = wpex_get_header_logo_width();
$height = wpex_get_header_logo_height();
$dims   = ( $width && $height ) ? ' width="'. $width .'" height="'. $height .'"' : ''; ?>

<div id="site-logo" class="<?php echo esc_attr( wpex_header_logo_classes() ); ?>">
	<div id="site-logo-inner" class="clr">
		<?php if ( $logo_img || $overlay_logo ) : ?>
			<?php
			// Custom site-wide image logo
			if ( $logo_img && ! $overlay_logo ) : ?>
				<a href="<?php echo esc_url( $logo_url ); ?>" title="<?php echo esc_attr( $logo_title ); ?>" rel="home" class="main-logo"><img src="<?php echo esc_url( $logo_img ); ?>" alt="<?php echo esc_attr( $logo_title ); ?>" data-no-retina<?php echo $dims; ?> /></a>
			<?php endif; ?>
			<?php
			// Custom header-overlay logo => Must be added on it's own HTML for easy customer tweaking
			if ( $overlay_logo ) : ?>
				<a href="<?php echo esc_url( $logo_url ); ?>" title="<?php echo esc_attr( $logo_title ); ?>" rel="home" class="overlay-header-logo"><img src="<?php echo esc_url( $overlay_logo ); ?>" alt="<?php echo esc_attr( $logo_title ); ?>" data-no-retina<?php echo $dims; ?> /></a>
			<?php endif; ?>
		<?php else : ?>
			<a href="<?php echo esc_url( $logo_url ); ?>" title="<?php echo esc_attr( $logo_title ); ?>" rel="home" class="site-logo-text"><?php echo $logo_icon; // already sanitized ?><?php echo esc_html( $logo_title ); ?></a>
		<?php endif; ?>
		<?php wpex_hook_site_logo_inner(); ?>
	</div><!-- #site-logo-inner -->
</div><!-- #site-logo -->