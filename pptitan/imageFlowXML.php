<?php
if(file_exists('../../../wp-load.php'))
{
	require_once( '../../../wp-load.php' );
}
else
{
	require_once( '../../../../wp-load.php' );
}

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

if(!isset($_GET['gallery_id']) OR empty($_GET['gallery_id']))
{
	$pp_homepage_slideshow_cat = get_option('pp_homepage_slideshow_cat');
	$homepage_items = -1;

	$args = array( 
	    'post_type' => 'attachment', 
	    'numberposts' => $homepage_items, 
	    'post_status' => null, 
	    'post_parent' => $pp_homepage_slideshow_cat,
	    'order' => $pp_order,
	    'orderby' => $pp_orderby,
	); 
	$all_photo_arr = get_posts( $args );
}
else
{
	$portfolio_items = -1;

	$args = array( 
	    'post_type' => 'attachment', 
	    'numberposts' => $portfolio_items, 
	    'post_status' => null, 
	    'post_parent' => $_GET['gallery_id'],
	    'order' => $pp_order,
	    'orderby' => $pp_orderby,
	); 
	$all_photo_arr = get_posts( $args );
}

header("Content-type: text/xml");
echo '<?xml version="1.0" encoding="utf-8" ?>
		<bank>';
		
//$pp_flow_enable_slideshow_title = get_option('pp_flow_enable_slideshow_title');
		
foreach($all_photo_arr as $photo)
{
	$full_image_url = wp_get_attachment_image_src( $photo->ID, 'full' );
	$small_image_url = wp_get_attachment_image_src( $photo->ID, 'large' );

	echo '<img>';
	echo '<src>'.$small_image_url[0].'</src>';
	echo '<link>'.$full_image_url[0].'</link>';
	
	/*if(!empty($pp_flow_enable_slideshow_title))
	{
		echo '<title>'.$photo->post_title.'</title>';
		echo '<caption>'.$photo->post_content.'</caption>';
	}
	else
	{
		echo '<title></title>';
		echo '<caption></caption>';
	}*/
	echo '<title></title>';
	echo '<caption></caption>';
	
	echo '</img>';
}
		
echo '</bank>';
?>
