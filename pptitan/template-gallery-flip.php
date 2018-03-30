<?php
/**

 * The main template file for display portfolio page.
 *
 * Template Name: Gallery Flip
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

wp_enqueue_script("script-flip-gallery", get_template_directory_uri()."/templates/script-flip-gallery.php?gallery_id=".$gallery_id, false, THEMEVERSION, true);
?>

<div id="tf_loading" class="tf_loading"></div>
<div id="tf_bg" class="tf_bg">
	<?php
	    foreach($all_photo_arr as $key => $photo)
	    {
	        $small_image_url = get_template_directory_uri().'/images/000_70.png';
	        $hyperlink_url = get_permalink($photo->ID);
	        
	        if(!empty($photo->guid))
	        {
	        	$image_url[0] = $photo->guid;
	        
	        	$small_image_url = wp_get_attachment_image_src( $photo->ID, 'thumbnail');
	        }
	?>
    	<img src="<?php echo $image_url[0]; ?>" alt="" longdesc="<?php echo $small_image_url[0]; ?>" />
    <?php
        }
       ?>
</div>
<div id="tf_thumbs" class="tf_thumbs">
    <span id="tf_zoom" class="tf_zoom"></span>
    <?php
    if(isset($all_photo_arr[0]))
    {
    	$small_image_url = wp_get_attachment_image_src( $all_photo_arr[0]->ID, 'thumbnail');
    	
    	if(isset($small_image_url[0]))
    	{
    ?>
    <img src="<?php echo $small_image_url[0]; ?>" alt=""/>
    <?php
    	}
    }
    ?>
</div>

<div id="tf_next" class="tf_next"></div>
<div id="tf_prev" class="tf_prev"></div>

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
	$pp_homepage_style = 'flip';
	
	get_footer();
?>