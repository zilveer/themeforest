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

/*
    Check if portfolio item has featured gallery
*/
if(!empty($portfolio_gallery_id) && $portfolio_gallery_id > 0)
{
    //Run flow gallery data
    wp_enqueue_script("script-flow-gallery", get_template_directory_uri()."/templates/script-flow-gallery.php?gallery_id=".$portfolio_gallery_id."&location=portfolio", false, THEMEVERSION, true);
?>
<div class="single_portfolio_gallery">
	<i class="fa fa-spinner fa-spin"></i>
    <div id="imageFlow" class="single_portfolio">
    	<div class="text">
    		<div class="title"></div>
    		<div class="legend"></div>
    	</div>
    </div>
    
    <input type="hidden" id="pp_image_path" name="pp_image_path" value="<?php echo get_template_directory_uri(); ?>/images/"/>
    <?php
    	$pp_enable_reflection = get_option('pp_enable_reflection');
    ?>
    <input type="hidden" id="pp_enable_reflection" name="pp_enable_reflection" value="<?php echo $pp_enable_reflection; ?>"/>
</div>	

<?php
}
?>

<div id="page_content_wrapper">
    
    <div class="inner">

    	<!-- Begin main content -->
    	<div class="inner_wrapper">

	    	<div class="sidebar_content full_width">

	    		<?php
	    		
	    		if(empty($portfolio_gallery_id))
	    		{
	    			//Get Portfolio content type
	    			$portfolio_type = get_post_meta($post->ID, 'portfolio_type', true);
	    			
	    			switch($portfolio_type)
	    			{
						case 'Image':
						case 'Portfolio Content':
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
		    	?>
		    	<div class="post_excerpt_full">
		    	<?php
		    		//Get Social Share
					get_template_part("/templates/template-share");
				?>
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
				<hr/><br class="clear"/><br/>
		    	
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
		    </div>
    	</div>
    
    </div>
    <!-- End main content -->
   
</div> 
<br class="clear"/><br/>
<?php
	//Check if display comment
	$pp_portfolio_comment = get_option('pp_portfolio_comment');
	
	if(!empty($pp_portfolio_comment))
	{
?>
<div class="fullwidth_comment_wrapper portfolio_comment">
	<?php comments_template( '' ); ?><br class="clear"/>
</div>
<?php
	}
?>
<br/>
<?php get_footer(); ?>