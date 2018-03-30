<?php
/**
 * 
 * The template for displaying all pages.
 *
 */
global $rt_sidebar_location;
?>
 	
<div class="row">
	

<?php do_action( "get_info_bar", apply_filters( 'get_info_bar_staff', array( "called_for" => "inside_content" ) ) ); ?>

<?php if ( have_posts() ) : ?> 

		<?php /* The loop */ ?>
		<?php while ( have_posts() ) : the_post(); ?>		
			
			<?php if ( has_post_thumbnail() && ! post_password_required() ) : 

				// Create thumbnail image
				$thumbnail_image_output = get_resized_image_output( array( "image_url" => "", "image_id" => get_post_thumbnail_id(), "w" => 500, "h" => 100000, "crop" => "" ) ); 
			?>								
				<div class="entry-thumbnail alignleft">
					<?php echo $thumbnail_image_output; ?>
					<?php echo '<div class="staff-single-media-links aligncenter">'.rt_staff_media_links(get_the_ID()).'</div>'; ?>
				</div>
			<?php endif; ?>		
			
			<?php the_content(); ?>

			
			<?php echo ! has_post_thumbnail() ?  '<div class="staff-single-media-links aligncenter">'.rt_staff_media_links(get_the_ID()).'</div>' : "" ; ?>

			<?php wp_link_pages( array( 'before' => '<div class="page-links"><span class="page-links-title">' . __( 'Pages:', 'rt_theme' ) . '</span>', 'after' => '</div>', 'link_before' => '<span>', 'link_after' => '</span>' ) ); ?>			
		<?php endwhile; ?>		

	<?php else : ?>
		<?php get_template_part( 'content', 'none' ); ?>
	<?php endif; ?>

<?php if(comments_open() && get_option(RT_THEMESLUG."_allow_page_comments")):?>
	<div class='entry commententry'>
		<?php comments_template(); ?>
	</div>
<?php endif;?>


</div> 