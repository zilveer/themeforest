<?php

/*
	@package WordPress
	@subpackage The Cause
	
	Template Name: FAQ 2
*/

get_header();

global $post;
$title = $post->post_title;

?>

<h2><?php echo $title; ?></h2>

<div>

    <?php
		$args = array();
		
		$args['post_type'] = 'tb_faq';
		$args['post_status'] = 'publish';
		$args['posts_per_page'] = -1;
		$args['orderby'] = 'menu_order';
		$args['order'] = 'ASC';
		
		$tbQuery = new WP_Query($args);
	?>

    <?php if ($tbQuery->have_posts()) : while ($tbQuery->have_posts()) : $tbQuery->the_post(); ?>
	
        <div class="faq2 inactive">
        	<h4><?php the_title(); ?></h4>            
        	<div><?php the_content(); ?></div>
        </div>
    
    <?php endwhile; endif; ?>
    
    <?php wp_reset_postdata(); ?>

</div>

<?php
get_footer();
?>