<?php
// Template Name: Full Width
/**
 *
 * @package progression
 * @since progression 1.0
 */

get_header(); ?>
<?php if(get_post_meta($post->ID, 'progression_category_slug', true)): ?><?php else: ?>
<div id="page-title-background">
<div id="page-title">		
	<div class="width-container">
		<h1><?php the_title(); ?></h1>
		<?php if(get_post_meta($post->ID, 'progression_sub_headline', true)): ?>
			<div id="page-title-description"><?php echo get_post_meta($post->ID, 'progression_sub_headline', true); ?></div>
		<?php endif; ?>
		<div class="clearfix"></div>
	</div>
</div><!-- close #page-title -->
</div><!-- close #page-title-background -->
<?php endif; ?> 
<div id="main">
	<div class="width-container">
		<div id="full-width-progression">
			<?php while ( have_posts() ) : the_post(); ?>
				<?php get_template_part( 'content', 'page' ); ?>
			<?php endwhile; // end of the loop. ?>
		<div class="clearfix"></div>
		</div>
	</div><!-- close .width-container -->
<?php get_footer(); ?>