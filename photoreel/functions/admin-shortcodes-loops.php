<?php

/*-----------------------------------------------------------------------------------*/
/* 1. blog_latest  */
/*-----------------------------------------------------------------------------------*/

function tmnf_blog_latest($atts, $content = null) {
	extract(shortcode_atts(array(
		"query" => '',
		"posts_number" => '',
	), $atts));
	global $wp_query,$paged,$post;
	$temp = $wp_query;
	$wp_query= null;
	$wp_query = new WP_Query();
		$query .= 'showposts='.$posts_number;
	$wp_query->query($query);
	ob_start();
	?>
	<ul class="loop">
	<?php while ($wp_query->have_posts()) : $wp_query->the_post();?>
    
    	<li id="post-<?php the_ID(); ?>" class="item_blog">
			<?php get_template_part('/includes/post-types/blog-classic'); ?>
       	</li>
            
	<?php endwhile; ?>
	</ul>
    <?php wp_reset_query(); ?>
	<?php $wp_query = null; $wp_query = $temp;
	$content = ob_get_contents();
	ob_end_clean();
	return $content;
}
add_shortcode("blog_latest", "tmnf_blog_latest");


/*-----------------------------------------------------------------------------------*/
/* 2. portfolio_latest  */
/*-----------------------------------------------------------------------------------*/

function tmnf_portfolio_latest($atts, $content = null) {
	
	wp_enqueue_script('quicksand', get_template_directory_uri() . '/js/jquery.quicksand.js','','', true);
	wp_enqueue_script('easing', get_template_directory_uri() . '/js/jquery.easing.1.3.js','','', true);
	wp_enqueue_script('quicksand.custom', get_template_directory_uri() . '/js/jquery.quicksand.custom.js','','', true);
	
	get_template_part('/includes/home_filter'); 

}
add_shortcode("portfolio_latest", "tmnf_portfolio_latest");


/*-----------------------------------------------------------------------------------*/
/* 5. carousel_featured  */
/*-----------------------------------------------------------------------------------*/

function tmnf_carousel_featured($atts, $content = null) {
	extract(shortcode_atts(array(
		"query" => '',
		"category" => '',
		"posts_number" => '',
	), $atts));
	global $wp_query,$paged,$post;
	$temp = $wp_query;
	$wp_query= null;
	$wp_query = new WP_Query();
	if(!empty($category)){
		$query .= 'post_type=myportfoliotype&categories='.$category.'&showposts='.$posts_number;
	}
	if(!empty($query)){
		$query .= $query;
	}
	$wp_query->query($query);
	ob_start();
	wp_enqueue_script('jquery.flexslider.carousel.start', get_template_directory_uri() .'/js/jquery.flexslider.carousel.start.js','','', true);
	?>
    
    <div class="widgetflexslider flexslider">
    <ul class="slides">
	<?php while ($wp_query->have_posts()) : $wp_query->the_post();?>
    
    	<li>
			<?php get_template_part('/includes/folio-types/home_carousel'); ?>
       	</li>
            
	<?php endwhile; ?>
	</ul>
    </div>
    <?php wp_reset_query(); ?>
    <div style="clear: both;"></div>
	<?php $wp_query = null; $wp_query = $temp;
	$content = ob_get_contents();
	ob_end_clean();
	return $content;
}
add_shortcode("carousel_featured", "tmnf_carousel_featured");


/*-----------------------------------------------------------------------------------*/
/* 7. features  */
/*-----------------------------------------------------------------------------------*/

function tmnf_features($atts, $content = null) {
	extract(shortcode_atts(array(
		"query" => '',
		"category" => '',
		"posts_number" => '',
	), $atts));
	global $wp_query,$paged,$post;
	$temp = $wp_query;
	$wp_query= null;
	$wp_query = new WP_Query();
		$query .= 'post_type=myfeaturetype&using='.$category.'&showposts='.$posts_number;
	$wp_query->query($query);
	ob_start();
	?>
	<ul class="features">
	<?php while ($wp_query->have_posts()) : $wp_query->the_post();?>
    
    	<li>
			<?php get_template_part('/includes/folio-types/home_features'); ?>
       	</li>
            
	<?php endwhile; ?>
	</ul>
    <?php wp_reset_query(); ?>
    <div style="clear: both;"></div>
	<?php $wp_query = null; $wp_query = $temp;
	$content = ob_get_contents();
	ob_end_clean();
	return $content;
}
add_shortcode("features", "tmnf_features");

/*-----------------------------------------------------------------------------------*/
/* THE END */
/*-----------------------------------------------------------------------------------*/
?>