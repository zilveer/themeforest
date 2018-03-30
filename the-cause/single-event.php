<?php

/*
	@package WordPress
	@subpackage The Cause
*/

get_header('gmap');
?>

    <?php if (have_posts()) : while (have_posts()) : the_post(); ?>
    
    <?php $postID = get_the_ID(); ?>
	<?php $postTitle = get_the_title($postID); ?>
	<?php $postPermalink = get_permalink($postID); ?>
	<?php $postMeta = get_post_custom($postID); ?>
	<?php $_SESSION['postMeta'] = $postMeta; ?>

    <h2><?php echo $postTitle; ?></h2>
    
	<?php if ($postMeta['_latitude'][0] || $postMeta['_longitude'][0]) { ?>
	<div id="mapFrame">
		<div>
		<div id="event_map"></div>
		</div>
	</div>
	<?php } ?>

    <div id="post-<?php echo $postID; ?>">
	<div>   
            
    <!-- INNER content -->
    <div id="inner">

    <?php the_content(); ?>

	<?php 
	$eventPhotos = $postMeta['_event_photos'];
	if (count($eventPhotos)) { ?>
	
	<div class="horDashed"></div>
	
	<h4>Event Photos</h4>
		
    <!-- Gallery -->
    <div id="eventGallery">
    
	<?php foreach ($eventPhotos as $photo) { ?>
		<?php
		$fullImage = wp_get_attachment_image_src($photo, 'full');
		$thumb = wp_get_attachment_image_src($photo, 'thumb');
		if ($thumb[0]) {
		?>
		<div class="thumb">
        	<a href="<?php echo $fullImage[0]; ?>" rel="prettyPhoto[pp_gal]">
            	<img src="<?php echo $thumb[0]; ?>">
            </a>
        </div>
		<?php
		}
		?>
	<?php } ?>
        
    </div>
    <!-- .Gallery -->
			
	<?php } ?>
            
    </div>
    <!-- .INNER content -->
    
    <?php endwhile; endif; ?>
        
    <?php get_sidebar('event'); ?>
	        
    </div>
	        
    </div>
    

<?php
get_footer();
?>