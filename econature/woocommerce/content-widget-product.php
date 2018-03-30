<?php 
/**
 * @package 	WordPress
 * @subpackage 	EcoNature
 * @version 	1.1.0
 */


global $product;

?>
<li>
	<a href="<?php echo esc_url( get_permalink( $product->id ) ); ?>" title="<?php echo esc_attr( $product->get_title() ); ?>">
		<?php echo $product->get_image(); ?>
		<?php echo $product->get_title(); ?>
	</a>
	<?php 
	cmsms_woocommerce_rating('cmsms-icon-star-empty', 'cmsms-icon-star-1');
	
	echo $product->get_price_html(); 
	?>
</li>