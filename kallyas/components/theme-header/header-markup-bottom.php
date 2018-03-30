<?php if(! defined('ABSPATH')){ return; }
/**
 * Display Header's TOPBAR HTML markup
 * DON'T OVERRIDE THIS FILE, instead copy the header-style##.php to Kallyas Child theme (same location) and paste this markup into it;
 */

?>

<?php
	if( $check_bottom ):
?>
<div class="kl-main-header site-header-bottom-wrapper clearfix <?php echo implode(' ', $bottom_extra_classes); ?>">

	<div class="container siteheader-container">

		<?php do_action( 'zn_head__before__bottom' ); ?>

		<?php
			if(has_action('zn_head__bottom_left') || has_action('zn_head__bottom_center') || has_action('zn_head__bottom_right') || has_action('zn_head_cart_area_s8') ):
		?>
		<div class="fxb-row site-header-row site-header-bottom ">


			<div class='fxb-col fxb <?php echo zn_getFlexboxScheme($flexbox_scheme, 'bottom', 'left'); ?> site-header-col-left site-header-bottom-left'>
				<?php do_action( 'zn_head__bottom_left' ); ?>
			</div>


			<div class='fxb-col fxb <?php echo zn_getFlexboxScheme($flexbox_scheme, 'bottom', 'center'); ?> site-header-col-center site-header-bottom-center'>
				<?php do_action( 'zn_head__bottom_center' ); ?>
			</div>


			<div class='fxb-col fxb <?php echo zn_getFlexboxScheme($flexbox_scheme, 'bottom', 'right'); ?> site-header-col-right site-header-bottom-right'>
				<?php
					/**
					 * OLD HOOK
					 * @deprecated - use "zn_head__bottom_right" instead
					 * Kept for backwards compatibility
					 */
					do_action( 'zn_head_cart_area_s8' );
				?>
				<?php do_action( 'zn_head__bottom_right' ); ?>
			</div>


		</div><!-- /.site-header-bottom -->
		<?php endif; ?>

		<?php do_action( 'zn_head__after__bottom' ); ?>

	</div>
</div><!-- /.site-header-bottom-wrapper -->
<?php endif; ?>