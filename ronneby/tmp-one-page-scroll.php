<?php
/*
Template Name: For one page scroll
*/
if ( ! defined( 'ABSPATH' ) ) { exit; }

$additional_layout_class = DfdMetaboxSettings::get('dfd_enable_page_spacer') ? 'dfd-custom-padding-html' : '';
$animation_style = DfdMetaboxSettings::get('dfd_animation_style');

if($animation_style != 'none') {
	$enable_animation = 'true';
	$enable_dots = 'false';
	$animation_style_class = ' dfd-enable-onepage-animation '.$animation_style;
} else {
	$enable_dots = DfdMetaboxSettings::get('dfd_enable_dots') ? 'false' : 'true';
	$enable_animation = 'false';
}
?>


<section id="layout" class="no-title one-page-scroll <?php echo esc_attr($animation_style_class); ?>" data-enable-dots="<?php echo $enable_dots ?>" data-enable-animation="<?php echo $enable_animation ?>">


	<?php get_template_part('templates/content', 'page'); ?>

	
</section>