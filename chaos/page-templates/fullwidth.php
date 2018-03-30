<?php
/**
 * Template Name: Full Width
 *
 * Description: Full Width page template
 *
 * @package WordPress
 * @subpackage Road_Themes
 * @since Road Themes 1.0
 */
global $road_opt;

get_header();
?>
<div class="main-container full-width">

	<header class="entry-header">
		<div class="container">
			<h1 class="entry-title"><?php the_title(); ?></h1>
		</div>
	</header>
	
	<div class="page-content">
		<div class="container">

			<?php road_breadcrumb(); ?>
			
			<?php while ( have_posts() ) : the_post(); ?>
				<?php get_template_part( 'content', 'page' ); ?>
				<?php comments_template( '', true ); ?>
			<?php endwhile; // end of the loop. ?>
			
		</div>
	</div>
</div>
<?php get_footer(); ?>