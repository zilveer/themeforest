<?php
/**
 * The main template file.
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

//important to apply dynamic header & footer style
$grandportfolio_homepage_style = grandportfolio_get_homepage_style();
grandportfolio_set_homepage_style('fullscreen');

get_header(); 

wp_enqueue_script("kenburns", get_template_directory_uri()."/js/kenburns.js", false, THEMEVERSION, true);
?>
<div id="kenburns_overlay"></div>
<canvas id="kenburns">
    <p><?php esc_html_e('Your browser doesn\'t support canvas!', 'grandportfolio-translation' ); ?></p>
</canvas>

<?php
	//Print kenburns gallery javascript
	
	$pp_gallery_cat = $current_page_id;
	
	$tg_slideshow_timer = kirki_get_option('tg_slideshow_timer'); 
	
	if(empty($tg_slideshow_timer))
	{
	    $tg_slideshow_timer = 5;
	}
	
	$all_photo_arr = get_post_meta($pp_gallery_cat, 'wpsimplegallery_gallery', true);
	
	//Get default gallery sorting
	$all_photo_arr = grandportfolio_resort_gallery_img($all_photo_arr);
	
	$count_photo = count($all_photo_arr);
	
	//Get timer setting				
	$tg_kenburns_timer = kirki_get_option('tg_kenburns_timer');
	
	if(empty($tg_kenburns_timer))
	{
		$tg_kenburns_timer = 5000;
	}
	else
	{
		$tg_kenburns_timer = $tg_kenburns_timer*1000;
	}
	
	//Get zoom level
	$tg_kenburns_zoom = kirki_get_option('tg_kenburns_zoom');
	if(empty($tg_kenburns_zoom))
	{
		$tg_kenburns_zoom = 1.1;
	}
	else
	{
		$tg_kenburns_zoom = 1+($tg_kenburns_zoom/10);
	}
	
	//Get transition speed
	$tg_kenburns_trans = kirki_get_option('tg_kenburns_trans');
	if(empty($tg_kenburns_trans))
	{
		$tg_kenburns_trans = 1000;
	}
	
	$pp_kenburns_frames_rate = 100;
?>
<script>
jQuery(document).ready(function(){ 
	var $canvas = jQuery('#kenburns');

    $canvas.attr('width', jQuery(window).width());
    $canvas.attr('height', jQuery(window).height());

    var kb = $canvas.kenburned({
        images : [
        <?php
	    	$key = 0;
	        foreach($all_photo_arr as $photo_id)
	        {
	            $image_url = wp_get_attachment_image_src($photo_id, 'original', true);
	    
	    ?>
	    		'<?php echo esc_url($image_url[0]); ?>'
	    <?php
	    		if($count_photo > ($key+1))
	    		{
	    			echo ',';
	    		}
	    		$key++;
	    	}
	    ?>
        ],
        frames_per_second: <?php echo esc_js($pp_kenburns_frames_rate); ?>,
	    display_time: <?php echo esc_js($tg_kenburns_timer); ?>,
	    zoom: <?php echo esc_js($tg_kenburns_zoom); ?>,
	    fade_time: <?php echo esc_js($tg_kenburns_trans); ?>,
    });
    
    jQuery(window).resize(function() {
		jQuery('#kenburns').remove();
		jQuery('#kenburns_overlay').remove();
		
		jQuery('body #wrapper').append('<canvas id="kenburns"></canvas>');
		jQuery('body #wrapper').append('<div id="kenburns_overlay"></div>');
	
	  	var $canvas = jQuery('#kenburns');

	    $canvas.attr('width', jQuery(window).width());
	    $canvas.attr('height', jQuery(window).height());
	
	    var kb = $canvas.kenburned({
	        images : [
	        <?php
		    	$key = 0;
		        foreach($all_photo_arr as $photo_id)
		        {
		            $image_url = wp_get_attachment_image_src($photo_id, 'original', true);
		    
		    ?>
		    		'<?php echo esc_url($image_url[0]); ?>'
		    <?php
		    		if($count_photo > ($key+1))
		    		{
		    			echo ',';
		    		}
		    		$key++;
		    	}
		    ?>
	        ],
	        frames_per_second: <?php echo esc_js($pp_kenburns_frames_rate); ?>,
		    display_time: <?php echo esc_js($tg_kenburns_timer); ?>,
		    zoom: <?php echo esc_js($tg_kenburns_zoom); ?>,
		    fade_time: <?php echo esc_js($tg_kenburns_trans); ?>,
	    });
	});
    
    jQuery('#kb-prevslide ').click(function(ev) {
        ev.preventDefault();
        kb.prevSlide();
    });

    jQuery('#kb-nextslide').click(function(ev) {
        ev.preventDefault();
        kb.nextSlide();
    });
		
});
</script>
<?php
	get_footer();
?>