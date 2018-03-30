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

//Get content gallery
$gallery_id = $page->ID;

get_header();

if(post_password_required())
{
?>
<div id="page_content_wrapper" class="fade-in two">

    <div class="inner">
    
    <!-- Begin main content -->
    <div class="inner_wrapper">
    	<br/>
		<?php echo the_content(); ?>
    </div>
    
    </div>
</div>
<?php
}
else
{
//Run gallery script data
wp_enqueue_script("script-carousel-gallery", get_template_directory_uri()."/templates/script-carousel-gallery.php?gallery_id=".$gallery_id, false, THEMEVERSION, true);
?>

<input type="hidden" id="pp_supersized_margintop" name="pp_supersized_margintop" value="215"/>

<div id="thumb-tray" class="load-item fade-in two">
    <div id="thumb-back"></div>
    <div id="thumb-forward"></div>
    <a id="prevslide" class="load-item"><img src="<?php echo get_template_directory_uri(); ?>/images/arrow_back.png" alt=""/></a>
    <a id="nextslide" class="load-item"><img src="<?php echo get_template_directory_uri(); ?>/images/arrow_forward.png" alt=""/></a>
</div>

<br class="clear"/>
</div>

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

}
?>

<?php
	//important to apply dynamic footer style
	$pp_homepage_style = 'fullscreen';
	
	get_footer();
?>