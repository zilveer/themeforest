<?php 
	$newsletter = ot_get_option('newsletter');
?>
<footer id="footer" role="contentinfo" class="style2">
	<div class="footer_inner row expanded align-middle">
		<div class="small-12 columns footer-menu">
			<?php if ((ot_get_option('footer_cs') == 'on') && shortcode_exists('currency_switcher')) { ?>
			<div class="select-wrapper currency_switcher"><?php do_action('currency_switcher'); ?></div>
			<?php } ?>
			<?php if (ot_get_option('footer_ls') == 'on') { do_action( 'thb_language_switcher' ); } ?>
			<?php if (has_nav_menu('footer-menu')) { ?>
			  <?php wp_nav_menu( array( 'theme_location' => 'footer-menu', 'depth' => 1, 'container' => false, 'menu_class' => 'sf-menu' ) ); ?>
			<?php } ?>
			<p><?php echo ot_get_option('copyright','Copyright 2014 NORTH ONLINE SHOPPING THEME. All RIGHTS RESERVED.'); ?> </p>
			<div class="social-links">
				<?php do_action( 'thb_'.ot_get_option('social-payment', 'payment') ); ?>
			</div>
		</div>
	</div>
</footer>