<?php
/*
Template Name: Home
*/

/**
 * The main template file.
 *
 * This is the most generic template file in a WordPress theme
 * and one of the two required files for a theme (the other being style.css).
 * It is used to display a page when nothing more specific matches a query.
 * E.g., it puts together the home page when no home.php file exists.
 * Learn more: http://codex.wordpress.org/Template_Hierarchy
 *
 * @package berg-wp
 */

get_header(); 
?>
<div class="hidden-xs">
<?php


$img_url = wp_get_attachment_image_src( get_post_thumbnail_id(), 'large_bg');
$img_url = $img_url[0];
if($img_url != '') { ?> 
<?php } ; 
	$post_meta = get_post_meta(get_the_ID());
	$sectionHome = 'section_home_1';
	if(isset($post_meta['section_home'][0])) {
		$sectionHome = $post_meta['section_home'][0];
		if($sectionHome == 'section_home_1') {
			$class = '';
			$template = 'static';
		} else if($sectionHome == 'section_home_2') {
			$class = 'parallax-bg';
			$template = 'parallax';
		} else if($sectionHome == 'section_home_3') {
			$class = 'slider-bg';
			$template = 'slider';
		} else if($sectionHome == 'section_home_4') {
			$class = 'video-bg';
			$template = 'video';
		}
	} 

?>

<?php if($sectionHome != 'section_home_5') :?>
<header class="main-section homepage home-page <?php echo $class ;?>"> 
	<div class="home-fullscreen"> 
		<div class="container-fluid">
			<div class="basic-info">
				<?php
					the_post();
					the_content();
				?>
			</div>
		</div>
		<?php 
			get_template_part( 'home', $template ); 
		?>
	</div>
</header>
<?php else : ?>
<?php 

$slider = get_post_meta(get_the_id(), 'revslider_select', true);
putRevSlider($slider) 

?>
	<?php if ($post->post_content != '' && $post->post_content != '[vc_row el_class="hidden"][vc_column width="1/1"][/vc_column][/vc_row]') : ?>

		<div class="section-scroll">
			<div class="container home-padding-content">
				<?php 
					the_post();
					the_content();  
				?>
			</div>
		</div>
	<?php endif;?>

<?php endif;?>	

</div>

<?php 
	if(YSettings::g('mobile_homepage', 0) != 0) {

		$pageId = YSettings::g('mobile_homepage', 0);

		if (function_exists('icl_object_id')) {
			$icl = (int)icl_object_id($pageId, 'page', true);
			$pageMobile = get_post($icl);
		} else {
			$pageMobile = get_post($pageId);
		}

		$img = wp_get_attachment_image_src( get_post_thumbnail_id($pageMobile->ID), 'large_bg');
		$img = $img[0];

		if ($img != '')
?>
<div class="visible-xs mobile-homepage" style="position: relative; background-image: url(<?php echo $img;?>); background-size: cover; background-position: center center; ">
	<div class="container-fluid homepage" style="position: static; ">
		<div class="mobile-overlay" style="position: absolute; height: 100%; width: 100%; left: 0; top: 0; background: #000; <?php if(get_post_meta($pageMobile->ID, 'mobile_home_opacity', true) != '') { echo 'opacity: '.get_post_meta($pageMobile->ID, 'mobile_home_opacity', true) / 100; } else { echo 'opacity: 0'; } ;?>;"></div>
		<div class="basic-info">
		<?php echo apply_filters('the_content', $pageMobile->post_content); ?>
		</div>
	</div>
</div>

<?php } else { ?>
<div class="visible-xs mobile-homepage" style="position: relative; background-image: url('http://placehold.it/1440x900'); background-size: cover; background-position: center center; ">
	<div class="container-fluid homepage" style="position: static; ">
		<div class="mobile-overlay" style="position: absolute; height: 100%; width: 100%; left: 0; top: 0; background: #000; opacity: 0.3;"></div>
		<div class="basic-info text-center">
		<h2><?php echo __('Please select mobile homepage in Page settings metabox settings', 'BERG'); ?></h2>
		</div>
	</div>
</div>
<?php }; ?>

<?php
if (YSettings::g('mobile_homepage', 0) != 0) {
	$pageId = YSettings::g('mobile_homepage', 0);

	if (function_exists('icl_object_id')) {
		$icl = (int)icl_object_id($pageMobile->ID, 'page', true);
		$mobilePageId = get_post_meta($icl, 'mobile_home_footer', 1);
	} else {
		$mobilePageId = get_post_meta($pageMobile->ID, 'mobile_home_footer', 1);
	}

	if ($mobilePageId == 0 ) { ?>
		<script>
			jQuery(document).ready(function() {
				jQuery('#footer').addClass('hidden-xs');
			});
		</script>
	<?php } } ?>
<?php
	berg_getFooter();
	get_template_part('footer'); 
?>