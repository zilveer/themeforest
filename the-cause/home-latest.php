	<div>
	<h3>Latest News</h3>
	
	<?php
	$args = array();
	
	$args['post_type'] = 'post';
	$args['post_status'] = 'publish';
	$args['posts_per_page'] = get_option('tb_home_page_latest_posts_no', 5);
	
	$tbQuery = new WP_Query($args);
	$latestIndex = 1;
	
	if ($tbQuery->have_posts()) : while ($tbQuery->have_posts()) : $tbQuery->the_post();
	?>
	
    <?php $postID = get_the_ID(); ?>
    <?php $postTitle = get_the_title($postID); ?>
    <?php $postPermalink = get_permalink($postID); ?>
	
	<?php
	if ($latestIndex == 1) {
		$newsClass = 'news dfw';
		$tSize = 'dfw';
	} else {
		$newsClass = 'news dfs';
		$tSize = 'dfs';
	}
	
	$imageThumbnail = wp_get_attachment_image_src( get_post_thumbnail_id(), $tSize);
	
	if (!$imageThumbnail) {
		$newsClass = 'news';
	}
	
	?>
	
    <div class="<?php echo $newsClass; ?>">
			
			<?php if ($imageThumbnail) { ?>
			<div class="frame">
				<div>
				<a href="<?php echo $postPermalink; ?>" title="<?php echo $postTitle; ?>"><?php echo $postTitle; ?></a>
				<span class="image" style="background-image: url('<?php	echo $imageThumbnail[0]; ?>');"></span>
				<span class="paperClip"></span>
				
				<div>
				
				<strong><?php echo get_the_date('j'); ?></strong><br>
				<?php echo get_the_date('M'); ?>
				
				</div>
				</div>
			</div>
			<?php } ?>
			
			<div class="excerpt">
			<h4>
				<a href="<?php echo $postPermalink; ?>" title="<?php echo $postTitle; ?>"><?php echo $postTitle; ?></a>
			</h4>
			
			<p class="newsInfo">posted under: <?php the_category(', '); ?></p>
						
			<?php the_excerpt(); ?>
			</div>
			
	</div>
	
	<?php $latestIndex++; ?>
    
    <?php endwhile; endif; ?>
    
    <?php wp_reset_postdata(); ?>
	
	</div>