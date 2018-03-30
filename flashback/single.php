<?php

get_header();

$post_thumb = wp_get_attachment_image_src(get_post_thumbnail_id(), "single-thumb");
$full = wp_get_attachment_image_src(get_post_thumbnail_id(), "fullsize");
$video_embed = get_post_meta(get_the_ID(), "si_video_embed", true);

while (have_posts()) : the_post();

?>

<div id="page-<?php the_ID(); ?>" class="inner inner-post">
			
	<?php if ( has_post_thumbnail() ) : ?>
				
		<div class="post_thumb">
		
			<a href="<?php echo $full[0]; ?>" title="<?php the_title(); ?>" class="pretty prettyPhoto[posts]"><?php the_post_thumbnail(); ?></a>
			
		</div>
	
	<?php elseif ($video_embed != "") : ?>
	
		<div class="post_video">
		
			<?php echo stripslashes(htmlspecialchars_decode($video_embed)); ?>
			
		</div>
		
	<?php endif; ?>
	
	<h2 id="page_title" class="post_title"><a href="<?php the_permalink(); ?>"><?php the_title(); ?></a></h2>
	
	<div class="post_date">
	
		<h6 class="day"><?php _e("On", "shorti"); ?>: <?php the_time("F j, Y"); ?></h6>
	
	</div>
	
	<div class="list_cats">
	
		<h6 class="list_cats_title"><?php _e("In", "shorti"); ?>: </h6>
		<?php the_category(); ?>
	
	</div>
	
	<div class="post_content">
	
		<?php the_content(); ?>
	
	</div>

	<?php comments_template('', true); ?>
		
</div>

<?php endwhile; ?>

<?php get_footer(); ?>