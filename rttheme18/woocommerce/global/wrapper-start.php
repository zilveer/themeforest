<?php
/**
 * Content wrappers
 *
 * @author 		WooThemes
 * @package 	WooCommerce/Templates
 * @version     1.6.4
 */

if ( ! defined( 'ABSPATH' ) ) {
	exit; // Exit if accessed directly
}


	global $rt_sidebar_location,$rt_title;
	$rt_title = get_woocommerce_page_title();  
?>

<section class="content_block_background">
<section id="row-<?php the_ID(); ?>" class="content_block clearfix">
<section id="post-<?php the_ID(); ?>"  class="content <?php echo $rt_sidebar_location[0]; ?>">		
<div class="row">
<?php do_action( "get_info_bar", apply_filters( 'get_info_bar_woocommerce', array( "called_for" => "inside_content", "display_title" => true ) ) ); ?>