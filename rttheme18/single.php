<?php
/**
 * 
 * The template for displaying all single posts
 *
 */
global $rt_sidebar_location;
get_header(); ?>

<section class="content_block_background">
	<section id="row-<?php the_ID(); ?>" class="content_block clearfix">
		<section id="content-<?php the_ID(); ?>" <?php post_class("content ".$rt_sidebar_location[0]); ?> >		
			<div class="row">
				
				<?php do_action( "get_info_bar", apply_filters( 'get_info_bar_posts', array( "called_for" => "inside_content" ) ) ); ?>


				<?php if (have_posts()) : while (have_posts()) : the_post(); ?> 
					<?php  
						//get global post values
						$rt_global_post_values = rt_get_global_post_values( $post );
						get_template_part( '/post-contents/single-content', get_post_format() ); 
					?>
				<?php endwhile; else : ?>
					<?php get_template_part( 'content', 'none' ); ?>
				<?php endif; ?>			 
	 

				<?php if( get_option( RT_THEMESLUG ."_hide_author_info" ) ):?>
					<?php get_template_part("author","bio"); ?>
				<?php endif;?>

				<?php if( comments_open() && ! is_attachment() ):?>
					<div class='entry commententry'>
						<?php comments_template(); ?>
					</div>
				<?php endif;?>

			</div>
		</section><!-- / end section .content -->  	
		<?php get_sidebar(); ?>
	</section>
</section>

<?php get_footer(); ?>