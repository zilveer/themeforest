<?php
/**
 * Template Name: Portfolio Classic 3 Columns
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

get_header();
?>
<br class="clear"/>

<?php
    //Get Page LayerSlider
    $page_layerslider = get_post_meta($current_page_id, 'page_layerslider', true);
    
    if($page_layerslider > 0)
    {
    	echo '<div class="page_layerslider">'.do_shortcode('[layerslider id="'.$page_layerslider.'"]').'</div>';
    }
?>

<?php
//Get page header display setting
$page_hide_header = get_post_meta($current_page_id, 'page_hide_header', true);

if(empty($page_hide_header))
{
?>
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
<input type="hidden" id="pp_portfolio_columns" name="pp_portfolio_columns" value="3"/>
<div id="page_caption">
	<div class="page_title_wrapper">
		<h1><?php echo $custom_title; ?></h1>
		<?php echo dimox_breadcrumbs(); ?>
	</div>
</div>
<br class="clear"/>
<?php
}
else
{
?>
<br class="clear"/>
<?php
}
?>

<!-- Begin content -->
<?php
	//Get number of portfolios per page
	$pp_portfolio_items_page = get_option('pp_portfolio_items_page');
	if(empty($pp_portfolio_items_page))
	{
		$pp_portfolio_items_page = 9;
	}
	
	//Get all portfolio items for paging
	global $wp_query;
	$paged = (get_query_var('paged')) ? get_query_var('paged') : 1;
	
	$query_string = 'paged='.$paged.'&orderby=menu_order&order=ASC&post_type=portfolios&numberposts=-1&suppress_filters=0&posts_per_page='.$pp_portfolio_items_page;
	if(!empty($term))
	{
	    $query_string .= '&posts_per_page=-1&portfoliosets='.$term;
	}
	else
	{
		$query_string .= '&posts_per_page='.$pp_portfolio_items_page;
	}
	query_posts($query_string);
?>
<div id="page_content_wrapper">
    
<div class="inner">

	<div class="inner_wrapper">
	
	<?php
	    if(!empty($post->post_content) && empty($term))
	    {
	?>
	    <?php echo tg_apply_content($post->post_content); ?>
	<?php
	    }
	    elseif(!empty($term))
	    { 
	?>
	    <?php echo tg_apply_content($obj_term->description); ?>
	<?php
	    }
	?>
	
	<div id="page_main_content" class="sidebar_content full_width">
	
	<div id="portfolio_filter_wrapper" class="three_cols gallery portfolio-content section content clearfix">
	
	<?php
		$key = 0;
		if (have_posts()) : while (have_posts()) : the_post();
			$key++;
			$image_url = '';
			$portfolio_ID = get_the_ID();
					
			if(has_post_thumbnail($portfolio_ID, 'large'))
			{
			    $image_id = get_post_thumbnail_id($portfolio_ID);
			    $image_url = wp_get_attachment_image_src($image_id, 'full', true);
			    
			    $small_image_url = wp_get_attachment_image_src($image_id, 'gallery_3', true);
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
	?>
	<div class="element classic3_cols">
	
		<div class="one_third gallery3 filterable gallery_type static animated<?php echo $key+1; ?>" data-id="post-<?php echo $key+1; ?>">
		<?php 
				if(!empty($image_url[0]))
				{
			?>		
				<?php
						$portfolio_type = get_post_meta($portfolio_ID, 'portfolio_type', true);
						$portfolio_video_id = get_post_meta($portfolio_ID, 'portfolio_video_id', true);
						
						switch($portfolio_type)
						{
						case 'External Link':
							$portfolio_link_url = get_post_meta($portfolio_ID, 'portfolio_link_url', true);
					?>
					<a target="_blank" href="<?php echo $portfolio_link_url; ?>">
						<img src="<?php echo $small_image_url[0]; ?>" alt=""/>
						
						<div class="mask">
	                    	<div class="mask_circle">
			                    <i class="fa fa-share"/></i>
							</div>
		                </div>
		            </a>
					
					<?php
						break;
						//end external link
						
						case 'Portfolio Content':
        				default:
        			?>
        			<a href="<?php echo get_permalink($portfolio_ID); ?>">
        				<img src="<?php echo $small_image_url[0]; ?>" alt="" />
						
						<div class="mask">
	                    	<div class="mask_circle">
			                    <i class="fa fa-share"/></i>
							</div>
		                </div>
		            </a>
	                
	                <?php
						break;
						//end external link
						
						case 'Fullscreen Vimeo Video':
        				case 'Fullscreen Youtube Video':
        				case 'Fullscreen Self-Hosted Video':
        			?>
        			<a href="<?php echo get_permalink($portfolio_ID); ?>">
        				<img src="<?php echo $small_image_url[0]; ?>" alt="" />
        			
						<div class="mask">
	                    	<div class="mask_circle">
			                    <i class="fa fa-share"/></i>
							</div>
		                </div>
	                </a>
        			
        			<?php
        				break;
        				//end fullscreen video Content
        				
        				case 'Image':
					?>
					<a data-title="<strong><?php echo get_the_title(); ?></strong><?php echo remove_shortcode(get_the_content()); ?>" href="<?php echo $image_url[0]; ?>" class="fancy-gallery">
						<img src="<?php echo $small_image_url[0]; ?>" alt="" />
					
	                    <div class="mask">
	                    	<div class="mask_circle">
			                    <i class="fa fa-share"/></i>
							</div>
		                </div>
	                </a>
					
					<?php
						break;
						//end image
						
						case 'Youtube Video':
					?>
					
					<a title="<?php echo get_the_title(); ?>" href="#video_<?php echo $portfolio_video_id; ?>" class="lightbox_youtube">
						<img src="<?php echo $small_image_url[0]; ?>" alt="" />
						
						<div class="mask">
	                    	<div class="mask_circle">
			                    <i class="fa fa-share"/></i>
							</div>
		                </div>
		            </a>
						
					<div style="display:none;">
			    	    <div id="video_<?php echo $portfolio_video_id; ?>" style="width:900px;height:488px" class="video-container">
			    	        
			    	        <iframe title="YouTube video player" width="900" height="488" src="http://www.youtube.com/embed/<?php echo $portfolio_video_id; ?>?theme=dark&amp;rel=0&amp;wmode=transparent" allowfullscreen></iframe>
			    	        
			    	    </div>	
			    	</div>
					
					<?php
						break;
						//end youtube
					
					case 'Vimeo Video':
					?>
					<a title="<?php echo get_the_title(); ?>" href="#video_<?php echo $portfolio_video_id; ?>" class="lightbox_vimeo">
						<img src="<?php echo $small_image_url[0]; ?>" alt="" />
					
						<div class="mask">
	                    	<div class="mask_circle">
			                    <i class="fa fa-share"/></i>
							</div>
		                </div>
		            </a>
						
					<div style="display:none;">
			    	    <div id="video_<?php echo $portfolio_video_id; ?>" style="width:900px;height:506px" class="video-container">
			    	    
			    	        <iframe src="http://player.vimeo.com/video/<?php echo $portfolio_video_id; ?>?title=0&amp;byline=0&amp;portrait=0&amp;color=ffffff" width="900" height="506"></iframe>
			    	        
			    	    </div>	
			    	</div>
					
					<?php
						break;
						//end vimeo
						
					case 'Self-Hosted Video':
					
						//Get video URL
						$portfolio_mp4_url = get_post_meta($portfolio_ID, 'portfolio_mp4_url', true);
						$preview_image = wp_get_attachment_image_src($image_id, 'large', true);
					?>
					<a title="<?php echo get_the_title(); ?>" href="#video_self_<?php echo $key; ?>" class="lightbox_vimeo">
						<img src="<?php echo $small_image_url[0]; ?>" alt="" />
						
						<div class="mask">
	                    	<div class="mask_circle">
			                    <i class="fa fa-share"/></i>
							</div>
		                </div>
		            </a>
						
					<div style="display:none;">
			    	    <div id="video_self_<?php echo $key; ?>" style="width:900px;height:488px" class="video-container">
			    	    
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
	
		<br class="clear"/>
		<div id="portfolio_desc_<?php echo $portfolio_ID; ?>" class="portfolio_desc portfolio3 filterable">
            <h5><?php echo get_the_title(); ?></h5>
            <p><?php echo pp_substr(strip_tags(pp_strip_shortcodes(get_the_content())), 110); ?></p>
        </div>
	</div>
	<?php
		endwhile; endif;
	?>
	</div>
	
	<?php
	    if($wp_query->max_num_pages > 1)
	    {
	    	if (function_exists("wpapi_pagination")) 
	    	{
	?>
			<br class="clear"/><br/><br/>
	<?php
	    	    wpapi_pagination($wp_query->max_num_pages);
	    	}
	    	else
	    	{
	    	?>
	    	    <div class="pagination"><p><?php posts_nav_link(' '); ?></p></div>
	    	<?php
	    	}
	    ?>
	    <div class="pagination_detail">
	     	<?php
	     		$paged = (get_query_var('paged')) ? get_query_var('paged') : 1;
	     	?>
	     	<?php _e( 'Page', THEMEDOMAIN ); ?> <?php echo $paged; ?> <?php _e( 'of', THEMEDOMAIN ); ?> <?php echo $wp_query->max_num_pages; ?>
	     </div>
	     <?php
	     }
	?>
	
	</div>

</div>
</div>
<br class="clear"/><br/><br/>

<?php get_footer(); ?>