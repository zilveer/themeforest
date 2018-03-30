<?php
/**
 * Template Name: Gallery Flow
 * The main template file for display portfolio page.
 *
 * @package WordPress
 */
 
get_header();

/**
*	Get Current page object
**/
$page = get_page($post->ID);

/**
*	Get current page id
**/

if(!isset($current_page_id) && isset($page->ID))
{
    $current_page_id = $page->ID;
}

/**
* 	Check password protected
**/

$page_gallery_password = get_post_meta($current_page_id, 'page_gallery_password', true);

if(!empty($page_gallery_password))
{
    if(!isset($_SESSION['gallery_page_'.$current_page_id]) OR empty($_SESSION['gallery_page_'.$current_page_id]))
    {		
    	include (TEMPLATEPATH . "/templates/template-password.php");
    	exit;
    }
}

/**
*	Get all photos
**/ 

$page_gallery_id = get_post_meta($current_page_id, 'page_gallery_id', true);

$args = array( 
	'post_type' => 'attachment', 
	'numberposts' => -1, 
	'post_status' => null, 
	'post_parent' => $page_gallery_id,
	'order' => 'ASC',
	'orderby' => 'menu_order',
); 
$all_photo_arr = get_posts( $args );

$pp_display_image_title = get_option('pp_display_image_title');

?>

<div id="imageFlow">
	<div class="text">
		<div class="title">Loading</div>
		<div class="legend">Please wait...</div>
	</div>
	<div class="scrollbar">
		<?php
			if(isset($_SESSION['pp_skin']))
			{
			    $pp_skin = $_SESSION['pp_skin'];
			}
			else
			{
			    $pp_skin = get_option('pp_skin');
			}
	
			if($pp_skin == 'light')
			{
		?>
			<img class="track" src="<?php echo get_template_directory_uri(); ?>/images/white_slider_bg.png" alt="">
			<img class="bar" src="<?php echo get_template_directory_uri(); ?>/images/white_slider_handle.png" alt="">
		<?php
			}
			else
			{
		?>
			<img class="track" src="<?php echo get_template_directory_uri(); ?>/images/dark_slider_bg.png" alt="">
			<img class="bar" src="<?php echo get_template_directory_uri(); ?>/images/white_slider_handle.png" alt="">
		<?php
			}
		?>
		<img class="arrow-left" src="<?php echo get_template_directory_uri(); ?>/images/sl.gif" alt="">
		<img class="arrow-right" src="<?php echo get_template_directory_uri(); ?>/images/sr.gif" alt="">
	</div>
</div>

<div id="fancy_gallery" style="display:none">
<?php

foreach($all_photo_arr as $key => $photo)
{
	$full_image_url = wp_get_attachment_image_src( $photo->ID, 'full' );
	$small_image_url = wp_get_attachment_image_src( $photo->ID, 'large' );
?>
<a id="fancy_gallery<?php echo $key; ?>" href="<?php echo $full_image_url[0]; ?>" rel="gallery" <?php if(!empty($pp_display_image_title)) { ?> title="<?php echo $photo->post_title; ?>" <?php } ?>><img src="<?php echo get_template_directory_uri(); ?>/images/white_slider_handle.png" alt=""/></a>
<?php
}
?>
</div>

<?php
if(!empty($all_photo_arr))
{
?>
<script>
/* ==== create imageFlow ==== */
//          div ID, imagesbank, horizon, size, zoom, border, autoscroll_start, autoscroll_interval
imf.create("imageFlow", '<?php echo get_template_directory_uri(); ?>/imageFlowXML.php?gallery_id=<?php echo $page_gallery_id; ?>', 0.6, 0.4, 0, 10, 8, 4);

jQuery(document).ready(function(){ 
	jQuery('#footer').css('position', 'fixed');
	jQuery('#footer').css('bottom', '20px');
	jQuery('#footer').css('width', '100%');
	jQuery('#footer').css('textAlign', 'center');
});
</script>
<?php
}

get_footer();
?>