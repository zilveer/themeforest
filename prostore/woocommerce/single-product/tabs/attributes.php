<?php
/**
 * Theme Name: proStore
 * Theme URI: http://themeforest.net/user/gnrocks/portfolio
 * Theme demo : http://rchour.net/prostore
 * Description: A WordPress premium theme exclusively for sale on ThemeForest
 *
 * Author: gnrocks
 * Author URI: http://themeforest.net/user/gnrocks
 * License : http://codex.wordpress.org/GPL & http://wiki.envato.com/support/legal-terms/licensing-terms/
 *
 *
 * @package 	proStore/woocommerce/single-product/tabs/attributes.php
 * @sub-package WooCommerce/Templates/single-product/tabs/attributes.php
 * @file		1.0
 * @file(Woo)	1.6.4
 */
?>
<?php global $woocommerce, $post, $product; ?>

<?php
$show_attr = ( get_option( 'woocommerce_enable_dimension_product_attributes' ) == 'yes' ? true : false );

if ( $product->has_attributes() || ( $show_attr && $product->has_dimensions() ) || ( $show_attr && $product->has_weight() ) ) {
	?>
	<div class="panel entry-content" id="tab-attributes">

		<?php $product->list_attributes(); ?>

	</div>
	<?php
}
?>