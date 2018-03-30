<?php
/**
 * The template for displaying all pages
 *
 * This is the template that displays all pages by default.
 * Please note that this is the WordPress construct of pages
 * and that other 'pages' on your WordPress site will use a
 * different template.
 *
 * @package WordPress
 * @subpackage Road_Themes
 * @since Road Themes 1.0
 */
global $road_opt;

get_header();
?>
<div class="main-container default-page">
	<header class="entry-header">
		<div class="container">
			<h1 class="entry-title"><?php the_title(); ?></h1>
		</div>
	</header>
	<div class="clearfix"></div>
	<div class="container">
		<?php road_breadcrumb(); ?>
		
		<div class="row">
			<?php if( $road_opt['sidebarse_pos']=='left'  || !isset($road_opt['sidebarse_pos']) ) :?>
				<?php get_sidebar('page'); ?>
			<?php endif; ?>
			<div class="col-xs-12 <?php if ( is_active_sidebar( 'sidebar-page' ) ) : ?>col-md-9<?php endif; ?>">
				<div class="page-content default-page">
					<?php while ( have_posts() ) : the_post(); ?>
						<?php get_template_part( 'content', 'page' ); ?>
						<?php comments_template( '', true ); ?>
					<?php endwhile; // end of the loop. ?>
				</div>
			</div>
			<?php if( $road_opt['sidebarse_pos']=='right' ) :?>
				<?php get_sidebar('page'); ?>
			<?php endif; ?>
		</div>
	</div>
</div>
<?php get_footer(); ?>