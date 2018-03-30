<?php header("content-type: application/x-javascript"); ?> 

<?php
define('WP_DEBUG', false);
@ini_set('log_errors','On'); 
@ini_set('display_errors','Off'); 
require_once( '../../../../wp-load.php' );

$pp_gallery_cat = '';
	
if(isset($_GET['gallery_id']))
{
    $pp_gallery_cat = $_GET['gallery_id'];
}

$pp_slideshow_timer = get_option('pp_slideshow_timer'); 

if(empty($pp_slideshow_timer))
{
    $pp_slideshow_timer = 5;
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

$args = array( 
    'post_type' => 'attachment', 
    'numberposts' => -1, 
    'post_status' => null, 
    'post_parent' => $pp_gallery_cat,
    'order' => $pp_order,
    'orderby' => $pp_orderby,
); 

$all_photo_arr = get_posts( $args );
$count_photo = count($all_photo_arr);

$homeslides = '';

//if image is not empty
if(!empty($count_photo))
{
?>

jQuery(function($){
    	$.supersized({
    	
    		<?php						
    			$pp_portfolio_slideshow_timer = get_option('pp_portfolio_slideshow_timer');
    			
    			if(empty($pp_portfolio_slideshow_timer))
    			{
    				$pp_portfolio_slideshow_timer = 5;
    			}
    		?>
    		//Functionality
    		slideshow               :   1,		//Slideshow on/off
    		autoplay				:	0,		//Slideshow starts playing automatically
    		start_slide             :   1,		//Start slide (0 is random)
    		random					: 	0,		//Randomize slide order (Ignores start slide)
    		slide_interval          :   <?php echo $pp_portfolio_slideshow_timer*1000; ?>,	//Length between transitions
    		transition              :   6, 		//0-None, 1-Fade, 2-Slide Top, 3-Slide Right, 4-Slide Bottom, 5-Slide Left, 6-Carousel Right, 7-Carousel Left
    		transition_speed		:	600,	//Speed of transition
    		new_window				:	1,		//Image links open in new window/tab
    		pause_hover             :   0,		//Pause slideshow on hover
    		keyboard_nav            :   1,		//Keyboard navigation on/off
    		performance				:	1,		//0-Normal, 1-Hybrid speed/quality, 2-Optimizes image quality, 3-Optimizes transition speed // (Only works for Firefox/IE, not Webkit)
    		image_protect			:	0,		//Disables image dragging and right click with Javascript

    		//Size & Position
    		min_width		        :   0,		//Min width allowed (in pixels)
    		min_height		        :   0,		//Min height allowed (in pixels)
    		vertical_center         :   1,		//Vertically center background
    		horizontal_center       :   1,		//Horizontally center background
    		fit_portrait         	:   1,		//Portrait images will not exceed browser height
    		fit_landscape			:   1,		//Landscape images will not exceed browser width
    		
    		//Components
    		navigation              :   0,		//Slideshow controls on/off
    		thumbnail_navigation    :  	0,		//Thumbnail navigation
    		slide_counter           :   0,		//Display slide numbers
    		slide_captions          :   0,		//Slide caption (Pull from "title" in slides array)
    		progress_bar			:	0,
    		slides 					:  	[		//Slideshow Images
<?php
	
    foreach($all_photo_arr as $key => $photo)
    {
        $small_image_url = wp_get_attachment_image_src($photo->ID, 'thumbnail', true);
        $hyperlink_url = get_permalink($photo->ID);
        
        if(!empty($photo->guid))
        {
        	$image_url[0] = $photo->guid;
        }
?>
<?php $homeslides .= '{image : \''.$image_url[0].'\', thumb: \''.$small_image_url[0].'\', title: \'<div id="gallery_caption"><h2>'.esc_js(strip_tags($photo->post_title)).'</h2><br class="clear"/><div class="gallery_desc">'.esc_js(strip_tags($photo->post_content)).'</div></div>\'},'; ?>
<?php
	}
?>

    	<?php $homeslides = substr($homeslides,0,-1);
    	echo $homeslides; ?>						]
    									
    	}); 
    });
<?php
}
?>