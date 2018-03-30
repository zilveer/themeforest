<?php
/**
 * The Template for displaying all single posts.
 *
 * @package progression
 */

get_header(); ?>
<div id="page-title-background">
<div id="page-title-portfolio">		
	<div class="width-container">
		<h1><?php the_title(); ?></h1>
		<div class="clearfix"></div>
	</div>
</div><!-- close #page-title -->
</div><!-- close #page-title -->

<div id="main">
	<?php while ( have_posts() ) : the_post(); ?>

		<?php get_template_part( 'content', 'single-portfolio' ); ?>

	<?php endwhile; // end of the loop. ?>
	
	<?php 
	$terms = get_the_terms( $post->ID , 'portfolio_type' ); 
   	if ( !empty( $terms ) ) :?>
	<?php get_template_part( 'related', 'portfolio-posts' ); ?>
	<?php endif;?>
	<div class="clearfix"></div>
<?php get_footer(); ?>
