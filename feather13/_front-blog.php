<?php

// Page ID
global $wp_query;
global $page_id;
$page_id = $wp_query->get_queried_object_id();

// Heading
$heading = get_post_meta($page_id,'_front_blog_heading',TRUE);

// Content
$content = get_post_meta($page_id,'_front_blog_content',TRUE);

// Format
$format = get_post_meta($page_id,'_front_blog_format',TRUE);

// Category
$cat = get_post_meta($page_id,'_front_blog_category',TRUE);

// Excerpt
remove_filter('excerpt_length','air_excerpt_length',999);
add_filter('excerpt_length','tmp_excerpt_length',999);

function tmp_excerpt_length($length) {
	global $page_id;
	$excerpt = get_post_meta($page_id,'_front_blog_excerpt_length',TRUE);
	return $excerpt?$excerpt:$length;
}

?>

<?php if($heading || $content): ?>
<div class="text top">
	<?php if($heading) { echo '<h3>'.$heading.'</h3>'; } ?>
	<?php if($content) { echo wpautop($content); } ?>
</div>
<?php endif; ?>

<?php $my_query = "ignore_sticky_posts=1&showposts=3&cat=".$cat; $my_query = new WP_Query($my_query); ?>
<?php if ($my_query->have_posts()) : while ($my_query->have_posts()) : $my_query->the_post(); ?>
<?php $classes = ('2'==$my_query->current_post)?'entry one-third last':'entry one-third'; ?>

	<article id="entry-<?php the_ID(); ?>" <?php post_class($classes); ?>>
		<?php if(($format == '2') && has_post_thumbnail()): ?>
		<div class="entry-thumbnail">
			<a href="<?php the_permalink(); ?>" title="<?php the_title(); ?>">
				<?php the_post_thumbnail('post-thumbnail'); ?>
				<span class="glass"></span>
				<?php if(has_post_format('video') || has_post_format('audio')) : ?>
				<span class="play"></span>
				<?php endif; ?>
			</a>	
		</div><!--/entry-thumbnail-->
		<div class="entry-wrap-thumbnail">
		<?php else: ?>
		<div class="entry-wrap">
		<?php endif; ?>
			<header>
				<div class="entry-byline fix">	
					<p class="entry-date"><?php if(!wpb_option('post-hide-date')) { the_time('F jS, Y'); } ?></p>
				</div>
				<h2 class="entry-title">
					<a href="<?php the_permalink(); ?>" rel="bookmark" title="<?php printf(esc_attr__('Permalink to %s', 'intent'), the_title_attribute('echo=0')); ?>"><?php the_title(); ?></a>
				</h2>
				<div class="clear"></div>
			</header>
			<?php if(($format == '1') && get_post_format()) { get_template_part('_post-formats'); } ?>
			<div class="text">
				<?php the_excerpt(); ?>
			</div>
		</div><!--/entry-wrap-->
	</article>

<?php endwhile; // end of one post ?>
<?php endif; //end of loop ?>
	