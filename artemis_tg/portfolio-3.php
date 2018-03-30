<?php
/**
 * Template Name: Portfolio 3 Columns
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

//prepare data for pagintion
$offset_query = '';
if(!isset($_GET['page']) OR empty($_GET['page']) OR $_GET['page'] == 1)
{
    $current_page = 1;
}


//Get content gallery
$args = array(
    'numberposts' => -1,
    'order' => 'ASC',
    'orderby' => 'menu_order',
    'post_type' => array('portfolios'),
    'portfoliosets' => '',
);
if(!empty($term))
{
    $args['portfoliosets'].= $term;
}

$page_photo_arr = get_posts($args);


//Get all portfolio items for paging
$args = array(
    'numberposts' => -1,
    'order' => 'ASC',
    'orderby' => 'menu_order',
    'post_type' => array('portfolios'),
    'portfoliosets' => '',
);
if(!empty($term))
{
    $args['portfoliosets'].= $term;
}

$all_photo_arr = get_posts($args);

get_header();

//Get Page background style
$bg_style = get_post_meta($current_page_id, 'page_bg_style', true);

if(!empty($term) || $bg_style == 'Static Image')
{
	//If portfolio set page
	if(!empty($term))
	{
		//Get Set background style
		$pp_page_bg = get_option('pp_set_bg'); 
					
		if(empty($pp_page_bg))
		{
		    $pp_page_bg = get_stylesheet_directory_uri().'/example/bg.jpg';
		}
	}
	else
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
    		<?php						
    			$pp_portfolio_slideshow_timer = get_option('pp_portfolio_slideshow_timer');
    			
    			if(empty($pp_portfolio_slideshow_timer))
    			{
    				$pp_portfolio_slideshow_timer = 5000;
    			}
    			else
    			{
    				$pp_portfolio_slideshow_timer = $pp_portfolio_slideshow_timer*1000;
    			}
    		?>
    		slide_interval          :   <?php echo $pp_portfolio_slideshow_timer; ?>,	//Length between transitions
    		<?php						
    			$pp_portfolio_slideshow_trans = get_option('pp_portfolio_slideshow_trans');
    			
    			if(empty($pp_portfolio_slideshow_trans))
    			{
    				$pp_portfolio_slideshow_trans = 1;
    			}
    		?>
    		transition              :   <?php echo $pp_portfolio_slideshow_trans; ?>, 		//0-None, 1-Fade, 2-Slide Top, 3-Slide Right, 4-Slide Bottom, 5-Slide Left, 6-Carousel Right, 7-Carousel Left
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
    			$pp_portfolio_enable_fit_image = get_option('pp_portfolio_enable_fit_image');
    			
    			if(empty($pp_portfolio_enable_fit_image))
    			{
    				$pp_portfolio_enable_fit_image = 1;
    			}
    			else
    			{
    				$pp_portfolio_enable_fit_image = 0;
    			}
    		?>
    		fit_portrait         	:   <?php echo $pp_portfolio_enable_fit_image; ?>,		//Portrait images will not exceed browser height
    		fit_landscape			:   <?php echo $pp_portfolio_enable_fit_image; ?>,		//Landscape images will not exceed browser width
    		
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

<div id="thumb-tray" class="load-item">
    <div id="thumb-back"></div>
    <div id="thumb-forward"></div>
    <a id="prevslide" class="load-item"><img src="<?php echo get_stylesheet_directory_uri(); ?>/images/arrow_back.png" alt=""/></a>
    <a id="nextslide" class="load-item"><img src="<?php echo get_stylesheet_directory_uri(); ?>/images/arrow_forward.png" alt=""/></a>
</div>

<div id="progress-back" class="load-item">
	<div id="progress-bar"></div>
</div>

<input type="hidden" id="pp_image_path" name="pp_image_path" value="<?php echo get_stylesheet_directory_uri(); ?>/images/"/>

<?php
}
?>

<?php
    if(!empty($all_photo_arr))
    {
?>
    
<?php
	//Get social media sharing option
	$pp_social_sharing = get_option('pp_social_sharing');
	
	if(!empty($pp_social_sharing))
	{
?>
<div class="gallery_social">
    <div class="each">
    	<iframe class="facebook_button" src="//www.facebook.com/plugins/like.php?app_id=262802827073639&amp;href=<?php echo urlencode($page->guid); ?>&amp;send=false&amp;layout=box_count&amp;width=200&amp;show_faces=true&amp;action=like&amp;colorscheme=light&amp;font&amp;height=70" scrolling="no" frameborder="0" style="border:none; overflow:hidden; width:50px; height:70px;" allowTransparency="true"></iframe>
    </div>
    <div class="each">				
    	<a href="https://twitter.com/share" data-text="<?php echo $page->post_title; ?>" data-url="<?php echo $page->guid; ?>" class="twitter-share-button" data-count="vertical">Tweet</a><script type="text/javascript" src="//platform.twitter.com/widgets.js"></script>
    </div>
    <div class="each">
    	<!-- Place this tag where you want the +1 button to render -->
    	<g:plusone size="tall" href="<?php echo $page->guid; ?>"></g:plusone>
    	
    	<!-- Place this render call where appropriate -->
    	<script type="text/javascript">
    	  (function() {
    	    var po = document.createElement('script'); po.type = 'text/javascript'; po.async = true;
    	    po.src = 'https://apis.google.com/js/plusone.js';
    	    var s = document.getElementsByTagName('script')[0]; s.parentNode.insertBefore(po, s);
    	  })();
    	</script>
    </div>
</div>
<?php
	}
?>

<div class="page_control">
    <a id="page_minimize" href="#">
    	<img src="<?php echo get_stylesheet_directory_uri(); ?>/images/icon_minus.png" alt=""/>
    </a>
    <a id="page_maximize" href="#">
    	<img src="<?php echo get_stylesheet_directory_uri(); ?>/images/icon_plus.png" alt=""/>
    </a>
</div>

<!-- Begin content -->
<div id="page_content_wrapper">
    
<div class="inner">

	<div class="inner_wrapper">
	
	<?php
		$portfolio_sets_query = '';
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
		<h1 class="cufon"><?php echo $custom_title; ?></h1>
	</div>
	
	<div class="sidebar_content full_width">
		
		<?php
			if(!empty($post->post_content) && empty($term))
			{
		?>
			<?php echo pp_apply_content($post->post_content); ?><br/>
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
			    
			    $small_image_url = wp_get_attachment_image_src($image_id, 'gallery_3', true);
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
	
	<div class="one_third portfolio3 <?php echo $last_class; ?>">
	<div class="one_third gallery3" style="width:100%">
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
					<a href="<?php echo $permalink_url; ?>">
						<img src="<?php echo $small_image_url[0]; ?>" alt="" class=""/>
					</a>
					
					<?php
						break;
						//end external link
						
						case 'Youtube Video':
						default:
					?>
					<a title="<?php echo $portfolio_item->post_title; ?>" href="#video_<?php echo $portfolio_video_id; ?>" class="lightbox_youtube">
						<img src="<?php echo $small_image_url[0]; ?>" alt="" class=""/>
					</a>
						
					<div style="display:none;">
			    	    <div id="video_<?php echo $portfolio_video_id; ?>" style="width:900px;height:488px">
			    	        
			    	        <iframe title="YouTube video player" width="900" height="488" src="http://www.youtube.com/embed/<?php echo $portfolio_video_id; ?>?theme=dark&rel=0&wmode=transparent" frameborder="0" allowfullscreen></iframe>
			    	        
			    	    </div>	
			    	</div>
					
					<?php
						break;
						//end youtube
					
					case 'Vimeo Video':
					?>
					<a title="<?php echo $portfolio_item->post_title; ?>" href="#video_<?php echo $portfolio_video_id; ?>" class="lightbox_vimeo">
						<img src="<?php echo $small_image_url[0]; ?>" alt="" class=""/>
					</a>
						
					<div style="display:none;">
			    	    <div id="video_<?php echo $portfolio_video_id; ?>" style="width:900px;height:506px">
			    	    
			    	        <iframe src="http://player.vimeo.com/video/<?php echo $portfolio_video_id; ?>?title=0&amp;byline=0&amp;portrait=0&amp;color=ffffff" width="900" height="506" frameborder="0"></iframe>
			    	        
			    	    </div>	
			    	</div>
					
					<?php
						break;
						//end vimeo
						
					case 'Self-Hosted Video':
					
						//Get video URL
						$portfolio_mp4_url = get_post_meta($portfolio_item->ID, 'portfolio_mp4_url', true);
						$preview_image = wp_get_attachment_image_src($image_id, 'large', true);
					?>
					<a title="<?php echo $portfolio_item->post_title; ?>" href="#video_self_<?php echo $key; ?>" class="lightbox_vimeo">
						<img src="<?php echo $small_image_url[0]; ?>" alt="" class=""/>
					</a>
						
					<div style="display:none;">
			    	    <div id="video_self_<?php echo $key; ?>" style="width:900px;height:488px">
			    	    
			    	        <div id="self_hosted_vid_<?php echo $key; ?>">JW Player goes here</div>
	
							<script type="text/javascript">
								jwplayer("self_hosted_vid_<?php echo $key; ?>").setup({
									flashplayer: "<?php echo get_stylesheet_directory_uri(); ?>/js/player.swf",
									file: "<?php echo $portfolio_mp4_url; ?>",
									image: "<?php echo $preview_image[0]; ?>",
									width: 900,
									height: 488,
								});
							</script>
			    	        
			    	    </div>	
			    	</div>
					
					<?php
						break;
						//end self-hosted
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
	<div class="portfolio_desc" style="height:140px;">
	    <div class="portfolio_header">
	    	<h6 class="cufon"><?php echo $portfolio_item->post_title?></h6>
	    </div>
	    <span>
	    <?php echo pp_substr(strip_tags(strip_shortcodes($portfolio_item->post_content)),120); ?>																	
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