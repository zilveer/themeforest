<?php

/*
	@package WordPress
	@subpackage The Cause
	
	Template Name: Video 4 Columns
*/

get_header();

global $post;
$title = $post->post_title;

?>

<h2><?php echo $title; ?></h2>

<!-- Video -->
<div id="videos" class="wide">

	<?php get_template_part('videoSlider'); ?>

	<?php
	$mediaLinksArray = array();
	$mediaPage = get_option('tb_page_media');
	$galleryPage = get_option('tb_page_gallery');
	$videoPage = get_option('tb_page_video');
	
	$mediaLinksArray[] = '<ul>';
	if ($mediaPage) {$mediaLinksArray[] = '<li><a href="' . get_permalink($mediaPage) . '" title="All Media Files">All</a></li>';}
	if ($galleryPage) {$mediaLinksArray[] = '<li><a href="' . get_permalink($galleryPage) . '" title="Latest Photos">Photos</a></li>';}
	if ($videoPage) {$mediaLinksArray[] = '<li><a href="' . get_permalink($videoPage) . '" title="Latest Videos">Videos</a></li>';}
	$mediaLinksArray[] = '</ul>';
	
	if (count($mediaLinksArray) > 3) {
		?>		
		<div id="mediaLinks">
			<h3>Latest Videos</h3>
			<?php
			foreach ($mediaLinksArray as $mediaLinksSingle) {
				echo $mediaLinksSingle;
			}
			?>
		</div>
		<div class="horShadow"></div>
		<?php
	}
	?>
	
	<?php
	
	$numberOfThumbnails = get_option('tb_video_4c_thumbs', DEFAULT_VIDEO_4C);
	
	$args = array();
	
	$args['post_type'] = 'tb_video';
	$args['post_status'] = 'publish';
	$args['posts_per_page'] = $numberOfThumbnails;

	if (get_query_var('paged')) {
		$paged = get_query_var('paged');
	} elseif (get_query_var('page')) {
		$paged = get_query_var('page');
	} else {
		$paged = 1;
	}
	
	$args['paged'] = $paged; 
	
	$thumbIndex = 1;
	
	$tbQuery = new WP_Query($args);
	
	?>

	<div id="videoThumbs">
    <?php if ($tbQuery->have_posts()) : while ($tbQuery->have_posts()) : $tbQuery->the_post(); ?>
	
		<?php $postID = get_the_ID(); $postTitle = get_the_title(); ?>
		<?php $postURL = get_post_meta($postID, '_url', true); ?>
	
		<?php
		if (strpos($postURL, 'youtu')) {
			$videoID = tb_get_youtube_id($postURL);
			$postThumb = tb_get_youtube_thumb($videoID);
			$postURL = "http://www.youtube.com/watch?v=$videoID";
		} elseif (strpos($postURL, 'vimeo')) {
			$videoID = tb_get_vimeo_id($postURL);
			$postThumb = tb_get_vimeo_thumb($videoID);
			$postURL = "http://www.vimeo.com/$videoID";
		} else {
		}
		?>

		<div class="thumb <?php if ($thumbIndex == 4) {echo 'last'; } ?>">
	    	<div>
        	<a href="<?php echo esc_url($postURL); ?>" title="<?php echo $postTitle; ?>">
            	<?php
				if (has_post_thumbnail()) {
					echo get_the_post_thumbnail($postID, 'video', array('alt' => $postTitle, 'title' => $postTitle));	
				} else {
					?>
					<img src="<?php echo $postThumb; ?>" alt="<?php echo $postTitle; ?>" title="<?php echo $postTitle; ?>">
					<?php
				}				
				?>
            </a>
	        </div>
	        
	        <h4><?php echo $postTitle; ?></h4>
	    </div>
		
		<?php if ($thumbIndex == 4) {$thumbIndex = 0; echo '<div class="clear"></div>'; }
		
		$thumbIndex++;
		?>
    
	<?php endwhile; endif; ?>
    
    <?php wp_reset_postdata(); ?>
	
	</div>
		
	<?php kriesi_pagination($tbQuery->max_num_pages); ?>

</div>
<!-- .Video -->
			
<?php
get_footer();
?>