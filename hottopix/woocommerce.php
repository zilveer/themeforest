<?php get_header(); ?>

<div id="main">
	<div id="content-wrapper">
		<div class="mvp-cont-out">
			<div class="mvp-cont-in">
		<div id="home-main">
			<div id="post-area" <?php post_class(); ?>>
				<div id="woo-content">
					<?php woocommerce_content(); ?>
					<?php wp_link_pages(); ?>
				</div><!--woo-content-->
			</div><!--post-area-->
		</div><!--home-main-->
	</div><!--mvp-cont-in-->
<?php get_sidebar('woo'); ?>
</div><!--mvp-cont-out-->
<?php get_footer(); ?>