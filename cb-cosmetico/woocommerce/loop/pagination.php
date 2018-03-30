<?php
/**
 * Pagination - Show numbered pagination for catalog pages.
 *
 * @author 		WooThemes
 * @package 	WooCommerce/Templates
 * @version     2.2.2
 */

if ( ! defined( 'ABSPATH' ) ) exit; // Exit if accessed directly

global $wp_query;
global $paged;
if ( $wp_query->max_num_pages <= 1 )
return;
require(get_template_directory().'/inc/cb-general-options.php');
if ($woo_pagi=='ajax' && $wp_query->max_num_pages!=$paged){
	?>
<div class="woo_load_container">
<?php /*echo '<pre>'; print_r($wp_query);echo '</pre>'; */?>
	<button class="load_more_products" id="load_more_products">
	<?php echo __('Load more','cb-cosmetico');?>
	</button>
</div>
	<?php

} ?>
<nav class="woocommerce-pagination"
<?php if ($woo_pagi=='ajax' && $paged==0){echo 'style="display:none"';}?>>
	<?php
	echo paginate_links( apply_filters( 'woocommerce_pagination_args', array(
'base'         => esc_url( str_replace( 999999999, '%#%', remove_query_arg( 'add-to-cart', htmlspecialchars_decode( get_pagenum_link( 999999999 ) ) ) ) ),
'format'       => '',
'current'      => max( 1, get_query_var( 'paged' ) ),
'total'        => $wp_query->max_num_pages,
'prev_text'    => '&larr;',
'next_text'    => '&rarr;',
'type'         => 'list',
'end_size'     => 3,
'mid_size'     => 3
) ));
	?> </nav>
