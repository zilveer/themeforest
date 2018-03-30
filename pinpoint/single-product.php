<?php	
	/**
	 * The Template for displaying all single products.
	 *
	 * Override this template by copying it to yourtheme/woocommerce/single-product.php
	 *
	 * @author 		WooThemes
	 * @package 	WooCommerce/Templates
	 * @version     2.1.2
	 */	
	
?>

<?php get_header(); ?>

<?php
	$options = get_option('sf_pinpoint_options');
	$page_layout = $options['page_layout'];
?>

<?php if (have_posts()) : the_post(); ?>

	<div class="page-heading full-width clearfix">
		<?php if ($page_layout == "fullwidth") { ?>
		<div class="container">
		<div class="sixteen columns">
		<?php } ?>
		<h1><?php the_title(); ?></h1>
		<?php if ($page_layout == "fullwidth") { ?>
		</div>
		</div>
		<?php } ?>
	</div>

	<?php if ($page_layout == "fullwidth") { ?>
	<div class="container">
	<div class="sixteen columns">
	<?php } ?>
	
	
	<div class="inner-page-wrap has-no-sidebar clearfix">
	
		<!-- OPEN article -->
		<article <?php post_class('clearfix'); ?> id="<?php the_ID(); ?>">

			<div class="page-content clearfix">
				
				<section class="article-body-wrap">
					
					<?php woocommerce_get_template_part( 'content', 'single-product' ); ?>
						
				</section>
									
			</div>
		
		<!-- CLOSE article -->
		</article>
				
	</div>
	
	<?php if ($page_layout == "fullwidth") { ?>
	</div>
	</div>
	<?php } ?>

<?php endif; ?>

<!-- WordPress Hook -->
<?php get_footer(); ?>