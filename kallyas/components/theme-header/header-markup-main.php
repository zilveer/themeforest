<?php if(! defined('ABSPATH')){ return; }
/**
 * Display Header's TOPBAR HTML markup
 * DON'T OVERRIDE THIS FILE, instead copy the header-style##.php to Kallyas Child theme (same location) and paste this markup into it;
 */

?>

<?php do_action('zn_head__before__main'); ?>

<div class="fxb-row site-header-row site-header-main ">

	<div class='fxb-col fxb <?php echo zn_getFlexboxScheme($flexbox_scheme, 'main', 'left'); ?> site-header-col-left site-header-main-left'>
		<?php do_action( 'zn_head__main_left' ); ?>
	</div>

	<div class='fxb-col fxb <?php echo zn_getFlexboxScheme($flexbox_scheme, 'main', 'center'); ?> site-header-col-center site-header-main-center'>
		<?php do_action('zn_head__main_center'); ?>
	</div>

	<div class='fxb-col fxb <?php echo zn_getFlexboxScheme($flexbox_scheme, 'main', 'right'); ?> site-header-col-right site-header-main-right'>

		<div class='fxb-col fxb <?php echo zn_getFlexboxScheme($flexbox_scheme, 'main', 'right'); ?> site-header-main-right-top'>
			<?php
				/**
				 * OLD HOOK
				 * @deprecated - use "zn_head__main_right" instead
				 * Kept for backwards compatibility
				 */
				do_action( 'zn_head_cart_area_s7' );
				do_action( 'zn_head_cart_area_s9' );
				do_action( 'zn_head_right1_area_s8' );
			?>
			<?php do_action('zn_head__main_right'); ?>
		</div>

		<?php if (has_action('zn_head__main_right_ext') || has_action('zn_head_right2_area_s8') || has_action('zn_head_cart_area_s9')): ?>
		<div class='fxb-row fxb fxb-end-x fxb-center-y site-header-main-right-ext'>
			<?php
				/**
				 * OLD HOOK
				 * @deprecated - use "zn_head__main_right_ext" instead
				 * Kept for backwards compatibility
				 */
				do_action( 'zn_head_right2_area_s8' );
			?>
			<?php do_action('zn_head__main_right_ext'); ?>
		</div>
		<?php endif; ?>

	</div>

</div><!-- /.site-header-main -->

<?php do_action('zn_head__after__main'); ?>