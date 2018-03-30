<?php
/**
 * The main template file.
 *
 * Template Name: Gallery Kenburns
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

//Get global gallery sorting
$pp_orderby = 'menu_order';
$pp_order = 'ASC';
$pp_gallery_sort = get_option('pp_gallery_sort');

if(!empty($pp_gallery_sort))
{
	switch($pp_gallery_sort)
	{
		case 'post_date':
			$pp_orderby = 'post_date';
			$pp_order = 'DESC';
		break;
		
		case 'post_date_old':
			$pp_orderby = 'post_date';
			$pp_order = 'ASC';
		break;
		
		case 'rand':
			$pp_orderby = 'rand';
			$pp_order = 'ASC';
		break;
		
		case 'title':
			$pp_orderby = 'title';
			$pp_order = 'ASC';
		break;
	}
}

$args = array( 
	'post_type' => 'attachment', 
	'numberposts' => -1, 
	'post_status' => null, 
	'post_parent' => $gallery_id,
	'order' => $pp_order,
	'orderby' => $pp_orderby,
); 

//Get gallery images
$all_photo_arr = get_posts( $args );

get_header(); 

wp_enqueue_script("kenburns", get_template_directory_uri()."/js/kenburns.js", false, THEMEVERSION, true);
wp_enqueue_script("script-kenburns-gallery", get_template_directory_uri()."/templates/script-kenburns-gallery.php?gallery_id=".$gallery_id, false, THEMEVERSION, true);

?>

<div id="kenburns_overlay"></div>
<canvas id="kenburns">
    <p>Your browser doesn't support canvas!</p>
</canvas>

<?php
$pp_homepage_music_mp3 = get_option('pp_homepage_music_mp3');

if(!empty($pp_homepage_music_mp3))
{
?>
<div class="page_audio">
	<?php echo do_shortcode('[audio width="30" height="30" src="'.$pp_homepage_music_mp3.'"]'); ?>
</div>
<?php
}
?>

<?php
	//important to apply dynamic footer style
	$pp_homepage_style = 'fullscreen';
	
	get_footer();
?>