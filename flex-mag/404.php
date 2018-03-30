<?php get_header(); ?>
<div id="post-main-wrap" class="left relative">
	<div id="post-left-col" class="relative">
		<div id="content-area" itemprop="articleBody" <?php post_class(); ?>>
			<div id="content-main" class="left relative">
				<div id="post-404" class="left relative">
					<h1><?php _e( 'Error', 'mvp-text' ); ?> 404!</h1>
					<p><?php _e( 'The page you requested does not exist or has moved.', 'mvp-text' ); ?></p>
				</div><!--post-404-->
			</div><!--content-main-->
		</div><!--content-area-->
	</div><!--post-left-col-->
</div><!--post-main-wrap-->
<?php get_footer(); ?>