<?php
/**
 * The main template file for display portfolio page.
 *
 * Template Name: Gallery 4 Columns
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
		include (TEMPLATEPATH . "/templates/template-password.php");
		exit;
	}
}

$gallery_id = get_post_meta($current_page_id, 'page_gallery_id', true);

$args = array( 
	'post_type' => 'attachment', 
	'numberposts' => $portfolio_items, 
	'post_status' => null, 
	'post_parent' => $gallery_id,
	'order' => 'ASC',
	'orderby' => 'menu_order',
); 
$all_photo_arr = get_posts( $args );

get_header(); ?>

		<?php
		$bg_style = get_post_meta($current_page_id, 'page_bg_style', true);
		
		if($bg_style == 'Static Image')
		{
			if(has_post_thumbnail($current_page_id, 'full'))
			{
			    $image_id = get_post_thumbnail_id($current_page_id); 
			    $image_thumb = wp_get_attachment_image_src($image_id, 'full', true);
			    $pp_page_bg = $image_thumb[0];
			}
			else
			{
				$pp_page_bg = get_stylesheet_directory_uri().'/example/bg.jpg';
			}
		?>
		<script type="text/javascript"> 
			jQuery.backstretch( "<?php echo $pp_page_bg; ?>", {speed: 'slow'} );
		</script>
		
		<?php
		} // end if static image
		else
		{
			$page_bg_gallery_id = get_post_meta($current_page_id, 'page_bg_gallery_id', true);
			$args = array( 
				'post_type' => 'attachment', 
				'numberposts' => -1, 
				'post_status' => null, 
				'post_parent' => $page_bg_gallery_id,
				'order' => 'ASC',
				'orderby' => 'menu_order',
			); 
			$bg_photo_arr = get_posts( $args );
		?>
		
		<link rel="stylesheet" href="<?php echo get_stylesheet_directory_uri(); ?>/css/supersized.css" type="text/css" media="screen" />

		<script type="text/javascript" src="<?php echo get_stylesheet_directory_uri(); ?>/js/supersized.3.1.3.js"></script>
		<script type="text/javascript" src="<?php echo get_stylesheet_directory_uri(); ?>/js/supersized.shutter.js"></script>
		
		<script type="text/javascript">  
			
			jQuery(function($){
				$.supersized({
				
					//Functionality
					slideshow               :   1,		//Slideshow on/off
					autoplay				:	1,		//Slideshow starts playing automatically
					start_slide             :   1,		//Start slide (0 is random)
					random					: 	0,		//Randomize slide order (Ignores start slide)
					slide_interval          :   10000,	//Length between transitions
					<?php						
						$pp_homepage_slideshow_trans = get_option('pp_homepage_slideshow_trans');
						
						if(empty($pp_homepage_slideshow_trans))
						{
							$pp_homepage_slideshow_trans = 1;
						}
					?>
					transition              :   <?php echo $pp_homepage_slideshow_trans; ?>, 		//0-None, 1-Fade, 2-Slide Top, 3-Slide Right, 4-Slide Bottom, 5-Slide Left, 6-Carousel Right, 7-Carousel Left
					transition_speed		:	500,	//Speed of transition
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
					<?php						
						$pp_enable_fit_image = get_option('pp_enable_fit_image');
						
						if(empty($pp_enable_fit_image))
						{
							$pp_enable_fit_image = 1;
						}
						else
						{
							$pp_enable_fit_image = 0;
						}
					?>
					fit_portrait         	:   <?php echo $pp_enable_fit_image; ?>,		//Portrait images will not exceed browser height
					fit_landscape			:   <?php echo $pp_enable_fit_image; ?>,		//Landscape images will not exceed browser width
					
					//Components
					navigation              :   1,		//Slideshow controls on/off
					thumbnail_navigation    :   0,		//Thumbnail navigation
					slide_counter           :   0,		//Display slide numbers
					slide_captions          :   0,		//Slide caption (Pull from "title" in slides array)
					progress_bar			:	1,
					slides 					:  	[		//Slideshow Images
														  
	

		<?php
			foreach($bg_photo_arr as $key => $photo)
			{
			    $small_image_url = get_stylesheet_directory_uri().'/images/000_70.png';
			    $hyperlink_url = get_permalink($photo->ID);
			    
			    if(!empty($photo->guid))
			    {
			    	$image_url[0] = $photo->guid;
			    }

		?>

        	<?php $homeslides .= '{image : \''.$image_url[0].'\', thumb: \''.$small_image_url.'\', title: "<div id=\"gallery_title\">'.htmlentities($photo->post_title).'</div><div id=\"gallery_desc\">'.htmlentities($photo->post_content).'</div>"},'; ?>
        	
        <?php
        	}
        ?>

						<?php $homeslides = substr($homeslides,0,-1);
						echo $homeslides; ?>						]
												
				}); 
		    });
		    
		</script>
		
		<!--Time Bar-->
		<div id="progress-back" class="load-item">
			<div id="progress-bar"></div>
		</div>
		
		<div id="thumb-tray" class="load-item">
			<div id="thumb-back"></div>
			<div id="thumb-forward"></div>
		</div>
		
		<!--Control Bar-->
		<div id="controls-wrapper" class="load-item">
			<div id="controls">
				
				<!--Arrow Navigation--> 
				<a id="prevslide" class="load-item"><img src="<?php echo get_stylesheet_directory_uri(); ?>/images/icon_prev.png" alt=""/></a>
				
				<a id="play-button"><img id="pauseplay" src="<?php echo get_stylesheet_directory_uri(); ?>/images/pause.png" alt=""></a>
				 
				<a id="nextslide" class="load-item"><img src="<?php echo get_stylesheet_directory_uri(); ?>/images/icon_next.png" alt=""/></a>		
				<!--Thumb Tray button-->
				<a id="tray-button"><img id="tray-arrow" src="<?php echo get_stylesheet_directory_uri(); ?>/images/button-tray-up.png" alt=""/></a>	
			</div>
			
		</div>
		
		<input type="hidden" id="pp_image_path" name="pp_image_path" value="<?php echo get_stylesheet_directory_uri(); ?>/images/"/>
		
		<?php
		}
		?>
		
		<?php
			if(!empty($all_photo_arr))
			{
		?>
		
		<!-- Begin content -->
		<div id="page_content_wrapper">
			
			<div class="inner">
		
				<div class="inner_wrapper">
				
				<div id="page_caption" class="sidebar_content full_width" style="padding-bottom:0">
					<div style="float:left">
						<h1 class="cufon"><?php echo $post->post_title; ?></h1>
					</div>
					<div class="page_control">
						<a id="page_minimize" href="#">
							<img src="<?php echo get_stylesheet_directory_uri(); ?>/images/icon_minus.png" alt=""/>
						</a>
						<a id="page_maximize" href="#">
							<img src="<?php echo get_stylesheet_directory_uri(); ?>/images/icon_plus.png" alt=""/>
						</a>
					</div>
				</div>
				
				<div class="sidebar_content full_width">
					<?php
						if(!empty($post->post_content))
						{
					?>
						<p><?php echo nl2br(stripslashes(html_entity_decode(do_shortcode($post->post_content)))); ?></p>
						<br/>
					<?php
						}
					?>
				
				<?php
					foreach($all_photo_arr as $key => $photo)
					{
						$small_image_url = get_stylesheet_directory_uri().'/images/000_70.png';
						$hyperlink_url = get_permalink($photo->ID);
						
						if(!empty($photo->guid))
    					{
    						$image_url[0] = $photo->guid;
    					    $small_image_url = wp_get_attachment_image_src($photo->ID, 'gallery_4', true);
    					}
						
						$last_class = '';
						if(($key+1)%4==0)
						{
							$last_class = 'last';
						}
				?>
				
				<div class="one_fourth <?php echo $last_class; ?> gallery4" style="margin-bottom:0;margin-top:3%">
					<?php 
    					if(!empty($small_image_url))
    					{
    						$pp_portfolio_enable_slideshow_title = get_option('pp_portfolio_enable_slideshow_title');
    				?>	
    						<div class="shadow">
    							<div class="zoom"><?php _e( 'Enlarge', THEMEDOMAIN ); ?></div>
    						</div>	
							<a rel="gallery" href="<?php echo $image_url[0]; ?>" <?php if(!empty($pp_portfolio_enable_slideshow_title)) { ?>title="<?php echo $photo->post_title; ?>"<?php } ?>>
								<img src="<?php echo $small_image_url[0]; ?>" alt="" class="one_fourth_img"/>
							</a>
					<?php
    					}		
    				?>			
					
				</div>
				
				<?php
					}
				?>
				</div>
				</div>
			
			</div>
			<br class="clear"/>
			<?php get_footer(); ?>
			
		</div>
		<!-- End content -->
		
		<?php
			}
		?>
		<br class="clear"/>
		</div>