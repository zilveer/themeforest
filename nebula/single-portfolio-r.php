<?php
/**
 * The main template file for display single post portfolio.
 *
 * @package WordPress
*/

get_header(); 
?>

<br class="clear"/>
<div id="page_caption">
	<div class="page_title_wrapper">
    	<h1><?php the_title() ?></h1>
		<?php echo dimox_breadcrumbs(); ?>
	</div>
</div>
<br class="clear"/>

<?php
/**
*	Get current page id
**/

$current_page_id = $post->ID;
$portfolio_gallery_id = get_post_meta($current_page_id, 'portfolio_gallery_id', true);

//Get page sidebar
$portfolio_sidebar = get_post_meta($current_page_id, 'portfolio_sidebar', true);

//If not select sidebar then select default one
if(empty($portfolio_sidebar))
{
	$portfolio_sidebar = 'Page Sidebar';
}

?>

<div id="page_content_wrapper">
    
    <div class="inner">

    	<!-- Begin main content -->
    	<div class="inner_wrapper">

	    	<div class="sidebar_content">
	    	
	    		<?php
	    		/*
				    Check if portfolio item has featured gallery
				*/
				if(!empty($portfolio_gallery_id) && $portfolio_gallery_id > 0)
				{
				?>
					<div id="photo_wall_wrapper" class="has_sidebar">
				<?php
					//Get gallery images
					$all_photo_arr = get_post_meta($portfolio_gallery_id, 'wpsimplegallery_gallery', true);
					
					//Get global gallery sorting
					$all_photo_arr = pp_resort_gallery_img($all_photo_arr);
					
					$key = 0;
					foreach($all_photo_arr as $photo_id)
					{
						$key++;
						$small_image_url = '';
		    			
		    			if(!empty($photo_id))
		    			{
		    				$image_url = wp_get_attachment_image_src($photo_id, 'original', true);
		    			    $small_image_url = wp_get_attachment_image_src($photo_id, 'gallery_3', true);
		    			}
		    			
		    			//Get image meta data
					    $image_title = get_the_title($photo_id);
					    $image_caption = get_post_field('post_excerpt', $photo_id);
					    $image_desc = get_post_field('post_content', $photo_id);
				?>
				
					<div class="wall_entry three_cols">
				    <?php 
				    	if(!empty($small_image_url[0]))
				    	{
				    		$pp_portfolio_enable_slideshow_title = get_option('pp_portfolio_enable_slideshow_title');
				    		$pp_social_sharing = get_option('pp_social_sharing');
				    ?>		
				    	<div class="wall_thumbnail dynamic_height gallery_type animated<?php echo $key+1; ?>">
				    		<a <?php if(!empty($pp_portfolio_enable_slideshow_title)) { ?>data-title="<strong><?php echo $image_title; ?></strong> <?php if(!empty($image_desc)) { ?><?php echo htmlentities($image_desc); ?><?php } ?><?php if(!empty($pp_social_sharing)) { ?><br/><br/><br/><br/><a class='button' href='<?php echo get_permalink($photo_id); ?>'><?php _e( 'Comment & share', THEMEDOMAIN ); ?></a><?php } ?>"<?php } ?> class="fancy-gallery" data-fancybox-group="fancybox-thumb" href="<?php echo $image_url[0]; ?>">
				    			<img src="<?php echo $small_image_url[0]; ?>" alt="" class=""/>
				    			<div class="thumb_content">
					                <h4><?php echo $image_title; ?></h4>
					            </div>
				    		</a>
				    	</div>
				    <?php
				    	}		
				    ?>
				
				</div>
				
				<?php
					}
				?>
					</div><br class="clear"/><br/>
				<?php
				}
				?>

	    		<?php
	    		if(empty($portfolio_gallery_id))
	    		{
	    			//Get Portfolio content type
	    			$portfolio_type = get_post_meta($post->ID, 'portfolio_type', true);
	    			switch($portfolio_type)
	    			{
						case 'Image':
						default:
						
		    			$image_thumb = '';
									
						if(has_post_thumbnail(get_the_ID(), 'large'))
						{
						    $image_id = get_post_thumbnail_id($post->ID);
						    $image_thumb = wp_get_attachment_image_src($image_id, 'large', true);
						    $image_desc = get_post_field('post_content', $image_id);
						}
		    		?>
		    		
		    		<?php
				    	if(!empty($image_thumb))
				    	{
				    ?>
				    
				    <div class="post_img">
				    	<img src="<?php echo $image_thumb[0]; ?>" alt="" class=""/>
				    </div>
				    <br class="clear"/><br/>
				    
				    <?php
				    	}
			    	break;
			    	
			    	case 'Youtube Video':
			    		$portfolio_video_id = get_post_meta($post->ID, 'portfolio_video_id', true);
			    ?>
			    
			    	<div style="text-align:center">
				    	<iframe width="1170" height="658" src="//www.youtube.com/embed/<?php echo $portfolio_video_id; ?>?rel=0" frameborder="0" allowfullscreen></iframe><br/><br/>
				    </div>
			    
			    <?php
			    	break;
			    	
			    	case 'Vimeo Video':
			    		$portfolio_video_id = get_post_meta($post->ID, 'portfolio_video_id', true);
			    ?>
			    
			    	<div style="text-align:center">
				    	<iframe src="//player.vimeo.com/video/<?php echo $portfolio_video_id; ?>?title=0&amp;byline=0&amp;portrait=0" width="1170" height="658" frameborder="0" webkitallowfullscreen mozallowfullscreen allowfullscreen></iframe><br/><br/>
				    </div>
			    <?php
			    	break;
			    	
					} //End switch
				}
			    ?>
	    	
	    		<?php
					if (have_posts())
					{ 
						while (have_posts()) : the_post();
		
						the_content();
		    		    
		    		    endwhile; 
		    		}

		    		//Get Social Share
					get_template_part("/templates/template-share");
				?>

		    </div>
    	</div>
    	
    	<div class="sidebar_wrapper">
    		
    	    <div class="sidebar_top"></div>
    	
    	    <div class="sidebar">
    	    
    	    	<div class="content">
    	    
    	    		<ul class="sidebar_widget">
    	    		<?php dynamic_sidebar($portfolio_sidebar); ?>
    	    		</ul>
    	    	
    	    	</div>
    	
    	    </div>
    	    <br class="clear"/>
    	
    	    <div class="sidebar_bottom"></div>
    	</div>
    	
    	<?php
		    //Check if display recent portfolio items
		    $pp_portfolio_single_recent = get_option('pp_portfolio_single_recent');
		    $pp_portfolio_recent_items = get_option('pp_portfolio_recent_items');
		    
		    if(!empty($pp_portfolio_single_recent))
		    {
		    	//Get recent portfolio items
		    	$args = array(
		    	    'numberposts' => $pp_portfolio_recent_items,
		    	    'order' => 'ASC',
		    	    'orderby' => 'menu_order',
		    	    'post_type' => array('portfolios'),
		    	    'portfoliosets' => '',
		    	);
		    	
		    	$all_photo_arr = get_posts($args);
		    ?>
		    <br class="clear"/><hr/><br class="clear"/><br/>
		    
		    <h5><?php _e( 'Most Recent Portfolios', THEMEDOMAIN ); ?></h5><br/><br/>
		    
		    <div id="page_main_content" class="sidebar_content full_width transparentbg">
	
		    <div id="portfolio_filter_wrapper" class="four_cols portfolio-content section content clearfix">
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
		    		if(($key+1)%4==0)
		    		{
		    			$last_class = 'last';
		    		}
		    ?>
		    <div class="element portfolio4filter_wrapper">
	
		    	<div class="one_fourth gallery4 filterable portfolio_type animated<?php echo $key+1; ?>">
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
		    					$portfolio_link_url = get_post_meta($portfolio_item->ID, 'portfolio_link_url', true);
		    			?>
		    			<a target="_blank" href="<?php echo $portfolio_link_url; ?>">
		    				<img src="<?php echo $small_image_url[0]; ?>" alt=""/>
		
			                <div class="thumb_content">
			    			    <h3><?php echo $portfolio_item->post_title; ?></h3>
			    			</div>
			    		</a>
		    			
		    			<?php
		    				break;
		    				//end external link
		    				
		    				case 'Portfolio Content':
		    				default:
		    			?>
		    			<a href="<?php echo get_permalink($portfolio_item->ID); ?>">
		    				<img src="<?php echo $small_image_url[0]; ?>" alt="" />
		    			
			                <div class="thumb_content">
			    			    <h3><?php echo $portfolio_item->post_title; ?></h3>
			    			</div>
		                </a>
		                
		                <?php
		    				break;
		    				//end external link
		    				
		    				case 'Fullscreen Vimeo Video':
		    				case 'Fullscreen Youtube Video':
		    				case 'Fullscreen Self-Hosted Video':
		    			?>
		    			<a href="<?php echo get_permalink($portfolio_item->ID); ?>">
		    				<img src="<?php echo $small_image_url[0]; ?>" alt="" />
		    			
			                <div class="thumb_content">
			    			    <h3><?php echo $portfolio_item->post_title; ?></h3>
			    			</div>
		                </a>
		    			
		    			<?php
		    				break;
		    				//end fullscreen video Content
		    				
		    				case 'Image':
		    			?>
		    			<a data-title="<strong><?php echo $portfolio_item->post_title; ?></strong><?php echo $portfolio_item->post_content; ?>" href="<?php echo $image_url[0]; ?>" class="fancy-gallery">
		    				<img src="<?php echo $small_image_url[0]; ?>" alt="" />
		    			
			                <div class="thumb_content">
			    			    <h3><?php echo $portfolio_item->post_title; ?></h3>
			    			</div>
			    		</a>
		    			
		    			<?php
		    				break;
		    				//end image
		    				
		    				case 'Youtube Video':
		    			?>
		    			
		    			<a title="<?php echo $portfolio_item->post_title; ?>" href="#video_<?php echo $portfolio_video_id; ?>" class="lightbox_youtube">
		    				<img src="<?php echo $small_image_url[0]; ?>" alt="" />
		    			
			                <div class="thumb_content">
			    			    <h3><?php echo $portfolio_item->post_title; ?></h3>
			    			</div>
		    			</a>
		    				
		    			<div style="display:none;">
		    	    	    <div id="video_<?php echo $portfolio_video_id; ?>" style="width:900px;height:488px">
		    	    	        
		    	    	        <iframe title="YouTube video player" width="900" height="488" src="http://www.youtube.com/embed/<?php echo $portfolio_video_id; ?>?theme=dark&amp;rel=0&amp;wmode=transparent" allowfullscreen></iframe>
		    	    	        
		    	    	    </div>	
		    	    	</div>
		    			
		    			<?php
		    				break;
		    				//end youtube
		    			
		    			case 'Vimeo Video':
		    			?>
		    			<a title="<?php echo $portfolio_item->post_title; ?>" href="#video_<?php echo $portfolio_video_id; ?>" class="lightbox_vimeo">
		    				<img src="<?php echo $small_image_url[0]; ?>" alt="" />
		
			                <div class="thumb_content">
			    			    <h3><?php echo $portfolio_item->post_title; ?></h3>
			    			</div>
			    		</a>
		    				
		    			<div style="display:none;">
		    	    	    <div id="video_<?php echo $portfolio_video_id; ?>" style="width:900px;height:506px">
		    	    	    
		    	    	        <iframe src="http://player.vimeo.com/video/<?php echo $portfolio_video_id; ?>?title=0&amp;byline=0&amp;portrait=0&amp;color=ffffff" width="900" height="506"></iframe>
		    	    	        
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
		    				<img src="<?php echo $small_image_url[0]; ?>" alt="" />
		
			    			<div class="thumb_content">
			    			    <h3><?php echo $portfolio_item->post_title; ?></h3>
			    			</div>
			    		</a>
		    				
		    			<div style="display:none;">
		    	    	    <div id="video_self_<?php echo $key; ?>" style="width:900px;height:488px">
		    	    	    
		    	    	        <div id="self_hosted_vid_<?php echo $key; ?>"></div>
		    	    	        <?php do_shortcode('[jwplayer id="self_hosted_vid_'.$key.'" file="'.$portfolio_mp4_url.'" image="'.$preview_image[0].'" width="900" height="488"]'); ?>
		    	    	        
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
		    	
		    </div>
		    <?php
		    	}
		    ?>
		</div>
		<?php
		}
		?>
		
		<?php
			//Check if display comment
			$pp_portfolio_comment = get_option('pp_portfolio_comment');
			
			if(!empty($pp_portfolio_comment))
			{
		?>
			<br class="clear"/><br/><?php comments_template( '' ); ?>
		<?php
			}
		?>
    
    </div>
    <!-- End main content -->
   
</div> 
<br class="clear"/><br/><br/>
<?php get_footer(); ?>