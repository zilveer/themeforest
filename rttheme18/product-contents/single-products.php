<?php
# 
# rt-theme product detail page
#
global $rt_sidebar_location;
get_header();	
?>

<section class="content_block_background">
	<section id="product-<?php the_ID(); ?>" class="content_block clearfix">
		<section class="content <?php echo $rt_sidebar_location[0];?>">

			<?php get_template_part( "/product-contents/single-products", "content" ); ?>

		</section><!-- / end section .content -->  
		<?php get_sidebar(); ?>
	</section>
</section>
<?php get_footer(); ?>