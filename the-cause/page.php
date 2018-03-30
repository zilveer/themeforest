<?php

/*
	@package WordPress
	@subpackage The Cause
*/

get_header('sidebar');
?>

    <?php if (have_posts()) : while (have_posts()) : the_post(); ?>
    
    <?php $postID = get_the_ID(); ?>
	<?php $postTitle = get_the_title($postID); ?>
	<?php $postPermalink = get_permalink($postID); ?>

    <h2><?php echo $postTitle; ?></h2>
    
    <div id="post-<?php echo $postID; ?>">
	<div>

    <?php get_sidebar(); ?>
	
    <!-- INNER content -->
    <div id="inner">   


    <?php $postThumbnail = tb_get_thumbnail($postID, 'dfl'); ?>
    <?php if ($postThumbnail) { ?>
	
	<?php $imageFull = wp_get_attachment_image_src( get_post_thumbnail_id($postID), 'full'); ?>
            
    <div class="doubleFramed large alignleft">
		<a href="<?php echo $imageFull[0]; ?>" title="<?php echo $postTitle; ?>">
    	<?php echo $postThumbnail; ?>
		</a>
    </div>
    <?php } ?>
    
    <?php the_content(); ?>
    
    <?php endwhile; endif; ?>

    </div>

    </div>
    </div>

<?php
get_footer();
?>