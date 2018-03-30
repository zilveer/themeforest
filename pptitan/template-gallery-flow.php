<?php
/**
 * The main template file for display portfolio page.
 *
 * Template Name: Gallery Image Flow
 * @package WordPress
 */

/**
*	Get Current page object
**/
$page = get_page($post->ID);
$current_page_id = '';

if(isset($page->ID))
{
    $current_page_id = $page->ID;
}

//Check if password protected
$portfolio_password = get_post_meta($current_page_id, 'portfolio_password', true);
if(!empty($portfolio_password))
{
	session_start();
	
	if(!isset($_SESSION['gallery_page_'.$current_page_id]) OR empty($_SESSION['gallery_page_'.$current_page_id]))
	{
		get_template_part("/templates/template-password");
		exit;
	}
}

//Get content gallery
$gallery_id = get_post_meta($current_page_id, 'page_gallery_id', true);

get_header(); 

//Run flow gallery data
wp_enqueue_script("script-flow-gallery", get_template_directory_uri()."/templates/script-flow-gallery.php?gallery_id=".$gallery_id, false, THEMEVERSION, true);
?>

<?php

//Get Page background style
$bg_style = get_post_meta($current_page_id, 'page_bg_style', true);

if($bg_style == 'Static Image')
{
    if(has_post_thumbnail($current_page_id, 'full'))
    {
        $image_id = get_post_thumbnail_id($current_page_id); 
        $image_thumb = wp_get_attachment_image_src($image_id, 'full', true);
        $pp_page_bg = $image_thumb[0];
    }
    else
    {
    	$pp_page_bg = get_template_directory_uri().'/example/bg.jpg';
    }
    
    wp_enqueue_script("script-static-bg", get_template_directory_uri()."/templates/script-static-bg.php?bg_url=".$pp_page_bg, false, THEMEVERSION, true);
    
} // end if static image
?>

</div>

<div id="imageFlow">
	<div class="text">
		<div class="title"></div>
		<div class="legend"></div>
	</div>
	<?php
		$pp_flow_enable_flow_scroll = get_option('pp_flow_enable_flow_scroll');
		
		if(!empty($pp_flow_enable_flow_scroll))
		{
	?>
	<div class="scrollbar">
		<img class="track" src="<?php echo get_template_directory_uri(); ?>/images/dark_slider_bg.png" alt="">
		<img class="bar" src="<?php echo get_template_directory_uri(); ?>/images/white_slider_handle.png" alt="">
		<img class="arrow-left" src="<?php echo get_template_directory_uri(); ?>/images/sl.gif" alt="">
		<img class="arrow-right" src="<?php echo get_template_directory_uri(); ?>/images/sr.gif" alt="">
	</div>
	<?php
		}
	?>
</div>

<div id="fancy_gallery" style="display:none">
<?php
$pp_portfolio_enable_slideshow_title = get_option('pp_portfolio_enable_slideshow_title');

foreach($all_photo_arr as $key => $photo)
{
	$full_image_url = wp_get_attachment_image_src( $photo->ID, 'full' );
	$small_image_url = wp_get_attachment_image_src( $photo->ID, 'large' );
?>
<a id="fancy_gallery<?php echo $key; ?>" href="<?php echo $full_image_url[0]; ?>" class="fancy-gallery" rel="fancybox-thumb" <?php if(!empty($pp_portfolio_enable_slideshow_title)) { ?> data-title="<?php echo $photo->post_title; ?> - <?php echo $photo->post_content; ?>" <?php } ?>></a>
<?php
}
?>
</div>

<input type="hidden" id="pp_image_path" name="pp_image_path" value="<?php echo get_template_directory_uri(); ?>/images/"/>
<?php
	$pp_enable_reflection = get_option('pp_enable_reflection');
?>
<input type="hidden" id="pp_enable_reflection" name="pp_enable_reflection" value="<?php echo $pp_enable_reflection; ?>"/>

<?php
$page_audio = get_post_meta($current_page_id, 'page_audio', true);

if(!empty($page_audio))
{
?>
<div class="page_audio">
	<?php echo do_shortcode('[audio width="30" height="30" src="'.$page_audio.'"]'); ?>
</div>
<?php
}
?>

<?php
	//important to apply dynamic footer style
	$pp_homepage_style = 'flow';
	
	get_footer();
?>