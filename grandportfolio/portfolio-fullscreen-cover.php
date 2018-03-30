<?php
/**
 * Template Name: Portfolio Fullscreen Slideshow
 * The main template file for display gallery fullscreen.
 *
 * @package WordPress
 */

//important to apply dynamic header & footer style
$grandportfolio_homepage_style = grandportfolio_get_homepage_style();
grandportfolio_set_homepage_style('fullscreen');

function grandportfolio_supersized_scripts() {
	//Run gallery script data
	wp_enqueue_style("supersized", get_template_directory_uri()."/css/supersized.css", false, THEMEVERSION, "all");
	wp_enqueue_style("supersized-shutter", get_template_directory_uri()."/css/supersized.shutter.css", false, THEMEVERSION, "all");
	
	wp_enqueue_script("supersized", get_template_directory_uri()."/js/supersized.3.2.7.min.js", false, THEMEVERSION);
	wp_enqueue_script("supersized-shutter", get_template_directory_uri()."/js/supersized.shutter.min.js", false, THEMEVERSION);
	wp_enqueue_script("touchwipe", get_template_directory_uri()."/js/jquery.touchwipe.1.1.1.js", false, THEMEVERSION);
}

add_action( 'wp_enqueue_scripts', 'grandportfolio_supersized_scripts' );

get_header();
?>

<div id="thumb-tray" class="load-item">
    <a id="prevslide" class="load-item portfolio"></a>
    <a id="nextslide" class="load-item portfolio"></a>
</div>

<div class="overlay"></div>

<div id="controls-wrapper" class="portfolio load-item">
	<div id="controls">
	    <?php
	        $tg_full_image_caption = kirki_get_option('tg_full_image_caption');
	        if(!empty($tg_full_image_caption))
	        {
	    ?>
	        <!--Slide captions displayed here--> 
	        <div id="slidecaption" class="portfolio_slideshow"></div>
	    <?php
	        }
	    ?>
	</div>
</div>

<?php
//Print javascript code
$tg_full_slideshow_timer = kirki_get_option('tg_full_slideshow_timer'); 
if(empty($tg_full_slideshow_timer))
{
    $tg_full_slideshow_timer = 5;
}

$tg_full_slideshow_trans_speed = kirki_get_option('tg_full_slideshow_trans_speed');
if(empty($tg_full_slideshow_trans_speed))
{
    $tg_full_slideshow_trans_speed = 400;
}

//Get portfolio items
$args = array(
    'numberposts' => -1,
    'order' => 'ASC',
    'orderby' => 'menu_order',
    'post_type' => array('portfolios'),
    'suppress_filters' => false,
);

$all_photo_arr = get_posts($args);
$count_photo = count($all_photo_arr);

$homeslides = '';

if(!empty($count_photo))
{
?>
<script>
jQuery(function($){
    	$.supersized({
    		<?php						
    			$tg_full_autoplay = kirki_get_option('tg_full_autoplay');
    			
    			if(empty($tg_full_autoplay))
    			{
    				$tg_full_autoplay = 0;
    			}
    		?>
    		//Functionality
    		slideshow               :   1,		//Slideshow on/off
    		autoplay				:	<?php echo esc_js($tg_full_autoplay); ?>,		//Slideshow starts playing automatically
    		start_slide             :   1,		//Start slide (0 is random)
    		random					: 	0,		//Randomize slide order (Ignores start slide)
    		slide_interval          :   <?php echo intval($tg_full_slideshow_timer*1000); ?>,	//Length between transitions
    		<?php						
    			$tg_full_slideshow_trans = kirki_get_option('tg_full_slideshow_trans');
    			
    			if(empty($tg_full_slideshow_trans))
    			{
    				$tg_full_slideshow_trans = 1;
    			}
    		?>
    		transition              :   <?php echo esc_js($tg_full_slideshow_trans); ?>, 		//0-None, 1-Fade, 2-Slide Top, 3-Slide Right, 4-Slide Bottom, 5-Slide Left, 6-Carousel Right, 7-Carousel Left
    		transition_speed		:	<?php echo esc_js($tg_full_slideshow_trans_speed); ?>,	//Speed of transition
    		new_window				:	1,		//Image links open in new window/tab
    		pause_hover             :   1,		//Pause slideshow on hover
    		keyboard_nav            :   1,		//Keyboard navigation on/off
    		performance				:	1,		//0-Normal, 1-Hybrid speed/quality, 2-Optimizes image quality, 3-Optimizes transition speed // (Only works for Firefox/IE, not Webkit)
    		image_protect			:	0,		//Disables image dragging and right click with Javascript

    		//Size & Position
    		min_width		        :   0,		//Min width allowed (in pixels)
    		min_height		        :   0,		//Min height allowed (in pixels)
    		vertical_center         :   1,		//Vertically center background
    		horizontal_center       :   1,		//Horizontally center background
    		<?php	
    			$tg_full_nocover = kirki_get_option('tg_full_nocover'); 
    			$tg_full_nocover = (int)$tg_full_nocover;
    							
    			if(empty($tg_full_nocover))
				{
					$pp_full_fit_image = 0;
				}
    			else
    			{
    				$pp_full_fit_image = 1;
    			}
    		?>
    		fit_portrait         	:   <?php echo intval($pp_full_fit_image); ?>,		//Portrait images will not exceed browser height
    		fit_landscape			:   <?php echo intval($pp_full_fit_image); ?>,		//Landscape images will not exceed browser width
    		fit_always				: 	<?php echo intval($pp_full_fit_image); ?>,
    		
    		//Components
    		navigation              :   0,		//Slideshow controls on/off
    		thumbnail_navigation    :  	0,		//Thumbnail navigation
    		slide_counter           :   0,		//Display slide numbers
    		slide_captions          :   0,		//Slide caption (Pull from "title" in slides array)
    		progress_bar			:	0,
    		slides 					:  	[		//Slideshow Images
<?php
	
    foreach($all_photo_arr as $portfolio)
	{
        $portfolio_ID = $portfolio->ID;
					
		if(has_post_thumbnail($portfolio_ID, 'original'))
		{
		    $image_id = get_post_thumbnail_id($portfolio_ID);
		    $image_url = wp_get_attachment_image_src($image_id, 'original', true);
		}
		
		$portfolio_link_url = get_post_meta($portfolio_ID, 'portfolio_link_url', true);
		
		if(empty($portfolio_link_url))
		{
		    $permalink_url = get_permalink($portfolio_ID);
		}
		else
		{
		    $permalink_url = $portfolio_link_url;
		}
		
		$image_title_html = '<div class="ppb_subtitle">'.$portfolio->post_excerpt.'</div>';
		$image_title_html.= '<a href="'.esc_url($permalink_url).'"><h2 class="ppb_title">'.$portfolio->post_title.'</h2></a>';
?>
<?php $homeslides .= '{image : \''.esc_url($image_url[0]).'\', title: \'<div id="gallery_caption">'.$image_title_html.'</div>\'},'; ?>
<?php
	}
?>

    	<?php $homeslides = substr($homeslides,0,-1);
    	echo stripslashes($homeslides); ?>						]
    									
    	}); 
    });

jQuery(document).ready(function(){ 
	jQuery('html[data-style=fullscreen]').touchwipe({
		wipeLeft: function(){ 
	    	api.prevSlide();
	  	},
	   	wipeRight: function(){ 
	       	api.nextSlide();
	   	}
	});
});
</script>
<?php
}

	get_footer();
?>