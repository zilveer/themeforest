<?php
/**
 * Created by PhpStorm.
 * User: Administrator
 * Date: 9/29/2015
 * Time: 2:54 PM
 */
?>

<?php if  ((in_array('yith-woocommerce-compare/init.php', apply_filters('active_plugins', get_option('active_plugins')))) || (in_array('yith-woocommerce-wishlist/init.php', apply_filters('active_plugins', get_option('active_plugins'))) && (get_option( 'yith_wcwl_enabled' ) == 'yes'))) :  ?>
	<div class="single-product-function">
		<?php if (in_array('yith-woocommerce-wishlist/init.php', apply_filters('active_plugins', get_option('active_plugins'))) && (get_option( 'yith_wcwl_enabled' ) == 'yes')) {
			echo do_shortcode('[yith_wcwl_add_to_wishlist]');
		} ?>

		<?php if (in_array('yith-woocommerce-compare/init.php', apply_filters('active_plugins', get_option('active_plugins')))): ?>
			<a title="<?php esc_html_e('Compare', 'g5plus-handmade') ?>" href="<?php the_permalink(); ?>?action=yith-woocompare-add-product&amp;id=<?php the_ID(); ?>"
			   class="compare" data-product_id="<?php the_ID(); ?>"><i class="fa fa-exchange"></i> <?php esc_html_e('Compare', 'g5plus-handmade') ?></a>
		<?php endif; ?>

	</div>
<?php endif; ?>



