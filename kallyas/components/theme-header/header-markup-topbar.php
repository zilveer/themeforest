<?php if(! defined('ABSPATH')){ return; }
/**
 * Display Header's TOPBAR HTML markup
 * DON'T OVERRIDE THIS FILE, instead copy the header-style##.php to Kallyas Child theme (same location) and paste this markup into it;
 */

?>

<?php
	/**
	 * Check for TOP HEADER hooks, to display the header
	 */
	if ( $check_top ):
?>

	<?php do_action('zn_head__before__top'); ?>

	<div class="fxb-row site-header-row site-header-top ">

		<div class='fxb-col fxb <?php echo zn_getFlexboxScheme($flexbox_scheme, 'top', 'left'); ?> site-header-col-left site-header-top-left'>
			<?php do_action( 'zn_head__top_left' ); ?>
			<?php
				/**
				 * OLD HOOKS
				 * @deprecated - use "zn_head__top_left" instead
				 * Kept for backwards compatibility
				 */
				do_action( 'zn_head_left_area' );
				do_action( 'zn_head_left_area_s7' );
				do_action( 'zn_head_left_area_s9' );
			?>
		</div>

		<div class='fxb-col fxb <?php echo zn_getFlexboxScheme($flexbox_scheme, 'top', 'right'); ?> site-header-col-right site-header-top-right'>
			<?php
				/**
				 * OLD HOOKS
				 * @deprecated - use "zn_head__top_right" instead
				 * Kept for backwards compatibility
				 */
				do_action( 'zn_head_right_area_s9' );
				do_action( 'zn_head_right_area_s7' );
				do_action( 'zn_head_right_area' );
			?>
			<?php do_action( 'zn_head__top_right' ); ?>
		</div>

	</div><!-- /.site-header-top -->

	<?php do_action('zn_head__after__top'); ?>

<?php endif; ?>