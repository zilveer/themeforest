<?php get_header(); ?>
<?php while(have_posts()): the_post(); ?>

<?php
// Template 
$template = get_post_meta($post->ID,'_portfolio_template',TRUE);
if ( !$template ) { $template = 'left'; }
$template = locate_template('_portfolio-single-'.$template.'.php');

// Post images
$post_images = wpb_post_images();

// No post images, use featured thumbnail
if ( !$post_images && has_post_thumbnail() ) {
	// Get featured thumbnail id
	$img_id = get_post_thumbnail_id();
	// Get image
	$post_images = wpb_post_images(
		array(
			'p'				=> $img_id,
			'post_parent'	=> NULL
		)
	);
}

// Load template
require($template);
?>

<?php endwhile; ?>
<?php get_footer(); ?>