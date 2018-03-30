<?php
/**
 * The main template file for display portfolio page.
 *
 * Template Name: Gallery 3 Columns
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

//Get gallery images
$all_photo_arr = get_post_meta($gallery_id, 'wpsimplegallery_gallery', true);

//Get global gallery sorting
$all_photo_arr = pp_resort_gallery_img($all_photo_arr);

get_header(); 
?>

<br class="clear"/>
</div>

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
else
{
    $page_bg_gallery_id = get_post_meta($current_page_id, 'page_bg_gallery_id', true);
    wp_enqueue_script("script-supersized-gallery", get_template_directory_uri()."/templates/script-supersized-gallery.php?gallery_id=".$page_bg_gallery_id, false, THEMEVERSION, true);
?>

<div id="thumb-tray" class="load-item">
    <div id="thumb-back"></div>
    <div id="thumb-forward"></div>
    <a id="prevslide" class="load-item"><img src="<?php echo get_template_directory_uri(); ?>/images/arrow_back.png" alt=""/></a>
    <a id="nextslide" class="load-item"><img src="<?php echo get_template_directory_uri(); ?>/images/arrow_forward.png" alt=""/></a>
</div>

<input type="hidden" id="pp_image_path" name="pp_image_path" value="<?php echo get_template_directory_uri(); ?>/images/"/>

<?php
}
?>

<?php
	//Display main gallery contents
    if(!empty($all_photo_arr))
    {
?>

<?php
if($bg_style == 'Static Image')
{
?>
<div class="page_control_static">
    <a id="page_minimize" href="#">
    	<img src="<?php echo get_template_directory_uri(); ?>/images/icon_zoom.png" alt=""/>
    </a>
    <a id="page_maximize" href="#">
    	<img src="<?php echo get_template_directory_uri(); ?>/images/icon_plus.png" alt=""/>
    </a>
</div>
<?php
}
else
{
?>
<div class="page_control">
    <a id="page_minimize" href="#">
    	<img src="<?php echo get_template_directory_uri(); ?>/images/icon_minus.png" alt=""/>
    </a>
    <a id="page_maximize" href="#">
    	<img src="<?php echo get_template_directory_uri(); ?>/images/icon_plus.png" alt=""/>
    </a>
</div>
<?php
}
?>

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

<!-- Begin content -->
<div id="page_content_wrapper">
    
    <div class="inner">

    	<div class="inner_wrapper">
    	
    	<div id="page_caption">
    		<h1 class="cufon"><?php echo $post->post_title; ?></h1>
    	</div>
    	
    	<?php
    	    //Get page description
    	    if(!empty($post->post_content))
    	    {
    	?>
    	    <?php echo pp_apply_content($post->post_content); ?><br/>
    	<?php
    	    }
    	?>
    	
    	<div id="page_main_content" class="sidebar_content full_width transparentbg">
    	
    	<?php
			//Get social media sharing option
			$pp_social_sharing = get_option('pp_social_sharing');
			
			if(!empty($pp_social_sharing))
			{
		?>
		<!-- AddThis Button BEGIN -->
		<div class="addthis_toolbox addthis_default_style addthis_32x32_style">
		<a class="addthis_button_preferred_1"></a>
		<a class="addthis_button_preferred_2"></a>
		<a class="addthis_button_preferred_3"></a>
		<a class="addthis_button_preferred_4"></a>
		<a class="addthis_button_compact"></a>
		<a class="addthis_counter addthis_bubble_style"></a>
		</div>
		<script type="text/javascript">var addthis_config = {"data_track_addressbar":false};</script>
		<script type="text/javascript" src="//s7.addthis.com/js/300/addthis_widget.js#pubid=ppulpipatnan"></script>
		<!-- AddThis Button END -->
		<br class="clear"/>
		<?php
			}
		?>
    	
    	<?php
    		$pp_portfolio_enable_slideshow_title = get_option('pp_portfolio_enable_slideshow_title');
    		
    		foreach($all_photo_arr as $key => $photo_id)
    		{
    			$small_image_url = '';
	    		$hyperlink_url = get_permalink($photo_id);
	    		
	    		if(!empty($photo_id))
	    		{
	    		    $image_url = wp_get_attachment_image_src($photo_id, 'full', true);
	    		    $small_image_url = wp_get_attachment_image_src($photo_id, 'gallery_3', true);
	    		}
	    		
	    		//Get image meta data
	    		$image_title = get_post_field('post_title', $photo_id);
	    		$image_caption = get_post_field('post_excerpt', $photo_id);
	    		$image_desc = get_post_field('post_content', $photo_id);
    			
    			$last_class = '';
    			if(($key+1)%3==0)
    			{
    				$last_class = 'last';
    			}
    	?>
    	
    	<div class="one_third <?php echo $last_class; ?> gallery3">
    		<?php 
    			if(!empty($small_image_url))
    			{
    		?>		
    				<img src="<?php echo $small_image_url[0]; ?>" alt="" class="one_third_img"/>

    				<a <?php if(!empty($pp_portfolio_enable_slideshow_title)) { ?>data-title="<?php echo $image_title; ?> - <?php echo $image_desc; ?>"<?php } ?> class="fancy-gallery" data-fancybox-group="fancybox-thumb" href="<?php echo $image_url[0]; ?>">
	    				<div class="mask">
	                        <?php if(!empty($pp_portfolio_enable_slideshow_title)) { ?>
		                        <h5><?php echo $image_title; ?></h5>
		                        <span class="caption"><?php echo $image_caption; ?></span>
		                    <?php } ?>
	                    </div>
    				</a>
    		<?php
    			}		
    		?>			
    		
    	</div>
    	
    	<?php
    		}
    	?>
    	</div>
    </div>
</div>

<?php get_footer(); ?>

<?php
    }
?>