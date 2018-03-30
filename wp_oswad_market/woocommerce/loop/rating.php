<?php
/**
 * Loop Rating
 *
 * @author 		WooThemes
 * @package 	WooCommerce/Templates
 * @version     2.0.0
 */

if ( ! defined( 'ABSPATH' ) ) exit; // Exit if accessed directly

global $product;

if ( get_option( 'woocommerce_enable_review_rating' ) == 'no' )
	return;
	
	if( function_exists('wd_get_rating_html') ){
		$rating_html = wd_get_rating_html();
	}
	else{
		$rating_html = $product->get_rating_html();
	}
?>

<?php if ( $rating_html ) : ?>
	<?php
		$count_rating = $product->get_rating_count();
		$label = ($count_rating > 1)?__('reviews','wpdance'):__('review','wpdance');
		echo '<span class="review_count"><span>'.$count_rating.'</span> ';
		echo $label;
		echo "</span>";
	?>
	<?php echo $rating_html; ?>
<?php endif; ?>