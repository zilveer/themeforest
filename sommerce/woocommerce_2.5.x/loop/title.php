<?php
/**
 * Product loop title
 *
 * @author  WooThemes
 * @package WooCommerce/Templates
 * @version 2.4.0
 */

if ( ! defined( 'ABSPATH' ) ) {
	exit; // Exit if accessed directly
}

$title_position = yiw_get_option( 'shop_title_position' );
?>
<div class="thumb-shadow"></div>

<strong class="<?php echo $title_position ?>"><?php the_title(); ?></strong>