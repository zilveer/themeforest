<?php
# 
# rt-theme portfolio detail page
#
global $rt_sidebar_location;

//get post format
$portfolio_format = get_post_meta( $post->ID, RT_COMMON_THEMESLUG.'_portfolio_post_format', true);

?>

	<?php if ( have_posts() ) : ?> 

		<?php /* The loop */ ?>
		<?php while ( have_posts() ) : the_post(); ?>

			<div class="row clearfix">

				<?php if ( ! post_password_required() ) : ?>
				<?php get_template_part( 'portfolio-contents/content', $portfolio_format ); ?>
				<div class="clearfix margin-b20"></div>
				<?php endif; ?> 

				<?php 
					//get project details - for full width page
					if( $rt_sidebar_location[0] == "full" ){
						do_action( "get_project_details");
					}
				?>

				<?php the_content(); ?>
				<?php wp_link_pages( array( 'before' => '<div class="page-links"><span class="page-links-title">' . __( 'Pages:', 'rt_theme' ) . '</span>', 'after' => '</div>', 'link_before' => '<span>', 'link_after' => '</span>' ) ); ?>			

				<?php 
					//get project navigation - for full width page
					if( $rt_sidebar_location[0] == "full" ){
						do_action( "get_post_navigation");
					}
				?>				

			</div>

		<?php endwhile; ?>		

		<?php if(comments_open() && get_option(RT_THEMESLUG."_portfolio_comments")):?>
			<div class="row clearfix">
				<div class='entry commententry'>
				    <?php comments_template(); ?>
				</div>
			</div>
		<?php endif;?>

	<?php else : ?>
		<?php get_template_part( 'content', 'none' ); ?>
	<?php endif; ?>	
