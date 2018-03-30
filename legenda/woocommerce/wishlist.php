
<?php
/**
 * Wishlist pages template; load template parts basing on the url
 *
 * @author Your Inspiration Themes
 * @package YITH WooCommerce Wishlist
 * @version 2.0.0
 */

global $wpdb, $woocommerce;
extract(etheme_account_sidebar());

// Start wishlist page printing
if( function_exists( 'wc_print_notices' ) ) {
    wc_print_notices();
}
else{
    $woocommerce->show_messages();
}
?>
<div id="yith-wcwl-messages"></div>

<div class="row-fluid">
	<?php if ($sidebar): ?>
		<div class="span3">
			<?php 

				do_action('etheme_before_account_sidebar');

				if ( has_nav_menu( 'account-menu' ) ) : ?>
					<?php wp_nav_menu(array(
						'theme_location' => 'account-menu',
						'before' => '',
						'after' => '',
						'link_before' => '',
						'container_class' => 'widget_nav_menu',
						'link_after' => '',
						'depth' => 4,
						'fallback_cb' => false
					)); ?>
				<?php else: ?>
					<br>
                    <h4 class="a-center install-menu-info">Set your account menu in <em>Apperance &gt; Menus</em></h4>
				<?php endif;

			?>
		</div>
	<?php endif ?>
	<div class="span<?php echo $span; ?>">
		<?php yith_wcwl_get_template( 'wishlist-' . $template_part . '.php', $atts ) ?>
	</div>
</div>


