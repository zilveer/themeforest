<?php

/**
 * The template for displaying pages
 *
 * This is the template that displays all pages by default.
 * Please note that this is the WordPress construct of pages and that
 * other "pages" on your WordPress site will use a different template.
 *
 * @package WordPress
 * @subpackage Monarch
 * @since Monarch 1.0
 */
   
get_header(); ?>

<?php get_template_part( 'header-panel' ); ?>

<!-- Content -->
<div class="content with-sb buddypress clearfix">

	<!-- Main -->
	<main class="main col-xs-12 col-sm-12 col-md-12 col-lg-8 col-bg-8" role="main">
		<?php while ( have_posts() ) : the_post(); ?>
		<div <?php post_class(); ?> >
			<div class="post-wrap buddypress">

				<header class="page-header buddypress">
					<?php the_title( '<h1 class="page-title">', '</h1>' ); ?>
				</header>

				<div class="timeline"></div>

				<div class="timeline-wrapper">
					<div class="timeline-badge"><i class="ion-chatbox-working"></i></div>
						<?php the_content(); ?>
					<div class="timeline-badge bottom"><i class="ion-chatbox-working"></i></div>
				</div>
				
			</div>
		</div>
		<?php endwhile; ?>
	</main>

	<!-- Sidebar bbPress -->
	<?php if ( is_active_sidebar( 'sidebar-bb' ) ) : ?>
	<aside class="sidebar widget-area col-xs-12 col-sm-12 col-md-12 col-lg-4 col-bg-4" id="widget-area" role="complementary">
		<div class="masonry">
			<?php if ( is_active_sidebar( 'sidebar-bb' ) ) : ?>
				<?php dynamic_sidebar( 'sidebar-bb' ); ?>
			<?php endif; ?>
		</div>
	</aside>
	<?php endif; ?>

</div>

<?php get_footer(); ?>