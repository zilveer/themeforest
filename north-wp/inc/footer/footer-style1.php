<?php 
	$newsletter = ot_get_option('newsletter');
	$footer_products = ot_get_option('footer_products');
?>
<footer id="footer" role="contentinfo" class="style1">
	<div class="footer_inner row expanded align-middle">
		<div class="small-12 medium-6 large-4 columns footer-menu">
			<?php if ((ot_get_option('footer_cs') == 'on') && shortcode_exists('currency_switcher')) { ?>
			<div class="select-wrapper currency_switcher"><?php do_action('currency_switcher'); ?></div>
			<?php } ?>
			<?php if (ot_get_option('footer_ls') == 'on') { do_action( 'thb_language_switcher' ); } ?>
			<?php if (has_nav_menu('footer-menu')) { ?>
			  <?php wp_nav_menu( array( 'theme_location' => 'footer-menu', 'depth' => 1, 'container' => false, 'menu_class' => 'sf-menu' ) ); ?>
			<?php } ?>
			<p><?php echo ot_get_option('copyright','Copyright 2014 NORTH ONLINE SHOPPING THEME. All RIGHTS RESERVED.'); ?> </p>
		</div>
		<div class="small-12 large-4 columns footer-toggle show-for-large">
			<?php if ($footer_products != 'off') { ?>
			<a href="#" id="footer-toggle"><i class="fa fa-circle-o"></i> <i class="fa fa-circle-o"></i> <i class="fa fa-circle-o"></i><br><?php _e('QUICK SHOP', 'north'); ?></a>
			<?php } ?>
		</div>
		<div class="small-12 medium-6 large-4 columns social-links hide-for-small">
			<?php do_action( 'thb_'.ot_get_option('social-payment', 'payment') ); ?>
		</div>
		<?php if ($footer_products != 'off') { do_action('thb_footer_products'); } ?>
	</div>
</footer>