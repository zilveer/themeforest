<?php get_header(); ?>

<div id="main">
	<div id="content-wrapper">
		<div class="breadcrumb">
			<?php if (function_exists('dimox_breadcrumbs')) dimox_breadcrumbs(); ?>
		</div><!--breadcrumb-->
		<div id="home-main" class="full">
			<div id="post-area">
				<div id="post-404">
					<h1><?php _e( 'Error', 'mvp-text' ); ?> 404!</h1>
					<?php _e( 'The page you requested does not exist or has moved.', 'mvp-text' ); ?>
				</div><!--post-404-->
			</div><!--post-area-->
		</div><!--home-main-->
<?php get_footer(); ?>