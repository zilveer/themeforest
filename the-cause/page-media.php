<?php

/*
	@package WordPress
	@subpackage The Cause
	
	Template Name: Media
*/

get_header();

global $post;
$title = $post->post_title;

?>

<h2><?php echo $title; ?></h2>

<!-- Gallery -->
<div id="gallery" class="wide">

	<?php get_template_part('mediaSlider'); ?>

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
			<h3>Latest Media Files</h3>
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
	
	<div id="galleryThumbs">

	<?php
	
	$numberOfThumbnails = get_option('tb_gallery_thumbnail_number', DEFAULT_GALLERY_THUMBNAIL_NUMBER);
	
	$args = array();
	
	$args['post_type'] = array('tb_video', 'photo');
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
	
	$tbQuery = new WP_Query($args);
	
	?>

    <?php if ($tbQuery->have_posts()) : while ($tbQuery->have_posts()) : $tbQuery->the_post(); ?>
	
		<?php $postID = get_the_ID(); $postTitle = get_the_title(); ?>
	
    	<div class="thumbHolder">
    	<div class="thumb">
			<?php
			$postType = get_post_type();
			if ($postType == 'tb_video') {
				$tbURL = get_post_meta($postID, '_url', true);
				$prefix = '[VIDEO] ';
			} else {
				$imageFull = wp_get_attachment_image_src( get_post_thumbnail_id($postID), 'full'); 
				$tbURL = $imageFull[0];
				$prefix = '[PHOTO] ';
			}					
			?>
	        <a href="<?php echo $tbURL; ?>" title="<?php echo $postTitle; ?>">
				<?php echo get_the_post_thumbnail($page->ID, 'thumb280', array('alt' => $postTitle)); ?>
	        </a>
        </div>
        
        
        <p><?php echo $postTitle; ?></p>
        </div>

    
    <?php endwhile; endif; ?>
    
    <?php wp_reset_postdata(); ?>
	
	</div>
		
	<?php kriesi_pagination($tbQuery->max_num_pages); ?>

</div>
<!-- .Gallery -->
			
<?php
get_footer();
?>