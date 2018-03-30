<?php
/**
 * Head Seo information
 *
 * @author Vedmant <vedmant@gmail.com>
 * @package Mental WP
 * @link http://azelab.com
 */
?>

<?php
$description      = get_mental_seo_description();
$medium_image_url = wp_get_attachment_image_src( get_post_thumbnail_id(), 'medium' );
if ( empty( $medium_image_url ) ) {
	$medium_image_url = wp_get_attachment_image_src( get_mental_option( 'meta_default_image' ), 'medium' );
	$image_url        = $medium_image_url[0];
} else {
	$image_url = $medium_image_url[0];
}
?>

	<!-- Google Authorship and Publisher Markup -->
	<?php if(get_mental_option('meta_gp_author')): ?>
		<link rel="author" href="<?php echo get_mental_option('meta_gp_author') ?>"/>
	<?php endif ?>
	<?php if(get_mental_option('meta_gp_publisher')): ?>
		<link rel="publisher" href="<?php echo get_mental_option('meta_gp_publisher') ?>"/>
	<?php endif ?>

	<!-- Schema.org markup for Google+ -->
	<meta itemprop="name" content="<?php wp_title(':') ?>">
	<meta itemprop="description" content="<?php echo esc_attr($description); ?>">
	<meta itemprop="image" content="<?php echo esc_url($image_url); ?>">

	<!-- Twitter Card data -->
	<meta name="twitter:card" content="summary_large_image">
	<?php if(get_mental_option('meta_tw_site')): ?>
		<meta name="twitter:site" content="<?php echo esc_attr(get_mental_option('meta_tw_site')); ?>">
	<?php endif ?>
	<?php if(get_mental_option('meta_tw_creator')): ?>
		<meta name="twitter:creator" content="<?php echo esc_attr(get_mental_option('meta_tw_creator')) ?>">
	<?php endif ?>
	<meta name="twitter:title" content="<?php wp_title(':') ?>">
	<meta name="twitter:description" content="<?php echo esc_attr($description); ?>">
	<!-- Twitter summary card with large image must be at least 280x150px -->
	<meta name="twitter:image:src" content="<?php echo esc_url($image_url); ?>">

	<!-- Open Graph data -->
	<meta property="og:title" content="<?php wp_title(':') ?>" />
	<meta property="og:type" content="article" />
	<meta property="og:url" content="<?php if(!is_404() && !is_search()) echo esc_attr(get_page_link()); ?>" />
	<meta property="og:image" content="<?php echo esc_url($image_url); ?>" />
	<meta property="og:description" content="<?php echo esc_attr($description); ?>" />
	<meta property="og:site_name" content="<?php echo esc_attr(bloginfo('name')); ?>" />
	<?php if(get_mental_option('meta_fb_admins')): ?>
		<meta property="fb:admins" content="<?php echo esc_attr(get_mental_option('meta_fb_admins')); ?>" />
	<?php endif ?>
	<?php if(get_mental_option('meta_fb_page_url')): ?>
		<meta property="article:publisher" content="<?php echo esc_attr(get_mental_option('meta_fb_page_url')); ?>" />
	<?php endif ?>