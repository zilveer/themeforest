<?php
/**
 * The main template file for display portfolio page.
 *
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

//Check if gallery template
global $page_gallery_id;
if(!empty($page_gallery_id))
{
	$current_page_id = $page_gallery_id;
}

//Check if password protected
$gallery_password = get_post_meta($current_page_id, 'gallery_password', true);
if(!empty($gallery_password))
{
	session_start();
	
	if(!isset($_SESSION['gallery_page_'.$current_page_id]) OR empty($_SESSION['gallery_page_'.$current_page_id]))
	{
		get_template_part("/templates/template-password");
		exit;
	}
}

//important to apply dynamic header & footer style
global $pp_homepage_style;
$pp_homepage_style = 'fullscreen';

get_header();

//Run gallery script data
wp_enqueue_style("supersized", get_template_directory_uri()."/css/supersized.css", false, THEMEVERSION, "all");
wp_enqueue_script("script-supersized-gallery", get_template_directory_uri()."/templates/script-supersized-gallery.php?gallery_id=".$current_page_id, false, THEMEVERSION, true);

//Check if display galery info
$pp_gallery_auto_info = get_option('pp_gallery_auto_info');
?>

<div id="imageFlow_gallery_info" class="fadeIn" <?php if(empty($pp_gallery_auto_info)) { ?>style="left:-370px"<?php } ?>>
	<div class="imageFlow_gallery_info_wrapper">
		<?php
			$gallery_post_title = get_post_field('post_title', $current_page_id);
		?>
		<h1><?php echo $gallery_post_title; ?></h1><br/><hr/>
		<?php
			$gallery_tagline = get_post_meta($current_page_id, 'gallery_tagline', true);
			
			if(!empty($gallery_tagline))
			{
		?>
			<br/><div class="page_caption_desc"><?php echo $gallery_tagline; ?></div>
		<?php
			}
		?>
		<br/>
		<div class="imageFlow_gallery_info_author">
			<?php 
	    		//Get gallery content
	    		$gallery_post_content = get_post_field('post_content', $current_page_id);
	    		
	    		if(!empty($gallery_post_content))
	    		{
		    		echo $gallery_post_content;
	    		}
	    	?>
			<br/><?php echo get_the_time(THEMEDATEFORMAT); ?>
		</div>
		
		<a id="flow_view_button" class="button" href="#"><?php _e( 'View Gallery', THEMEDOMAIN ); ?></a>
		
		<?php
			//Get Social Share
			get_template_part("/templates/template-share");
		?>
	</div>
</div>

<a id="flow_info_button" <?php if(empty($pp_gallery_auto_info)) { ?>style="display:block;"<?php } ?> href="#"><i class="fa fa-info-circle"></i></a>

<div id="thumb-tray" class="load-item">
    <a id="prevslide" class="load-item"><img src="<?php echo get_template_directory_uri(); ?>/images/arrow_back.png" alt=""/></a>
    <a id="nextslide" class="load-item"><img src="<?php echo get_template_directory_uri(); ?>/images/arrow_forward.png" alt=""/></a>
</div>

<?php
    $pp_full_enable_slideshow_title = get_option('pp_full_enable_slideshow_title');
    if(!empty($pp_full_enable_slideshow_title))
    {
?>
    <!--Slide captions displayed here--> 
    <div id="slidecaption"></div>
<?php
    }
?>

<br class="clear"/>
</div>

<?php
$gallery_audio = get_post_meta($current_page_id, 'gallery_audio', true);

if(!empty($gallery_audio))
{
?>
<div class="gallery_audio">
	<?php echo do_shortcode('[audio width="30" height="30" src="'.$gallery_audio.'"]'); ?>
</div>
<?php
}
?>

<?php	
	get_footer();
?>