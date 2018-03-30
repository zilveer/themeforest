<?php
/**
 * Template Name: Blog
 * The main template file for display blog page.
 *
 * @package WordPress
*/

/**
*	Get Current page object
**/
$page = get_page($post->ID);

/**
*	Get current page id
**/

if(!isset($current_page_id) && isset($page->ID))
{
    $current_page_id = $page->ID;
}

if(!isset($hide_header) OR !$hide_header)
{
	get_header(); 
}

$page_style = 'Right Sidebar';
$caption_style = get_post_meta($current_page_id, 'caption_style', true);

if(empty($caption_style))
{
	$caption_style = 'Title & Description';
}

if(!isset($sidebar_home))
{
	$sidebar_home = '';
}

if(empty($page_sidebar))
{
	$page_sidebar = 'Blog Sidebar';
}
$caption_class = "page_caption";

if(!isset($add_sidebar))
{
	$add_sidebar = FALSE;
}

$sidebar_class = '';

if($page_style == 'Right Sidebar')
{
	$add_sidebar = TRUE;
	$page_class = 'sidebar_content';
}
elseif($page_style == 'Left Sidebar')
{
	$add_sidebar = TRUE;
	$page_class = 'sidebar_content';
	$sidebar_class = 'left_sidebar';
}
else
{
	$page_class = 'inner_wrapper';
}

?>		

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
	
		<!-- Begin content -->
		<div id="page_content_wrapper">
			
			<div class="inner">

				<!-- Begin main content -->
				<div class="inner_wrapper">
				
					<div id="page_caption" class="sidebar_content full_width" style="padding-bottom:0">
						<div style="float:left">
							<h1 class="cufon"><?php the_title(); ?></h1>
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

					<div class="sidebar_content">
					
<?php

global $more; $more = false; # some wordpress wtf logic

$query_string ="post_type=post&paged=$paged";
query_posts($query_string);

if (have_posts()) : while (have_posts()) : the_post();

	$image_thumb = '';
								
	if(has_post_thumbnail(get_the_ID(), 'large'))
	{
	    $image_id = get_post_thumbnail_id(get_the_ID());
	    $image_thumb = wp_get_attachment_image_src($image_id, 'large', true);
	    
	    
	  	$pp_blog_image_width = 600;
		$pp_blog_image_height = 260;
	}
?>
						
						
						<!-- Begin each blog post -->
						<div class="post_wrapper">
						
							<?php
								if(!empty($image_thumb))
								{
									$small_image_url = wp_get_attachment_image_src($image_id, 'blog', true);
							?>
							
							<br class="clear"/>
							<div class="post_img">
								<div class="shadow">
    								<div class="zoom"><?php _e( 'Enlarge Image', THEMEDOMAIN ); ?></div>
    							</div>
								<a href="<?php echo $image_thumb[0]; ?>" class="img_frame">
									<img src="<?php echo $small_image_url[0]; ?>" alt="" class=""/>
								</a>
							</div>
							
							<?php
								}
							?>
							
							<br/>
							
							<?php
								$post_header_style = 'style="width:100%;"';
								$pp_blog_display_social = get_option('pp_blog_display_social');
								
								if(!empty($pp_blog_display_social))
								{
									$post_header_style = '';
							?>
							<div class="post_social">
								<iframe class="facebook_button" src="//www.facebook.com/plugins/like.php?app_id=262802827073639&amp;href=<?php echo urlencode(get_permalink()); ?>&amp;send=false&amp;layout=box_count&amp;width=200&amp;show_faces=true&amp;action=like&amp;colorscheme=light&amp;font&amp;height=90" scrolling="no" frameborder="0" style="border:none; overflow:hidden; width:60px; height:90px;" allowTransparency="true"></iframe>
								
								<a href="https://twitter.com/share" data-text="<?php the_title(); ?>" data-url="<?php echo get_permalink(); ?>" class="twitter-share-button" data-count="vertical">Tweet</a><script type="text/javascript" src="//platform.twitter.com/widgets.js"></script>
							</div>
							<?php
								}
							?>
							
							<div class="post_header" <?php echo $post_header_style; ?>>
								<h3 class="cufon"><a href="<?php the_permalink(); ?>" title="<?php the_title(); ?>"><?php the_title(); ?></a></h3>
								<div class="post_detail">
								<?php echo _e( 'Posted by', THEMEDOMAIN ); ?> <?php echo get_the_author(); ?> on <?php echo get_the_time('d M Y'); ?> /
									<a href=""><?php comments_number('0 Comment', '1 Comment', '% Comments'); ?></a>
								</div>
							</div>
							
							<br class="clear"/>
							
							<?php
								$pp_blog_display_full = get_option('pp_blog_display_full');
								
								if(!empty($pp_blog_display_full))
								{
									the_content();
								}
								else
								{
									the_excerpt();
							?>
							
									<br/><br/>
									<a href="<?php the_permalink(); ?>"><?php echo _e( 'Read more', THEMEDOMAIN ); ?> →</a>
							
							<?php
								}
							?>
							
						</div>
						<!-- End each blog post -->



<?php endwhile; endif; ?>

						<div class="pagination"><p><?php posts_nav_link(' '); ?></p></div>
						
					</div>
					
					<?php
						if($add_sidebar && $page_style == 'Right Sidebar')
						{
					?>
						<div class="sidebar_wrapper <?php echo $sidebar_class; ?>">
						
							<div class="sidebar_top <?php echo $sidebar_class; ?>"></div>
						
							<div class="sidebar <?php echo $sidebar_class; ?> <?php echo $sidebar_home; ?>">
							
								<div class="content">
							
									<ul class="sidebar_widget">
									<?php dynamic_sidebar($page_sidebar); ?>
									</ul>
								
								</div>
						
							</div>
							<br class="clear"/>
					
							<div class="sidebar_bottom <?php echo $sidebar_class; ?>"></div>
						</div>
					<?php
						}
					?>
					
				</div>
				<!-- End main content -->
				
			</div>
			<br class="clear"/>
			<?php get_footer(); ?>
<?php
if(!isset($hide_header) OR !$hide_header)
{
?>
			
		</div>
		<!-- End content -->
		<br class="clear"/>
				

<?php
}
?>