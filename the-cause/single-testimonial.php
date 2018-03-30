<?php

/*
	@package WordPress
	@subpackage The Cause
*/

get_header();

?>

	<?php if (have_posts()) : while (have_posts()) : the_post(); ?>

	<?php $postID = get_the_ID(); $postTitle = get_the_title(); ?>
	<?php $postName = get_post_meta($postID, '_name', true); ?>

	<h2><?php echo $postTitle; ?></h2>
	
    <div id="post-<?php echo $postID; ?>">
    
    <blockquote>
	<p><strong><?php echo $postTitle; ?></strong></p>
	
    <?php the_content(); ?>
    
	<?php if ($postName) { ?>
    <p class="name"> - <?php echo $postName; ?> -</p>
	<?php } ?>
    </blockquote>
    
    </div>


    
    <?php endwhile; endif; ?>
    
    <?php wp_reset_postdata(); ?>
			
<?php
get_footer();
?>