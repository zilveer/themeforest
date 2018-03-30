<?php
/**
* The Template for displaying all single products.
*
* Override this template by copying it to yourtheme/woocommerce/single-product.php
*
* @author WooThemes
* @package WooCommerce/Templates
* @version 1.6.4
*/

if ( ! defined( 'ABSPATH' ) ) exit; // Exit if accessed directly

get_header( 'shop' ); ?>
<?php
/**
* woocommerce_before_main_content hook
*
* @hooked woocommerce_output_content_wrapper - 10 (outputs opening divs for the content)
* @hooked woocommerce_breadcrumb - 20
*/
do_action( 'woocommerce_before_main_content' );
?>

<div class="woocontent">
	<?php while ( have_posts() ) : the_post(); ?>
	
	
	<?php if(empty($hide_page_title)): ?>
	
		<span class="heading-t"></span>
		<?php
		$single_title = get_iron_option('single_shop_page_title');
		if(!empty($single_title)): 
		?>

			<h1 class="page-title"><?php echo esc_html($single_title); ?></h1>
			
		
		<?php else: ?>
			
			<h1 class="page-title"><?php woocommerce_page_title(); ?></h1>
			
		<?php endif; ?>
		<span class="heading-b"></span>


	<?php endif; ?>
	
	<h2><?php the_title(); ?></h2>
	<?php wc_get_template_part( 'content', 'single-product' ); ?>

	<?php endwhile; // end of the loop. ?>

	<?php
	/**
	* woocommerce_after_main_content hook
	*
	* @hooked woocommerce_output_content_wrapper_end - 10 (outputs closing divs for the content)
	*/
	do_action( 'woocommerce_after_main_content' );
	?>

	<?php
	/**
	* woocommerce_sidebar hook
	*
	* @hooked woocommerce_get_sidebar - 10
	*/
	//do_action( 'woocommerce_sidebar' );
	?>
</div>

<?php get_footer( 'shop' ); ?>