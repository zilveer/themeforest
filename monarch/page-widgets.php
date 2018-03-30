<?php
/*
* Template Name: Page Widgets
*/
?>

<?php get_header(); ?>

<?php get_template_part( 'header-panel' ); ?>

<!-- Content -->
<div class="content fullwidth clearfix">

<div class="row">

	<!-- Main -->
	<main class="main widgets-page col-xs-12 col-sm-12 col-md-12 col-lg-7 col-bg-6" role="main">

		<div class="masonry widget-area" id="widget-area" role="complementary">
			<div class="row">
				<?php if ( is_active_sidebar( 'widgets-page' ) ) : ?>
					<?php dynamic_sidebar( 'widgets-page' ); ?>
				<?php endif; ?>
			</div>
		</div>

	</main>

</div>

</div>

<?php get_footer(); ?>