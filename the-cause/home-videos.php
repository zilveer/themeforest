	<div>

	<?php

	$args3 = array();
	
	$args3['post_type'] = 'tb_video';
	$args3['post_status'] = 'publish';
	$args3['posts_per_page'] = get_option('tb_home_page_videos_no', 3);
	
	$tbQuery3 = new WP_Query($args3);
	
	?>

    <?php if ($tbQuery3->have_posts()) { ?>
        
    <h3>Latest Videos</h3>
	
	<div id="homeVideo"><div class="slides_container">
	
	<?php $videoIndex = 0; $slides = array(); ?>
	
	<?php while ($tbQuery3->have_posts()) : $tbQuery3->the_post(); ?>
	
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
		
		<?php $postContent = apply_filters('the_content', get_the_content()); ?>
		<?php $postDate = get_the_date('l, F jS, Y @ g:iA'); ?>

		<?php
		if (has_post_thumbnail()) {
			$bigThumb = get_the_post_thumbnail($postID, 'videoWide', array('alt' => $postTitle, 'title' => $postTitle));
			$smallThumb = get_the_post_thumbnail($postID, 'dfs', array('alt' => $postTitle, 'title' => $postTitle));
		} else {
			$bigThumb = '<img src="' . $postThumb . '" title="' . $postTitle . '" alt="' . $postTitle . '">';
			$smallThumb = '<img src="' . $postThumb . '" title="' . $postTitle . '" alt="' . $postTitle . '">';
		}
		?>
        
		<?php
		$slides[] = array(
			'title'		=> $postTitle,
			'url'		=> $postURL,
			'content'	=> $postContent,
			'date'		=> $postDate,
			'bigThumb'	=> $bigThumb,
			'smallThumb'=> $smallThumb
		);
		?>

		<?php $videoIndex++; ?>
    
    <?php endwhile; ?>
	
	<?php foreach ($slides as $slide) { ?>

    	<div class="video">
        	<div class="player">
	        	<a href="<?php echo $slide['url']; ?>" title="<?php echo $slide['title']; ?>">
	            	<?php echo $slide['bigThumb']; ?>
	            </a>
            </div>
            
            <div>
                <h4><?php echo $slide['title']; ?></h4>
                <div class="newsInfo"><?php echo $slide['date']; ?></div>
                
                <?php echo $slide['content']; ?>
            </div>
        </div>
				
	<?php } ?>
	

	
	</div>
	
	<ul class="videoPagination">
	<?php foreach ($slides as $slide) { ?>

    	<li><a href="#"><?php echo $slide['smallThumb']; ?></a></li>
				
	<?php } ?>
	</ul>
		
	</div>

	<script>
		jQuery(document).ready(function($){
			$('#homeVideo').slides({
				effect: 'fade',
				crossfade: true,
				fadeSpeed: 500,
				paginationClass: 'videoPagination',
				generateNextPrev: false,
				generatePagination: false,
				autoHeight: true
			});
		});
	</script>
	
	<?php } ?>
    
    <?php wp_reset_postdata(); ?>
	
	</div>