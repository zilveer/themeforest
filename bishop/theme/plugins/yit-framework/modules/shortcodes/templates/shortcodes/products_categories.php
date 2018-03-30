<?php
/**
 * This file belongs to the YIT Plugin Framework.
 *
 * This source file is subject to the GNU GENERAL PUBLIC LICENSE (GPL 3.0)
 * that is bundled with this package in the file LICENSE.txt.
 * It is also available through the world-wide-web at this URL:
 * http://www.gnu.org/licenses/gpl-3.0.txt
 */

/**
 * Template file for list all (or limited) product categories
 *
 * @package Yithemes
 * @author Francesco Licandro <francesco.licandro@yithemes.com>
 * @since 1.0.0
 */

global $woocommerce_loop;

$animate_data = ( $animate != '' ) ? 'data-animate="' . $animate . '"' : '';
$animate_data .= ( $animation_delay != '' ) ? ' data-delay="' . $animation_delay . '"' : '';
$animate = ( $animate != '' ) ? ' yit_animate ' . $animate : '';

$ids = '';

if ( isset( $category ) && $category != '' ) {
    $ids = explode( ',', $category );
    $ids = array_map( 'trim', $ids );
    if ( in_array( '0', $ids ) ) $ids = '';
}


$hide_empty = ( ! isset($hide_empty) || $hide_empty == 'yes' ) ? 1 : 0;

if ( ! ( $show_counter ) || $show_counter == 'no' || $show_counter != 'yes' ) {
    $show_counter = '0';
}
elseif ( $show_counter == 'yes' ) {
    $show_counter = '1';
}
else {
    $show_counter = '1';
}

$args = array(
    'orderby'    => $orderby,
    'order'      => $order,
    'hide_empty' => $hide_empty,
    'include'    => $ids,
    'hierarchical' => 1,
    'taxonomy'		=> 'product_cat',
);

if ( $orderby == 'menu_order') {
    unset( $args ['orderby'], $args['order'] );
    $args ['menu_order'] = $order;
}
$terms =  get_categories( $args );

if ( $terms ) : ?>
    <div class="woocommerce <?php echo esc_attr( $animate . $vc_css ) ?>" <?php echo $animate_data ?>>
        <div class="show-category <?php echo $style ?>">
            <div class="row">
                <ul class="products">
                    <?php foreach ( $terms as $category ) {
                        wc_get_template( 'content-product_cat.php', array(
                            'category' => $category,
                            'style' => $style,
                            'show_counter'    => $show_counter,
                            'discovery_text' => $discovery_text,
                        ) );
                    } ?>
                </ul>
           </div>
        </div>
    </div>
<?php endif;

wp_reset_query();
$woocommerce_loop['loop'] = 0;
?>