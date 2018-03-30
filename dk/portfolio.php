<?php
/**
 * Template Name: Portfolio
 * The main template file for display portfolio page.
 *
 * @package WordPress
*/

session_start();

if(!isset($hide_header) OR !$hide_header)
{
	get_header(); 
}

/**
*	Get Current page object
**/
$page = get_page($post->ID);
$current_page_id = '';

if(isset($page->ID))
{
    $current_page_id = $page->ID;
}

//prepare data for pagintion
$offset_query = '';
if(!isset($_GET['page']) OR empty($_GET['page']) OR $_GET['page'] == 1)
{
    $current_page = 1;
}
else
{ 
    $current_page = $_GET['page'];
    $offset = (($current_page-1) * $portfolio_items);
}

$args = array(
    'numberposts' => $portfolio_items,
    'order' => 'ASC',
    'orderby' => 'date',
    'post_type' => array('portfolios'),
    'offset' => $offset,
);
if(!empty($term))
{
    $args['portfoliosets'].= $term;
}

$page_photo_arr = get_posts($args);


//Get all portfolio items for paging

$args = array(
    'numberposts' => -1,
    'order' => $portfolio_sort,
    'orderby' => 'date',
    'post_type' => array('portfolios'),
);
if(!empty($term))
{
    $args['portfoliosets'].= $term;
}

$all_photo_arr = get_posts($args);
$total = count($all_photo_arr);

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
			
			<?php
					$pp_gallery_width = 420;
					$pp_gallery_height = 340;
			?>
			
			<div class="inner">
		
				<div class="inner_wrapper">
				
				<?php
				    if(!empty($term))
				    {
				    	$portfolio_sets_query.= $term;
				    	
				    	$obj_term = get_term_by('slug', $term, 'portfoliosets');
				    	$custom_title = $obj_term->name;
				    }
				    else
				    {
				    	$custom_title = get_the_title();
				    }
				?>
				<div id="page_caption" class="sidebar_content full_width" style="padding-bottom:0">		
					<div style="float:left">
						<h1 class="cufon"><?php echo $custom_title; ?></h1>
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
						if(!empty($post->post_content) && empty($term))
						{
					?>
						<p><?php echo nl2br(stripslashes(html_entity_decode(do_shortcode($post->post_content)))); ?></p>
						<br/>
					<?php
						}
					?>
				
				<?php
					foreach($all_photo_arr as $key => $portfolio_item)
					{
						$image_url = '';
								
						if(has_post_thumbnail($portfolio_item->ID, 'large'))
						{
						    $image_id = get_post_thumbnail_id($portfolio_item->ID);
						    $image_url = wp_get_attachment_image_src($image_id, 'full', true);
						    
						    $small_image_url = wp_get_attachment_image_src($image_id, 'gallery_2', true);
						}
						
						$portfolio_link_url = get_post_meta($portfolio_item->ID, 'portfolio_link_url', true);
						
						if(empty($portfolio_link_url))
						{
						    $permalink_url = get_permalink($portfolio_item->ID);
						}
						else
						{
						    $permalink_url = $portfolio_link_url;
						}
						
						$last_class = '';
						if(($key+1)%2==0)
						{
							$last_class = 'last';
						}
				?>
				
				<div class="one_half <?php echo $last_class; ?>" style="margin-top:3%">
				<div class="one_half gallery2" style="width:100%">
					<?php 
    					if(!empty($image_url[0]))
    					{
    				?>		
							
							<?php
    								$portfolio_type = get_post_meta($portfolio_item->ID, 'portfolio_type', true);
    								$portfolio_video_id = get_post_meta($portfolio_item->ID, 'portfolio_video_id', true);
    								switch($portfolio_type)
    								{
    								case 'External Link':
    								default:
    							?>
    							<div class="shadow">
    								<div class="zoom"><?php _e( 'View', THEMEDOMAIN ); ?></div>
    							</div>
								<a title="<?php echo $portfolio_item->post_title; ?>" href="<?php echo $permalink_url; ?>" onclick="location.href='<?php echo $permalink_url; ?>'">
									<img src="<?php echo $small_image_url[0]; ?>" alt="" class="one_half_img"/>
								</a>
    							
    							<?php
    								break;
    								//end external link
    								
    								case 'Image':
    							?>
    							<div class="shadow">
    								<div class="zoom"><?php _e( 'Enlarge', THEMEDOMAIN ); ?></div>
    							</div>
								<a rel="gallery" href="<?php echo $image_url[0]; ?>">
									<img src="<?php echo $small_image_url[0]; ?>" alt="" class="one_half_img"/>
								</a>
    							
    							<?php
    								break;
    								//end image
    								
    								case 'Youtube Video':
    							?>
    							<div class="shadow">
    								<div class="zoom"><?php _e( 'Play', THEMEDOMAIN ); ?></div>
    							</div>
								<a title="<?php echo $portfolio_item->post_title; ?>" href="#video_<?php echo $portfolio_video_id; ?>" class="lightbox_youtube">
									<img src="<?php echo $small_image_url[0]; ?>" alt="" class="one_half_img"/>
								</a>
    								
<div style="display:none;">
    <div id="video_<?php echo $portfolio_video_id; ?>" style="width:640px;height:394px">
        
        <iframe title="YouTube video player" width="640" height="394" src="http://www.youtube.com/embed/<?php echo $portfolio_video_id; ?>?theme=dark&rel=0&wmode=transparent" frameborder="0" allowfullscreen></iframe>
        
    </div>	
</div>
    							
    							<?php
    								break;
    								//end image
    							
    							case 'Vimeo Video':
    							?>
    							<div class="shadow">
    								<div class="zoom">Play</div>
    							</div>
								<a title="<?php echo $portfolio_item->post_title; ?>" href="#video_<?php echo $portfolio_video_id; ?>" class="lightbox_vimeo">
									<img src="<?php echo $small_image_url[0]; ?>" alt="" class="one_half_img"/>
								</a>
    								
<div style="display:none;">
    <div id="video_<?php echo $portfolio_video_id; ?>" style="width:640px;height:360px">
    
        <iframe src="http://player.vimeo.com/video/<?php echo $portfolio_video_id; ?>?title=0&amp;byline=0&amp;portrait=0&amp;color=ffffff" width="640" height="360" frameborder="0"></iframe>
        
    </div>	
</div>
    							
    							<?php
    								break;
    								//end image
    							?>
    							
    							<?php
    								}
    								//end switch
    							?>
					<?php
    					}		
    				?>			
					
				</div>
				
				<br class="clear"/>
				<div class="portfolio_desc" style="width:400px;height:130px;padding-top:10px">
				    <h3 class="cufon"><?php echo $portfolio_item->post_title?></h3><br/>
				    <span>
				    <?php echo pp_substr(strip_tags(strip_shortcodes($portfolio_item->post_content)),160); ?>																	
				    </span>
				</div>
				
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