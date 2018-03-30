<?php
/**
 * Single Product title
 *
 * @author 		WooThemes
 * @package 	WooCommerce/Templates
 * @version     2.2.10
 */

if ( ! defined( 'ABSPATH' ) ) exit; // Exit if accessed directly
//$title = get_the_title();
//$title_val = preg_replace('/\s+/', '<br>', $title);
$subtitle = get_post_meta(get_the_ID(), 'dfd_product_product_subtitle', true);

?>
<h4 itemprop="name" class="product_title text-left"><?php the_title(); ?></h4>

<?php if (!empty($subtitle)): ?>
	<div class="subtitle product-main-subtitle text-left"><?php echo $subtitle; ?></div>
<?php endif; ?>
