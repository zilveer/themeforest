<?php
/**
 * The Template for displaying all single products.
 *
 * Override this template by copying it to yourtheme/woocommerce/single-product.php
 *
 * @author 		WooThemes
 * @package 	WooCommerce/Templates
 * @version     99.99
 */

get_header('shop'); ?>
<div class = "outerpagewrap">
	<div class="pagewrap">
		<div class="pagecontent">
			<div class="pagecontentContent">
				<p><?php woocommerce_breadcrumb(); ?></p>
			</div>
			<div class = "portnavigation">
					<span><?php previous_post_link('%link', '<div class="portprev"><i class="fa fa-angle-right"></i><div class="link-title-previous">%title</div></div>' ,false,''); ?> </span>				
					<span><?php next_post_link('%link','<div class="portnext"><i class="fa fa-angle-left"></i><div class="link-title-next">%title</div></div>',false,''); ?> </span>

			</div>
		</div>

	</div>
</div>

	<div class="mainwrap homewrap" >

		<div class="main clearfix" >		
			<div class="content fullwidth">
			<?php

					
					do_action( 'woocommerce_before_single_buler' );
				?>
				<?php while ( have_posts() ) : the_post(); ?>

					<?php woocommerce_get_template_part( 'content', 'single-product' ); ?>

				<?php endwhile; // end of the loop. ?>

			</div>
	

		</div>
	</div>

<?php get_footer('shop'); ?>