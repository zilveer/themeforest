<?php get_header(); ?>
<div id="post-main-wrap" class="left relative">
	<div class="post-wrap-out1">
		<div class="post-wrap-in1">
			<div id="post-left-col" class="relative">
				<div id="content-area" itemprop="articleBody" <?php post_class(); ?>>
					<?php if(is_single()) { if (have_posts()) : while (have_posts()) : the_post(); ?>
						<?php woocommerce_breadcrumb(); ?>
					<?php endwhile; endif; } else { ?>
						<?php woocommerce_breadcrumb(); ?>
					<?php } ?>
					<div id="woo-content">
						<?php woocommerce_content(); ?>
						<?php wp_link_pages(); ?>
					</div><!--woo-content-->
				</div><!--content-area-->
			</div><!--post-left-col-->
		</div><!--post-wrap-in1-->
		<div id="post-right-col" class="relative">
			<?php get_sidebar('woo'); ?>
		</div><!--post-right-col-->
	</div><!--post-wrap-out1-->
</div><!--post-main-wrap-->
<?php get_footer(); ?>