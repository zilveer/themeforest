<?php 
/**
 * Template Name: Homepage + Blank
 *
 * @package Magzilla
 * @since 	Magzilla 1.0
**/
global $fave_container;

get_header(); ?>

<div class="<?php echo $fave_container; ?>">
	<div class="row">
		
		<div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
			
			<?php while( have_posts()): the_post(); ?>

				<?php the_content(); ?>
	        
	        <?php endwhile; ?>
			
		</div><!-- col-lg-12 col-md-12 col-sm-12 col-xs-12 -->

	</div><!-- .row -->
</div>

<?php get_footer(); ?>