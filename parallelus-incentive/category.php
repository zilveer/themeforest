<?php
/**
 * The template for displaying Category pages.
 */

get_header(); ?>

	<section id="primary" class="site-content">
		<div id="content" role="main">

			<header class="archive-header">
				<h1 class="archive-title"><?php echo single_cat_title( '', false ); ?></h1>
			</header><!-- .archive-header -->

			<?php 

			if ( have_posts() ) :
				get_template_part( 'templates/blog' );
			endif; 

			?>
		</div><!-- #content -->
	</section><!-- #primary -->

<?php get_sidebar(); ?>
<?php get_footer(); ?>