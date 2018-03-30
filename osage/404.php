<?php get_header(); ?>
<div id="body-wrapper">
	<div id="content-wrapper">
		<div id="content">
			<div id="content-main" class="content-full">
				<div id="post-area" itemscope itemtype="http://schema.org/Article" <?php post_class(); ?>>
					<div id="post-404">
						<h1><?php _e( 'Error', 'mvp-text' ); ?> 404!</h1>
						<?php _e( 'The page you requested does not exist or has moved.', 'mvp-text' ); ?>
					</div><!--post-404-->
				</div><!--post-area-->
			</div><!--content-main-->
		</div><!--content-->
	</div><!--content-wrapper-->
</div><!--body-wrapper-->
<?php get_footer(); ?>