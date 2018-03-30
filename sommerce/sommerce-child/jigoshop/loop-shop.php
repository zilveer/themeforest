<?php
/**
 * Loop shop template
 *
 * DISCLAIMER
 *
 * Do not edit or add directly to this file if you wish to upgrade Jigoshop to newer
 * versions in the future. If you wish to customise Jigoshop core for your needs,
 * please use our GitHub repository to publish essential changes for consideration.
 *
 * @package             Jigoshop
 * @category            Catalog
 * @author              Jigoshop
 * @copyright           Copyright © 2011-2014 Jigoshop.
 * @license             GNU General Public License v3
 */
?>

<?php

global $columns, $post, $per_page, $wp_query, $paged;

do_action('jigoshop_before_shop_loop');

$loop = 0;

$class_li = array('product');
if ( yiw_get_option( 'shop_border_thumbnail' ) )
    $class_li[] = 'border';
if ( yiw_get_option( 'shop_shadow_thumbnail' ) )
    $class_li[] = 'shadow';
if ( ! yiw_get_option( 'shop_show_price' ) )
    $class_li[] = 'hide-price';
if ( ! yiw_get_option( 'shop_show_button_details' ) )
    $class_li[] = 'hide-details-button';
if ( ! yiw_get_option( 'shop_show_button_add_to_cart' ) )
    $class_li[] = 'hide-add-to-cart-button';

$title_position = yiw_get_option( 'shop_title_position' );

if ( ! isset( $columns ) || ! $columns ) $columns = apply_filters( 'loop_shop_columns', 3 );
if ( ! isset( $per_page ) || empty( $per_page ) ) $per_page = apply_filters('loop_shop_per_page', yiw_get_option('shop_products_per_page'));

//only start output buffering if there are products to list
if ( have_posts() ) {
	ob_start();
}

if ( have_posts()) : while ( have_posts() ) : the_post(); $_product = new jigoshop_product( $post->ID ); $loop++;
    $class= implode(' ', $class_li);
	?>
	<li class="product <?php if ($loop%$columns==0) echo 'last'; if (($loop-1)%$columns==0) echo ' first '; echo $class; ?>">

		<?php do_action('jigoshop_before_shop_loop_item'); ?>

		<a href="<?php the_permalink(); ?>">

			<?php do_action('jigoshop_before_shop_loop_item_title', $post, $_product); ?>

            <strong class="<?php echo $title_position ?>"><?php the_title(); ?></strong>

			<?php do_action('jigoshop_after_shop_loop_item_title', $post, $_product); ?>

		</a>

		<?php do_action('jigoshop_after_shop_loop_item', $post, $_product); ?>

	</li><?php

	if ( $loop == $per_page ) break;

endwhile; endif;

if ( $loop == 0 ) :

	$content = '<p class="info">'.__('No products found which match your selection.', 'jigoshop').'</p>';

else :

	$found_posts = ob_get_clean();

	$content = '<ul class="products">' . $found_posts . '</ul><div class="clear"></div>';

endif;

echo apply_filters( 'jigoshop_loop_shop_content', $content );

do_action( 'jigoshop_after_shop_loop' );
