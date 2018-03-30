<?php
/**
 * The main template file for display portfolio page.
 *
 * Template Name: Gallery Image Flow
 * @package WordPress
 */

/**
*	Get all photos
**/ 

$menu_sets_query = '';

$portfolio_items = -1;

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
		include (get_template_directory() . "/templates/template-password.php");
		exit;
	}
}

//Get content gallery
$gallery_id = get_post_meta($current_page_id, 'page_gallery_id', true);

$args = array( 
	'post_type' => 'attachment', 
	'numberposts' => $portfolio_items, 
	'post_status' => null, 
	'post_parent' => $gallery_id,
	'order' => 'ASC',
	'orderby' => 'menu_order',
); 

//Get gallery images
$all_photo_arr = get_posts( $args );

get_header(); ?>

<div id="imageFlow">
	<div class="text">
		<div class="title">Loading</div>
		<div class="legend">Please wait...</div>
	</div>
</div>

<div id="fancy_gallery" style="display:none">
<?php
$pp_portfolio_enable_slideshow_title = get_option('pp_portfolio_enable_slideshow_title');

foreach($all_photo_arr as $key => $photo)
{
	$full_image_url = wp_get_attachment_image_src( $photo->ID, 'full' );
	$small_image_url = wp_get_attachment_image_src( $photo->ID, 'large' );
?>
<a id="fancy_gallery<?php echo $key; ?>" href="<?php echo $full_image_url[0]; ?>" class="fancy-gallery" <?php if(!empty($pp_portfolio_enable_slideshow_title)) { ?> title="<?php echo $photo->post_title; ?>" <?php } ?>></a>
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
imf.create("imageFlow", '<?php echo get_stylesheet_directory_uri(); ?>/imageFlowXML.php?gallery_id=<?php echo $gallery_id; ?>', 0.6, 0.4, 0, 0, 8, 4);
</script>
<?php
}
?>

<input type="hidden" id="pp_image_path" name="pp_image_path" value="<?php echo get_stylesheet_directory_uri(); ?>/images/"/>
<?php
	$pp_enable_reflection = get_option('pp_enable_reflection');
?>
<input type="hidden" id="pp_enable_reflection" name="pp_enable_reflection" value="<?php echo $pp_enable_reflection; ?>"/>

<?php
	$galleries = get_posts(array('parent' => -1, 'post_type' => 'gallery', 'numberposts' => -1));
	$wp_galleries = array();
	foreach ($galleries as $gallery_list ) {
	       $wp_galleries[$gallery_list->ID]['title'] = $gallery_list->post_title;
	       $wp_galleries[$gallery_list->ID]['desc'] = $gallery_list->post_content;
	}
?>

<?php
if(isset($wp_galleries[$gallery_id]['title']))
{
?>
<div id="kenburns_title"><?php echo $wp_galleries[$gallery_id]['title']; ?></div>
<?php
}

if(isset($wp_galleries[$gallery_id]['desc']))
{
?>
<div id="kenburns_desc"><?php echo $wp_galleries[$gallery_id]['desc']; ?></div>
<?php
}
?>
		
<?php get_footer(); ?>