<?php

/*
	@package WordPress
	@subpackage The Cause
*/

get_header();

?>

	<?php if (have_posts()) : while (have_posts()) : the_post(); ?>

	<?php $postID = get_the_ID(); $postTitle = get_the_title(); ?>
	<?php $postURL = esc_url(get_post_meta($postID, '_url', true)); ?>
	
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

	<h2><?php echo $postTitle; ?></h2>
	
	<!-- Video -->
	<div id="videos">
	
    	<div class="wide nobckg">
        	<div>
        	<a href="<?php echo ($postURL); ?>" title="<?php echo $postTitle; ?>">
            	<?php
				if (has_post_thumbnail()) {
					echo get_the_post_thumbnail($postID, 'videoWide', array('alt' => $postTitle, 'title' => $postTitle));	
				} else {
					?>
					<img src="<?php echo $postThumb; ?>" alt="<?php echo $postTitle; ?>" title="<?php echo $postTitle; ?>">
					<?php
				}				
				?>
            </a>
            </div>
            
            <div>
                <div class="newsInfo"><?php echo get_the_date('l, F jS, Y @ g:iA'); ?></div>
                <h4><?php echo $postTitle; ?></h4>
                <?php the_content(); ?>
            </div>
        </div>

	</div>
	<!-- .Video -->

    
    <?php endwhile; endif; ?>
    
    <?php wp_reset_postdata(); ?>
			
<?php
get_footer();
?>