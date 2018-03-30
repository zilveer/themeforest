<?php

/*
	@package WordPress
	@subpackage The Cause
	
	Template Name: Testimonials
*/

get_header();

global $post; $title = $post->post_title;
?>

<h2><?php echo $title; ?></h2> 

<div>

    <?php
		$args = array();
		
		$args['post_type'] = 'testimonial';
		$args['post_status'] = 'publish';

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
        
        <?php $postID = get_the_ID(); ?>
        <?php $postTitle = get_the_title($postID); ?>
		<?php $postName = get_post_meta($postID, '_name', true); ?>
        
        <div id="post-<?php echo $postID; ?>">
        
        <blockquote>
		<p><strong><?php echo $postTitle; ?></strong></p>
		
        <?php the_content(); ?>
        
		<?php if ($postName) { ?>
        <p class="name"> - <?php echo $postName; ?> -</p>
		<?php } ?>
        </blockquote>
        
        </div>
        
        <div class="clear"></div>
    
    <?php endwhile; endif; ?>
    
    <?php wp_reset_postdata(); ?>


</div>
		
	<?php kriesi_pagination($tbQuery->max_num_pages); ?>

<?php
get_footer();
?>