<?php

get_header();

?>
	
<div id="search-page" class="inner inner-post">
	
	<!-- #page_title -->
	<h1 id="page_title"><?php printf( __( 'Results found for "%s"', "shorti" ), "<span>" . get_search_query() . "</span>" ); ?></h1>
	
	<!--// BEGIN POSTS //-->
	<div class="clearfix">
	
	<?php
	
	if (have_posts()) : while (have_posts()) : the_post();
	
	$post_thumb = wp_get_attachment_image_src(get_post_thumbnail_id(), "single-thumb");
	$full = wp_get_attachment_image_src(get_post_thumbnail_id(), "fullsize");
	$video_embed = get_post_meta(get_the_ID(), "si_video_embed", true);
	
	?>
	
	
		<div class="search_item">
		
			<?php if ( has_post_thumbnail() ) : ?>
				
				<div class="post_thumb">
				
					<a href="<?php echo $full[0]; ?>" title="<?php the_title(); ?>" class="pretty prettyPhoto[posts]"><?php the_post_thumbnail(); ?></a>
					
				</div>
			
			<?php elseif ($video_embed != "") : ?>
			
				<div class="post_video">
				
					<?php echo stripslashes(htmlspecialchars_decode($video_embed)); ?>
					
				</div>
			
			<?php else : ?>
			
				<p><?php _e("No media", "shorti") ?></p>
				
			<?php endif; ?>
			
			<h2 class="post_title"><a href="<?php the_permalink(); ?>"><?php the_title(); ?></a></h2>
			
			<div class="post_date">
			
				<h6 class="day"><?php _e("On", "shorti"); ?>: <?php the_time("F j, Y"); ?></h6>
				
			</div>
			
			<div class="post_content">
			
				<?php the_excerpt(); ?>
			
			</div>
		
		</div>

	<?php endwhile; endif; wp_reset_query(); ?>
	
	</div>
	<!--// BEGIN POSTS //-->

</div>

<?php get_footer(); ?>