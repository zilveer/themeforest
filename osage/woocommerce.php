<?php get_header(); ?>
<div id="body-wrapper">
	<div id="content-wrapper">
		<div id="content">
			<div id="content-main">
				<div id="content-main-inner">
					<div id="post-area" <?php post_class(); ?>>
						<div id="woo-content" class="post-section">
							<?php woocommerce_content(); ?>
							<?php wp_link_pages(); ?>
						</div><!--woo-content-->
					</div><!--post-area-->
				</div><!--content-main-inner-->
			</div><!--content-main-->
			<?php get_sidebar('woo'); ?>
		</div><!--content-->
	</div><!--content-wrapper-->
</div><!--body-wrapper-->
<?php get_footer(); ?>