<?php

// Page ID
global $wp_query;
$page_id = $wp_query->get_queried_object_id();

// Heading
$heading = get_post_meta($page_id,'_front_portfolio_heading',TRUE);

// Content
$content = get_post_meta($page_id,'_front_portfolio_content',TRUE);

// Category
$category = get_post_meta($page_id,'_front_portfolio_category',TRUE);

// Portfolio loop arguments
$args = array(
	'post_type'	=> 'portfolio',
	'showposts'	=> 4
);

// Portfolio loop category
if($category) {
	$args['tax_query'] = array(
		array(
			'taxonomy'	=> 'portfolio_category',
			'field'		=> 'id',
			'terms'		=> $category
		)
	);
}

// Portfolio loop
$loop = new WP_Query($args);
?>

<?php if($heading || $content): ?>
<div class="text top">
	<?php if($heading) { echo '<h3>'.$heading.'</h3>'; } ?>
	<?php if($content) { echo wpautop($content); } ?>
</div>
<?php endif; ?>

<?php while($loop->have_posts()): $loop->the_post(); ?>

<?php
	$classes = 'portfolio-item one-fourth';
	if('0'==$loop->current_post) { $classes .= ' first'; }
	if('3'==$loop->current_post) { $classes .= ' last'; }
	// Is there a custom link?
	$clink = get_post_meta($post->ID,'_link',TRUE);
	$link = $clink?$clink:get_permalink();
?>

<article class="<?php echo $classes; ?>">
	<a class="portfolio-thumbnail" href="<?php echo $link; ?>" title="<?php the_title_attribute(); ?>">	
		<?php if ( has_post_thumbnail() ): ?>
			<?php $img=wp_get_attachment_image_src(get_post_thumbnail_id(),'thumbnail-portfolio'); ?>
			<img src="<?php echo $img[0]; ?>" alt="<?php the_title() ;?>" />						
		<?php else: ?>
			<img src="<?php echo get_template_directory_uri(); ?>/img/placeholder.png" alt="<?php the_title() ;?>" />
		<?php endif; ?>

		<!--video icon-->
		<?php if ( wpb_meta($post->ID,'_portfolio_video') ): ?>
			<span class="play"></span>
		<?php endif; ?>
		<!--/-->

		<span class="glass"></span>
	</a>

	<a class="portfolio-meta" href="<?php echo $link; ?>">
		<h4 class="portfolio-title"><?php the_title() ;?></h4>
		<span class="portfolio-category"><?php echo air_portfolio::get_category_list(); ?></span>
	</a>
</article><!--/portfolio-item-->
<?php endwhile; ?>
