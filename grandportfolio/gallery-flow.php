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
$grandportfolio_page_gallery_id = grandportfolio_get_page_gallery_id();
if(!empty($grandportfolio_page_gallery_id))
{
	$current_page_id = $grandportfolio_page_gallery_id;
}

//Check if password protected
get_template_part("/templates/template-password");

//important to apply dynamic header and footer style
$grandportfolio_homepage_style = grandportfolio_get_homepage_style();
grandportfolio_set_homepage_style('flow');

get_header(); 

//Run flow gallery data
wp_enqueue_script("ppflip", get_template_directory_uri()."/js/jquery.ppflip.js", false, THEMEVERSION, true);
wp_enqueue_script("touchwipe", get_template_directory_uri()."/js/jquery.touchwipe.1.1.1.js", false, THEMEVERSION, true);
?>

</div>

<a id="imgflow-prevslide" class="load-item"></a>
<a id="imgflow-nextslide" class="load-item"></a>

<div id="imageFlow">
	<div class="text">
		<div class="title"></div>
		<div class="legend"></div>
	</div>
</div>

<?php
	$tg_flow_enable_reflection = kirki_get_option('tg_flow_enable_reflection');
?>
<input type="hidden" id="tg_flow_enable_reflection" name="tg_flow_enable_reflection" value="<?php echo esc_attr($tg_flow_enable_reflection); ?>"/>

<?php
	$tg_flow_enable_lightbox = kirki_get_option('tg_flow_enable_lightbox');
	
	if(!empty($tg_flow_enable_lightbox))
	{
?>
<div id="fancy_gallery" style="display:none">
<?php
$tg_full_image_caption = kirki_get_option('tg_full_image_caption');
$all_photo_arr = get_post_meta($current_page_id, 'wpsimplegallery_gallery', true);
	
//Get default gallery sorting
$all_photo_arr = grandportfolio_resort_gallery_img($all_photo_arr);

foreach($all_photo_arr as $key => $photo)
{
	$full_image_url = wp_get_attachment_image_src( $photo, 'original' );
	$image_caption = get_post_field('post_excerpt', $photo);
?>
<a id="fancy_gallery<?php echo esc_attr($key); ?>" href="<?php echo esc_url($full_image_url[0]); ?>" class="fancy-gallery" <?php if(!empty($tg_full_image_caption)) { ?> data-caption="<?php echo esc_html($image_caption); ?>" <?php } ?>></a>
<?php
}
?>
</div>
<?php
	}
?>

<?php
	//Print flow gallery javascript
?>
<script>
jQuery(document).ready(function() {
	var calScreenWidth = jQuery(window).width();
	var imgFlowSize = 0.6;
	if(calScreenWidth > 480)
	{
	imgFlowSize = 0.4;
	}
	else
	{
	imgFlowSize = 0.2;
	}
	<?php
	$ajax_nonce = wp_create_nonce('tgajax-post-contact-nonce');
	
	if(!empty($current_page_id))
	{
	?>
	imf.create("imageFlow", '<?php echo admin_url('admin-ajax.php').'?action=grandportfolio_image_flow_xml&gallery_id='.$current_page_id; ?>&tg_security=<?php echo $ajax_nonce; ?>', 0.6, 0.4, 0, 10, 8, 4);
	<?php
	}
	else
	{
	?>
	imf.create("imageFlow", '<?php echo admin_url('admin-ajax.php').'?action=grandportfolio_image_flow_xml&tg_security=<?php echo $ajax_nonce; ?>'; ?>', 0.6, 0.4, 0, 10, 8, 4);
	<?php
	}
	?>
});
</script>

<?php
	//important to apply dynamic footer style
	$grandportfolio_homepage_style = 'flow';
	
	get_footer();
?>