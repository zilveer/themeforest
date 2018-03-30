<?php
/**
 * Template Name: Archives
 * @package by Theme Record
 * @auther: MattMao
 */
get_header(); 
?>
<div id="main" class="right-side clearfix">

<article id="content">

<div class="archive-latest-posts">
<h3><?php _e('The 20 latest news', 'TR'); ?></h3>
<ul>
	<?php 
		$args = array( 
			'post_type' => array('post'),
			'posts_per_page' => 20
		); 
		$posts_query = new WP_Query( $args );
		while ($posts_query->have_posts()) : $posts_query->the_post();
	?>
	<li><a href="<?php the_permalink(); ?>" title="<?php the_title_attribute(); ?>" rel="bookmark"><?php the_title(); ?></a></li>
	<?php endwhile; wp_reset_postdata(); ?>
</ul>
</div>
<!--end latest posts-->

<div class="archive-page-lists shortcode-col-3-1">
<h3><?php _e('Available Pages', 'TR'); ?></h3>
<ul>
<?php wp_list_pages('title_li=&depth=-1' ); ?>
</ul>
</div>

<div class="archive-category-lists shortcode-col-3-1">
<h3><?php _e('Archives by Subject', 'TR'); ?></h3>
<ul>
<?php
	$args =  array( 
		'orderby' => 'name',
		'show_count' => 0,
		'hide_empty' => 0,
		'title_li' => '',
		'taxonomy' => 'category'
	); 
	wp_list_categories($args ); 
	?>
</ul>
</div>

<div class="archive-archive-lists shortcode-col-3-1 shortcode-col-last">
<h3><?php _e('Archives by Month', 'TR'); ?></h3>
<ul>
	<?php wp_get_archives('type=monthly'); ?>
</ul>
</div>

<div class="clear"></div>

</article>
<!--End Content-->

<?php theme_sidebar('archive');?>

</div>
<!-- #main -->
<?php get_footer(); ?>

