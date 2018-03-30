<?php
/**
 * 
 * The template for displaying all pages
 *
 */
global $rt_sidebar_location;
get_header(); ?>
<section class="content_block_background">
	<section id="row-<?php the_ID(); ?>" class="content_block clearfix">
		<section id="post-<?php the_ID(); ?>" <?php post_class("content ".$rt_sidebar_location[0]); ?> >		
			<div class="row">
				<?php do_action( "get_info_bar", apply_filters( 'get_info_bar_pages', array( "called_for" => "inside_content" ) ) ); ?>

				<?php get_template_part( 'content', 'page' ); ?>

				<?php if(comments_open() && get_option(RT_THEMESLUG."_allow_page_comments")):?>
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