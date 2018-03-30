<?php
function ppb_text_func($atts, $content) {

	//extract short code attr
	extract(shortcode_atts(array(
		'size' => 'one',
		'background' => '',
		'custom_css' => '',
	), $atts));

	$return_html = '<div class="'.$size.' withsmallpadding ';
	
	if(!empty($background))
	{
		$return_html.= 'withbg';
	}
	
	$return_html.= '" ';
	
	if(!empty($custom_css))
	{
		$return_html.= 'style="'.urldecode($custom_css).' ';
	}
	
	if(!empty($background))
	{
		if(!empty($custom_css))
		{
			$return_html.= 'background-image: url('.$background.');background-attachment: fixed;background-position: center center;background-repeat: no-repeat;background-size: cover;" ';
		}
		else
		{
			$return_html.= 'style="background-image: url('.$background.');background-attachment: fixed;background-position: center center;background-repeat: no-repeat;background-size: cover;" ';
		}
		
		$return_html.= 'data-type="background" data-speed="10"';
	}
	else
	{
		$return_html.= '"';
	}
	
	$return_html.= '><div class="page_content_wrapper">'.do_shortcode(tg_apply_content($content)).'</div></div>';

	return $return_html;

}

add_shortcode('ppb_text', 'ppb_text_func');


function ppb_divider_func($atts, $content) {

	//extract short code attr
	extract(shortcode_atts(array(
		'size' => 'one'
	), $atts));

	$return_html = '<div class="divider '.$size.'">&nbsp;</div>';

	return $return_html;

}

add_shortcode('ppb_divider', 'ppb_divider_func');


function ppb_portfolio_func($atts, $content) {

	//extract short code attr
	extract(shortcode_atts(array(
		'size' => 'one',
		'title' => '',
		'items' => 4,
		'set' => '',
		'order' => 'default',
		'background' => '',
		'custom_css' => '',
	), $atts));
	
	if(!is_numeric($items))
	{
		$items = 4;
	}
	
	$return_html = '<div class="ppb_portfolio '.$size.' withpadding ';
	
	if(!empty($background))
	{
		$return_html.= 'withbg';
	}
	
	$return_html.= '" ';
	
	if(!empty($custom_css))
	{
		$return_html.= 'style="'.urldecode($custom_css).' ';
	}
	
	if(!empty($background))
	{
		if(!empty($custom_css))
		{
			$return_html.= 'background-image: url('.$background.');background-attachment: fixed;background-position: left top;background-repeat: no-repeat;background-size: cover;" ';
		}
		else
		{
			$return_html.= 'style="background-image: url('.$background.');background-attachment: fixed;background-position: left top;background-repeat: no-repeat;background-size: cover;" ';
		}
		
		$return_html.= 'data-type="background" data-speed="10"';
	}
	else
	{
		$return_html.= '"';
	}
	
	$return_html.= '>';
	
	$return_html.='<div class="page_content_wrapper" style="text-align:center">';

	//Display Title
	if(!empty($title))
	{
		$return_html.= '<h2 class="ppb_title">'.$title.'</h2>';
	}
	
	//Display Content
	if(!empty($content))
	{
		$return_html.= '<div class="page_caption_desc">'.$content.'</div>';
	}
	
	//Display Horizontal Line
	if(!empty($title) OR !empty($content))
	{
		$return_html.= '<br/><hr class="small"/><br/>';
	}
	
	$portfolio_order = 'ASC';
	$portfolio_order_by = 'menu_order';
	switch($order)
	{
		case 'default':
			$portfolio_order = 'ASC';
			$portfolio_order_by = 'menu_order';
		break;
		
		case 'newest':
			$portfolio_order = 'DESC';
			$portfolio_order_by = 'post_date';
		break;
		
		case 'oldest':
			$portfolio_order = 'ASC';
			$portfolio_order_by = 'post_date';
		break;
		
		case 'title':
			$portfolio_order = 'ASC';
			$portfolio_order_by = 'title';
		break;
		
		case 'random':
			$portfolio_order = 'ASC';
			$portfolio_order_by = 'rand';
		break;
	}
	
	//Get portfolio items
	$args = array(
	    'numberposts' => $items,
	    'order' => $portfolio_order,
	    'orderby' => $portfolio_order_by,
	    'post_type' => array('portfolios'),
	);
	
	if(!empty($set))
	{
		$args['portfoliosets'] = $set;
	}
	$portfolios_arr = get_posts($args);
	
	if(!empty($portfolios_arr) && is_array($portfolios_arr))
	{
		$return_html.= '<div id="portfolio_filter_wrapper" class="shortcode three_cols portfolio-content section content clearfix">';
	
		foreach($portfolios_arr as $key => $portfolio)
		{
			$image_url = '';
			$portfolio_ID = $portfolio->ID;
					
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
			
			$last_class = '';
			if(($key+1)%4==0)
			{
				$last_class = 'last';
			}
			
			//Begin display HTML
			$return_html.= '<div class="element portfolio4filter_wrapper">';
			$return_html.= '<div class="one_third gallery3 filterable gallery_type static fade-in animated'.($key+1).' '.$last_class.'">';
			
			if(!empty($image_url[0]))
			{
				$portfolio_type = get_post_meta($portfolio_ID, 'portfolio_type', true);
			    $portfolio_video_id = get_post_meta($portfolio_ID, 'portfolio_video_id', true);
			    
			    switch($portfolio_type)
			    {
			    case 'External Link':
					$portfolio_link_url = get_post_meta($portfolio_ID, 'portfolio_link_url', true);
			
					$return_html.= '<img src="'.$small_image_url[0].'" alt=""/>';
					
		            $return_html.= '<div class="mask">';
		            $return_html.= '<a target="_blank" href="'.$portfolio_link_url.'">
			    	    	<div class="mask_circle">
				            	<i class="fa fa-share"/></i>
					    	</div>
					    </a>
			        </div>';
			        
			    break;
			    //end external link
			    
			    case 'Portfolio Content':
        	    default:

		        	$return_html.= '<img src="'.$small_image_url[0].'" alt=""/>';
					
		            $return_html.= '<div class="mask">
		            	<a href="'.get_permalink($portfolio_ID).'">
			    	    	<div class="mask_circle">
				            	<i class="fa fa-share"/></i>
					    	</div>
					    </a>
			        </div>';
	        
			    break;
			    //end external link
			    
			    case 'Fullscreen Vimeo Video':
        	    case 'Fullscreen Youtube Video':
        	    case 'Fullscreen Self-Hosted Video':

		        	$return_html.= '<img src="'.$small_image_url[0].'" alt=""/>';
					
		            $return_html.= '<div class="mask">
		            	<a href="'.get_permalink($portfolio_ID).'">
			    	    	<div class="mask_circle">
				            	<i class="fa fa-share"/></i>
					    	</div>
					    </a>
			        </div>';
	        
        	    break;
        	    //end fullscreen video Content
        	    
        	    case 'Image':
			
					$return_html.= '<img src="'.$small_image_url[0].'" alt=""/>';
					
		            $return_html.= '<div class="mask">
		            	<a data-title="<strong>'.$portfolio->post_title.'</strong>'.$portfolio->post_content.'" href="'.$image_url[0].'" class="fancy-gallery">
				            <div class="mask_circle">
					            <i class="fa fa-share"/></i>
				            </div>
			    	    </a>
			        </div>';
			
			    break;
			    //end image
			    
			    case 'Youtube Video':
			
					$return_html.= '<img src="'.$small_image_url[0].'" alt=""/>';
					
		            $return_html.= '<div class="mask">
		            	<a title="'.$portfolio->post_title.'" href="#video_'.$portfolio_video_id.'" class="lightbox_youtube">
			    	    	<div class="mask_circle">
				            	<i class="fa fa-share"/></i>
					    	</div>
					    </a>
			        </div>
					    
					<div style="display:none;">
					    <div id="video_'.$portfolio_video_id.'" style="width:900px;height:488px">
					        
					        <iframe title="YouTube video player" width="900" height="488" src="http://www.youtube.com/embed/'.$portfolio_video_id.'?theme=dark&amp;rel=0&amp;wmode=transparent" allowfullscreen></iframe>
					        
					    </div>	
					</div>';
			
			    break;
			    //end youtube
			
			case 'Vimeo Video':

					$return_html.= '<img src="'.$small_image_url[0].'" alt=""/>';
		
		            $return_html.= '<div class="mask">
		            	<a title="'.$portfolio->post_title.'" href="#video_'.$portfolio_video_id.'" class="lightbox_vimeo">
			    	    	<div class="mask_circle">
				            	<i class="fa fa-share"/></i>
					    	</div>
					    </a>
			        </div>
					    
					<div style="display:none;">
					    <div id="video_'.$portfolio_video_id.'" style="width:900px;height:506px">
					    
					        <iframe src="http://player.vimeo.com/video/'.$portfolio_video_id.'?title=0&amp;byline=0&amp;portrait=0&amp;color=ffffff" width="900" height="506"></iframe>
					        
					    </div>	
					</div>';
			
			    break;
			    //end vimeo
			    
			case 'Self-Hosted Video':
			
			    //Get video URL
			    $portfolio_mp4_url = get_post_meta($portfolio_ID, 'portfolio_mp4_url', true);
			    $preview_image = wp_get_attachment_image_src($image_id, 'large', true);
			    
					$return_html.= '<img src="'.$small_image_url[0].'" alt=""/>';
		
					$return_html.= '<div class="mask">
					    <a title="'.$portfolio->post_title.'" href="#video_self_'.key.'" class="lightbox_vimeo">
			    	    	<div class="mask_circle">
				            	<i class="fa fa-share"/></i>
					    	</div>
					    </a>
			        </div>
					    
					<div style="display:none;">
					    <div id="video_self_'.$key.'" style="width:900px;height:488px">
					    
					        <div id="self_hosted_vid_'.$key.'"></div>
					        '.do_shortcode('[jwplayer id="self_hosted_vid_'.$key.'" file="'.$portfolio_mp4_url.'" image="'.$preview_image[0].'" width="900" height="488"]').'
					        
					    </div>	
					</div>';
			
			    break;
			    //end self-hosted
			    }
			    //end switch
			}
			$return_html.= '</div>';
			
			//Display portfolio detail
			$return_html.= '<br class="clear"/><div id="portfolio_desc_'.$portfolio_ID.'" class="portfolio_desc portfolio4 '.$last_class.'">';
            $return_html.= '<h5>'.$portfolio->post_title.'</h5>';
            $return_html.= '<span class="portfolio_excerpt">'.$portfolio->post_excerpt.'</span>';
			$return_html.= '</div>';
			
			$return_html.= '</div>';
		}
		
		$return_html.= '</div>';
	}
	
	$return_html.= '<br class="clear"/></div></div>';
	
	return $return_html;
}

add_shortcode('ppb_portfolio', 'ppb_portfolio_func');


function ppb_gallery_func($atts, $content) {

	//extract short code attr
	extract(shortcode_atts(array(
		'size' => 'one',
		'title' => '',
		'gallery' => '',
		'background' => '',
		'custom_css' => '',
	), $atts));
	
	$return_html = '<div class="'.$size.' ppb_gallery withpadding ';
	
	if(!empty($background))
	{
		$return_html.= 'withbg';
	}
	
	$return_html.= '" ';
	
	if(!empty($custom_css))
	{
		$return_html.= 'style="'.urldecode($custom_css).' ';
	}
	
	if(!empty($background))
	{
		if(!empty($custom_css))
		{
			$return_html.= 'background-image: url('.$background.');background-attachment: fixed;background-position: left top;background-repeat: no-repeat;background-size: cover;" ';
		}
		else
		{
			$return_html.= 'style="background-image: url('.$background.');background-attachment: fixed;background-position: left top;background-repeat: no-repeat;background-size: cover;" ';
		}
		
		$return_html.= 'data-type="background" data-speed="10"';
	}
	else
	{
		$return_html.= '"';
	}
	
	$return_html.= '>';
	
	$return_html.='<div class="page_content_wrapper" style="text-align:center">';

	//Display Title
	if(!empty($title))
	{
		$return_html.= '<h2 class="ppb_title">'.$title.'</h2>';
	}
	
	//Display Content
	if(!empty($content))
	{
		$return_html.= '<div class="page_caption_desc">'.$content.'</div>';
	}
	
	//Display Horizontal Line
	if(!empty($title) OR !empty($content))
	{
		$return_html.= '<br/><hr class="small"/><br/>';
	}
	
	//Get gallery images
	$all_photo_arr = get_post_meta($gallery, 'wpsimplegallery_gallery', true);
	
	//Get global gallery sorting
	$all_photo_arr = pp_resort_gallery_img($all_photo_arr);

	if(!empty($all_photo_arr) && is_array($all_photo_arr))
	{
		$return_html.= '<div id="photo_wall_wrapper" style="margin-top:30px;margin-bottom:0">';
		
		foreach($all_photo_arr as $key => $photo_id)
		{
		    $small_image_url = '';
		    $hyperlink_url = get_permalink($photo_id);
		    
		    if(!empty($photo_id))
		    {
		    	$image_url = wp_get_attachment_image_src($photo_id, 'original', true);
		        $small_image_url = wp_get_attachment_image_src($photo_id, 'gallery_3', true);
		    }
		    
		    $last_class = '';
		    if(($key+1)%4==0)
		    {
		    	$last_class = 'last';
		    }
		    
		    //Get image meta data
		    $image_title = get_the_title($photo_id);
		    $image_desc = get_post_field('post_content', $photo_id);
		    $image_caption = get_post_field('post_excerpt', $photo_id);
		    
		    $return_html.= '<div class="wall_entry static">';
			
			if(!empty($small_image_url[0]))
			{
	    		$pp_portfolio_enable_slideshow_title = get_option('pp_portfolio_enable_slideshow_title');
	    		$pp_social_sharing = get_option('pp_social_sharing');

				$return_html.= '<div class="wall_thumbnail dynamic_height gallery_type animated'.($key+1).'">';
				$return_html.= '<a ';
				if(!empty($pp_portfolio_enable_slideshow_title)) 
				{ 
					$return_html.= 'data-title="<strong>'.htmlentities($image_title).'</strong> ';
					if(!empty($image_desc)) 
					{ 
						$return_html.= htmlentities($image_desc); 
					} 
					if(!empty($pp_social_sharing)) 
					{ 
						$return_html.= htmlentities('<br/><br/><br/><br/><a class=\'button\' href=\''.get_permalink($photo_id).'\'>'.__( 'Comment & share', THEMEDOMAIN ).'</a>');
					} 
					$return_html.= '"';
				}
				
				$return_html.= 'class="fancy-gallery" data-fancybox-group="fancybox-thumb" href="'.$image_url[0].'">';
    			$return_html.= '<img src="'.$small_image_url[0].'" alt="" class=""/>
    					<div class="thumb_content">
					    	<h3>'.$image_title.'</h3>
					        <span>'.$image_caption.'</span>
					    </div>
		    		</a>
		    	</div>';
			}		
			$return_html.= '</div>';
		}
		
		$return_html.= '</div>';
	}
	
	$return_html.= '<br class="clear"/></div></div>';
	
	return $return_html;
}

add_shortcode('ppb_gallery', 'ppb_gallery_func');


function ppb_blog_func($atts, $content) {

	//extract short code attr
	extract(shortcode_atts(array(
		'size' => 'one',
		'title' => '',
		'category' => '',
		'items' => '',
		'background' => '',
		'custom_css' => '',
	), $atts));
	
	$return_html = '<div class="'.$size.' withpadding ';
	
	if(!empty($background))
	{
		$return_html.= 'withbg';
	}
	
	$return_html.= '" ';
	
	if(!empty($custom_css))
	{
		$return_html.= 'style="'.urldecode($custom_css).' ';
	}
	
	if(!empty($background))
	{
		if(!empty($custom_css))
		{
			$return_html.= 'background-image: url('.$background.');background-attachment: fixed;background-position: left top;background-repeat: no-repeat;background-size: cover;" ';
		}
		else
		{
			$return_html.= 'style="background-image: url('.$background.');background-attachment: fixed;background-position: left top;background-repeat: no-repeat;background-size: cover;" ';
		}
		
		$return_html.= 'data-type="background" data-speed="10"';
	}
	else
	{
		$return_html.= '"';
	}
	
	$return_html.= '>';
	
	$return_html.='<div class="page_content_wrapper" style="text-align:center">';
	
	if(!is_numeric($items))
	{
		$items = 3;
	}
	
	//Display Title
	if(!empty($title))
	{
		$return_html.= '<h2 class="ppb_title">'.$title.'</h2>';
	}
	
	//Display Content
	if(!empty($content))
	{
		$return_html.= '<div class="page_caption_desc">'.$content.'</div>';
	}
	
	//Display Horizontal Line
	if(!empty($title) OR !empty($content))
	{
		$return_html.= '<br/><hr class="small"/><br/>';
	}
	
	//Get blog posts
	$args = array(
	    'numberposts' => $items,
	    'order' => 'DESC',
	    'orderby' => 'post_date',
	    'post_type' => array('post'),
	);

	if(!empty($category))
	{
		$args['category'] = $category;
	}
	$posts_arr = get_posts($args);
	
	if(!empty($posts_arr) && is_array($posts_arr))
	{
		$return_html.= '<div id="blog_grid_wrapper" class="sidebar_content full_width ppb_blog_posts">';
	
		foreach($posts_arr as $key => $ppb_post)
		{
			$animate_layer = $key+7;
			$image_thumb = '';
										
			if(has_post_thumbnail($ppb_post->ID, 'large'))
			{
			    $image_id = get_post_thumbnail_id($ppb_post->ID);
			    $image_thumb = wp_get_attachment_image_src($image_id, 'large', true);
			}
			
			$return_html.= '<div id="post-'.$ppb_post->ID.'" class="post type-post hentry status-publish">
			<div class="post_wrapper grid_layout">';
	
	    	if(!empty($image_thumb))
	    	{
	    		$small_image_url = wp_get_attachment_image_src($image_id, 'blog_g', true);
	    
			    $return_html.= '<div class="post_img grid fade-in">
			    	<a href="'.get_permalink($ppb_post->ID).'">
			    		<img src="'.$small_image_url[0].'" alt="" class=""/>
			    		<div class="mask">
		                	<div class="mask_circle">
				            	<i class="fa fa-share"/></i>
							</div>
			            </div>
			    	</a>
			    </div>';
	    	}
	    
		    $return_html.= '<div style="width:100%;text-align:left">
			    <div class="post_header grid">
			    	<h6><a href="'.get_permalink($ppb_post->ID).'" title="'.get_the_title($ppb_post->ID).'">'.get_the_title($ppb_post->ID).'</a></h6>
			    </div>
				<div style="height:10px"></div>    
			';
		    
		    $return_html.= pp_substr(get_excerpt_by_id($ppb_post->ID), 90);
		    
		    $num_comments = get_comments_number($ppb_post->ID);
		    $comments = '';
		    
			if ( comments_open() ) {
				if ( $num_comments == 0 ) {
					$comments = __('0 Comment', THEMEDOMAIN);
				} elseif ( $num_comments > 1 ) {
					$comments = $num_comments . __(' Comments', THEMEDOMAIN);
				} else {
					$comments = __('1 Comment', THEMEDOMAIN);
				}
			}
		    
		    $return_html.= '<br/><br/><hr/>
		    <div class="post_detail">
		    	<a href="'.get_permalink($ppb_post->ID).'">'.$comments.'</a> / '.get_the_time(THEMEDATEFORMAT, $ppb_post->ID).'
		    </div>
	    	<a class="read_more" href="'.get_permalink($ppb_post->ID).'">'.__( 'Read More', THEMEDOMAIN ).'</a>
			<br class="clear"/><hr/>
	    </div>    
	</div>
</div>';
		}
		
		$return_html.= '</div>';
	}
	
	$return_html.= '<br class="clear"/></div></div>';
	
	return $return_html;
}

add_shortcode('ppb_blog', 'ppb_blog_func');


function ppb_service_func($atts, $content) {

	//extract short code attr
	extract(shortcode_atts(array(
		'size' => 'one',
		'title' => '',
		'items' => 3,
		'category' => '',
		'order' => 'default',
		'columns' => '3',
		'align' => 'left',
		'custom_css' => '',
	), $atts));

	if(!is_numeric($items))
	{
		$items = 4;
	}
	
	$return_html = '<div class="'.$size.' withpadding" ';
	if(!empty($custom_css))
	{
		$return_html.= 'style="'.urldecode($custom_css).'" ';
	}
	$return_html.= '>';
	
	$return_html.='<div class="page_content_wrapper" style="text-align:center">';
	
	//Display Title
	if(!empty($title))
	{
		$return_html.= '<h2 class="ppb_title">'.$title.'</h2>';
	}
	
	//Display Content
	if(!empty($content))
	{
		$return_html.= '<div class="page_caption_desc">'.$content.'</div>';
	}
	
	//Display Horizontal Line
	if(!empty($title) OR !empty($content))
	{
		$return_html.= '<br/><hr class="small"/><br/>';
	}
	
	$service_order = 'ASC';
	$service_order_by = 'menu_order';
	switch($order)
	{
		case 'default':
			$service_order = 'ASC';
			$service_order_by = 'menu_order';
		break;
		
		case 'newest':
			$service_order = 'DESC';
			$service_order_by = 'post_date';
		break;
		
		case 'oldest':
			$service_order = 'ASC';
			$service_order_by = 'post_date';
		break;
		
		case 'title':
			$service_order = 'ASC';
			$service_order_by = 'title';
		break;
		
		case 'random':
			$service_order = 'ASC';
			$service_order_by = 'rand';
		break;
	}
	
	//Get portfolio items
	$args = array(
	    'numberposts' => $items,
	    'order' => $service_order,
	    'orderby' => $service_order_by,
	    'post_type' => array('services'),
	);
	
	if(!empty($category))
	{
		$args['servicecats'] = $category;
	}
	$services_arr = get_posts($args);
	
	//Check display columns
	$count_column = 3;
	$columns_class = 'one_third';
	
	switch($columns)
	{
		case 1:
			$count_column = 1;
			$columns_class = 'one';
		break;
	
		case 2:
			$count_column = 2;
			$columns_class = 'one_half';
		break;
		
		case 3:
		default:
			$count_column = 3;
			$columns_class = 'one_third';
		break;
		
		case 4:
			$count_column = 4;
			$columns_class = 'one_fourth';
		break;
	}

	if(!empty($services_arr) && is_array($services_arr))
	{
		$return_html.= '<div class="service_content_wrapper">';
		$last_class = '';
	
		foreach($services_arr as $key => $service)
		{
			if(($key+1)%$count_column==0)
			{
				$last_class = 'last';
			}
			else
			{
				$last_class = '';
			}
			
			$return_html.= '<div class="'.$columns_class.' '.$last_class.'">';
			
			$image_url = '';
			$service_ID = $service->ID;
					
			//check if use font awesome
			$service_icon_code ='';
			$service_font_awesome = get_post_meta($service_ID, 'service_font_awesome', true);
					
			if(!empty($service_font_awesome))
			{
				$service_icon_code = get_post_meta($service_ID, 'service_font_awesome_code', true);
			}
			else
			{
				if(has_post_thumbnail($service_ID, 'large'))
				{
				    $image_id = get_post_thumbnail_id($service_ID);
				    $image_url = wp_get_attachment_image_src($image_id, 'original', true);
				    $service_icon_code = '<img src="'.$image_url[0].'" alt="" />';
				}
			}
			$return_html.= '<div class="service_wrapper '.$align.'">';
			
			if(!empty($service_icon_code))
			{
				$return_html.= '<div class="service_icon">'.$service_icon_code.'</div>';
			}
			
			$return_html.= '<div class="service_title">';
			$return_html.= '<h3>'.$service->post_title.'</h3>';
			$return_html.= '</div>';
			
			$return_html.= '<div class="service_content">'.$service->post_content.'</div>';
			
			$return_html.= '</div>';
			$return_html.= '</div>';
		}
		
		$return_html.= '</div>';
	}
	
	$return_html.= '<br class="clear"/></div></div>';
	
	return $return_html;
}

add_shortcode('ppb_service', 'ppb_service_func');


function ppb_transparent_video_bg_func($atts, $content) {

	//extract short code attr
	extract(shortcode_atts(array(
		'size' => 'one',
		'title' => '',
		'height' => '300',
		'description' => '',
		'mp4_video_url' => '',
		'webm_video_url' => '',
		'link_text' => '',
		'link_url' => '',
		'preview_img' => '',
	), $atts));
	
	if(!is_numeric($height))
	{
		$height = 300;
	}
	
	$return_html = '';
	$return_html.= '<div class="'.$size.' ppb_transparent_video_bg" style="position:relative;height:'.$height.'px;max-height:'.$height.'px;" >';
	$return_html.= '<div class="ppb_video_bg_mask"></div>';
	
	if(!empty($title))
	{
		$return_html.= '<div class="post_title entry_post">';
		
		if(!empty($title))
		{
			$return_html.= '<h3>'.$title.'</h3>';
		}
		
		if(!empty($description))
		{
			$return_html.= '<br/><hr class="small"/><div class="post_excerpt"><div class="content">'.urldecode($description).'</div></div>';
		}
		
		if(!empty($link_text))
		{
			$return_html.= '<div class="read_full"><a class="button" href="'.$link_url.'">'.urldecode($link_text).'</a></div>';
		}
		
		$return_html.= '</div>';
	}
	
	$return_html.= '<div style="position:relative;width:100%;height:100%;overflow:hidden">';
	
	if(!empty($mp4_video_url) OR !empty($webm_video_url))
	{
		//Generate unique ID
		$wrapper_id = 'ppb_video_'.uniqid();
		
		$return_html.= '<video ';
		
		if(!empty($preview_img))
		{
			$return_html.= 'poster="'.$preview_img.'"';
		}
		
		$return_html.= 'id="'.$wrapper_id.'" loop="true" autoplay="true" muted="muted" controls="controls">';
		
		if(!empty($mp4_video_url))
		{
			$return_html.= '<source type="video/mp4" src="'.$mp4_video_url.'" />';
		}
		
		if(!empty($webm_video_url))
		{
			$return_html.= '<source type="video/webm" src="'.$webm_video_url.'" />';
		}
		
		$return_html.= '</video>';
		
		wp_enqueue_script("script-ppb-video-bg".$wrapper_id, get_stylesheet_directory_uri()."/templates/script-ppb-video-bg.php?video_id=".$wrapper_id."&height=".$height, false, THEMEVERSION, true);
	}

	$return_html.= '</div>';

	$return_html.= '</div>';

	return $return_html;

}

add_shortcode('ppb_transparent_video_bg', 'ppb_transparent_video_bg_func');


function ppb_fullwidth_button_func($atts, $content) {

	//extract short code attr
	extract(shortcode_atts(array(
		'size' => 'one',
		'title' => '',
		'link_url' => '',
	), $atts));
	
	$return_html = '<div class="'.$size.'"><a href="'.$link_url.'" class="button fullwidth">'.htmlentities($title).'</a></div>';

	return $return_html;

}

add_shortcode('ppb_fullwidth_button', 'ppb_fullwidth_button_func');


function ppb_client_func($atts, $content) {

	//extract short code attr
	extract(shortcode_atts(array(
		'size' => 'one',
		'title' => '',
		'description' => '',
		'items' => 5,
		'cat' => '',
	), $atts));
	
	if(!is_numeric($items))
	{
		$items = 1;
	}

	//Get clients
	//Get portfolio items
	$args = array(
	    'numberposts' => $items,
	    'order' => 'ASC',
	    'orderby' => 'menu_order',
	    'post_type' => array('clients'),
	);
	
	if(!empty($set))
	{
		$args['clientcats'] = $category;
	}
	$clients_arr = get_posts($args);
	
	$return_html = '';

	$return_html.= '<input type="hidden" id="post_carousel_column" name="post_carousel_column" value="4"/>';
	$return_html.= '<div class="'.$size.' ppb_carousel">';

	if(!empty($clients_arr))
	{	
		//Enqueue CSS and javascript
		wp_enqueue_style("tipsy-css", get_template_directory_uri()."/css/tipsy.css", false, THEMEVERSION, "all");
		wp_enqueue_style("flexslider-css", get_template_directory_uri()."/js/flexslider/flexslider.css", false, THEMEVERSION, "all");
		wp_enqueue_script("tipsy-js", get_template_directory_uri()."/js/jquery.tipsy.js", false, THEMEVERSION, true);
		wp_enqueue_script("flexslider-js", get_template_directory_uri()."/js/flexslider/jquery.flexslider-min.js", false, THEMEVERSION, true);
		wp_enqueue_script("script-ppb-client", get_stylesheet_directory_uri()."/templates/script-ppb-client.php", false, THEMEVERSION, true);
		
		$return_html.='<div class="page_content_wrapper" style="text-align:center">';
	
		if(!empty($title))
		{
			$return_html.= '<h2 class="ppb_title">'.$title.'</h2>';
			
			if(!empty($description))
			{
				$return_html.= '<div class="ppb_desc">'.urldecode($description).'</div>';
			}
			
			//Display Horizontal Line
			if(!empty($title) OR !empty($content))
			{
				$return_html.= '<br/><hr class="small"/><br/>';
			}
		}
		
		$return_html.= '<div class="flexslider post_carousel post_fullwidth post_type_gallery"><ul class="slides">';
		
		foreach($clients_arr as $key => $client)
		{
			$return_html.= '<li>';
			
			if(has_post_thumbnail($client->ID, 'original'))
			{
			    $image_id = get_post_thumbnail_id($client->ID);
			    $image_url = wp_get_attachment_image_src($image_id, 'original', true);
			}
			
			if(isset($image_url[0]) && !empty($image_url[0]))
	    	{
	    		$return_html.= '<div class="carousel_img">';
	    		
	    		$client_website_url = get_post_meta($client->ID, 'client_website_url', true);
	    		if(empty($client_website_url))
	    		{
		    		$client_website_url = '#';
	    		}
	    		
	    	    $return_html.= '<a href="'.$client_website_url.'" ';
	    	    if(!empty($client->post_content))
	    	    {
		    	    $return_html.= 'class="client_content" title="'.$client->post_content.'"';
	    	    }
	    	    $return_html.= '><img class="client_logo" src="'.$image_url[0].'" alt=""/></a>';
	    	    $return_html.= '</div>';
	    	}
			
			$return_html.= '</li>';
		}
		
		$return_html.= '</ul></div></div>';
	}
	else
	{
		$return_html.= 'Empty client Please make sure you have created it.';
	}

	$return_html.= '</div>';

	return $return_html;

}

add_shortcode('ppb_client', 'ppb_client_func');


function ppb_team_func($atts, $content) {

	//extract short code attr
	extract(shortcode_atts(array(
		'size' => 'one',
		'columns' => 3,
		'title' => '',
		'items' => 4,
		'cat' => '',
		'order' => 'default',
		'background' => '',
		'custom_css' => '',
	), $atts));
	
	if(!is_numeric($items))
	{
		$items = 4;
	}
	
	$return_html = '<div class="'.$size.' withpadding ';
	
	if(!empty($background))
	{
		$return_html.= 'withbg';
	}
	
	$return_html.= '" ';
	
	if(!empty($custom_css))
	{
		$return_html.= 'style="'.urldecode($custom_css).' ';
	}
	
	if(!empty($background))
	{
		if(!empty($custom_css))
		{
			$return_html.= 'background-image: url('.$background.');background-attachment: fixed;background-position: left top;background-repeat: no-repeat;background-size: cover;" ';
		}
		else
		{
			$return_html.= 'style="background-image: url('.$background.');background-attachment: fixed;background-position: left top;background-repeat: no-repeat;background-size: cover;" ';
		}
		
		$return_html.= 'data-type="background" data-speed="10"';
	}
	else
	{
		$return_html.= '"';
	}
	
	$return_html.= '>';
	
	$return_html.='<div class="page_content_wrapper" style="text-align:center">';
	
	//Display Title
	if(!empty($title))
	{
		$return_html.= '<h2 class="ppb_title">'.stripcslashes($title).'</h2>';
	}
	
	//Display Content
	if(!empty($content))
	{
		$return_html.= '<div class="page_caption_desc">'.$content.'</div>';
	}
	
	//Display Horizontal Line
	if(!empty($title) OR !empty($content))
	{
		$return_html.= '<br/><hr class="small"/><br/><br/>';
	}
	
	$portfolio_order = 'ASC';
	$portfolio_order_by = 'menu_order';
	switch($order)
	{
		case 'default':
			$portfolio_order = 'ASC';
			$portfolio_order_by = 'menu_order';
		break;
		
		case 'newest':
			$portfolio_order = 'DESC';
			$portfolio_order_by = 'post_date';
		break;
		
		case 'oldest':
			$portfolio_order = 'ASC';
			$portfolio_order_by = 'post_date';
		break;
		
		case 'title':
			$portfolio_order = 'ASC';
			$portfolio_order_by = 'title';
		break;
		
		case 'random':
			$portfolio_order = 'ASC';
			$portfolio_order_by = 'rand';
		break;
	}
	
	//Check display columns
	$count_column = 3;
	$columns_class = 'one_third';
	
	switch($columns)
	{	
		case 2:
			$count_column = 2;
			$columns_class = 'one_half';
		break;
		
		case 3:
		default:
			$count_column = 3;
			$columns_class = 'one_third';
		break;
		
		case 4:
			$count_column = 4;
			$columns_class = 'one_fourth';
		break;
	}
	
	//Get portfolio items
	$args = array(
	    'numberposts' => $items,
	    'order' => $portfolio_order,
	    'orderby' => $portfolio_order_by,
	    'post_type' => array('team'),
	);
	
	if(!empty($cat))
	{
		$args['teamcats'] = $cat;
	}
	$team_arr = get_posts($args);
	
	if(!empty($team_arr) && is_array($team_arr))
	{
		$return_html.= '<div class="team_wrapper">';
	
		foreach($team_arr as $key => $member)
		{
			$image_url = '';
			$member_ID = $member->ID;
					
			if(has_post_thumbnail($member_ID, 'team_member'))
			{
			    $image_id = get_post_thumbnail_id($member_ID);
			    $small_image_url = wp_get_attachment_image_src($image_id, 'team_member', true);
			}
			
			$last_class = '';
			if(($key+1)%$count_column==0)
			{
				$last_class = 'last';
			}
			
			//Begin display HTML
			$return_html.= '<div class="'.$columns_class.' animated'.($key+1).' '.$last_class.'">';
			
			if(!empty($small_image_url[0]))
			{
				$return_html.= '<div class="post_img animate ';
				
				$member_facebook = get_post_meta($member_ID, 'member_facebook', true);
			    $member_twitter = get_post_meta($member_ID, 'member_twitter', true);
			    $member_google = get_post_meta($member_ID, 'member_google', true);
			    $member_linkedin = get_post_meta($member_ID, 'member_linkedin', true);
				
				if(empty($member_facebook) && empty($member_twitter) && empty($member_google) && empty($member_linkedin))
				{
					$return_html.= 'static';
				}
				
				$return_html.='" style="margin-bottom:10px"><img class="team_pic" src="'.$small_image_url[0].'" alt=""/>';
				
				if(!empty($member_facebook) OR !empty($member_twitter) OR !empty($member_google) OR !empty($member_linkedin))
				{
					$return_html.= '<div class="thumb_content">';
					$return_html.= '<div class="social_follow">'.__( 'Follow', THEMEDOMAIN ).'</div><ul class="social_wrapper team">';
					
					if(!empty($member_twitter))
					{
					    $return_html.= '<li><a title="Twitter" target="_blank" class="tipsy" href="http://twitter.com/'.$member_twitter.'"><img src="'. get_stylesheet_directory_uri().'/images/social/twitter.png" alt=""/></a></li>';
					}
	 
					if(!empty($member_facebook))
					{
					    $return_html.= '<li><a title="Facebook" target="_blank" class="tipsy" href="http://facebook.com/'.$member_facebook.'"><img src="'. get_stylesheet_directory_uri().'/images/social/facebook.png" alt=""/></a></li>';
					}
					
					if(!empty($member_google))
					{
					    $return_html.= '<li><a title="Google+" target="_blank" class="tipsy" href="'.$member_google.'"><img src="'.get_stylesheet_directory_uri().'/images/social/google.png" alt=""/></a></li>';
					}
					    
					if(!empty($member_linkedin))
					{
					    $return_html.= '<li><a title="Linkedin" target="_blank" class="tipsy" href="'.$member_linkedin.'"><img src="'. get_stylesheet_directory_uri().'/images/social/linkedin.png" alt=""/></a></li>';
					}
					
					$return_html.= '</ul>';
					$return_html.= '</div>';
				}
				
				$return_html.= '</div>';
			    
			}
			
			$team_position = get_post_meta($member_ID, 'team_position', true);
			
			//Display portfolio detail
			$return_html.= '<br class="clear"/><div id="portfolio_desc_'.$member_ID.'" class="portfolio_desc portfolio3 '.$last_class.'">';
            $return_html.= '<h5>'.$member->post_title.'</h5>';
            if(!empty($team_position))
            {
            	$return_html.= '<span class="portfolio_excerpt">'.$team_position.'</span>';
            }
            if(!empty($member->post_content))
            {
            	$return_html.= '<p>'.$member->post_content.'</p>';
            }
			$return_html.= '</div>';
			$return_html.= '</div>';
			
			if(($key+1)%$count_column==0)
			{
				$return_html.= '<br class="clear"/>';
			}
		}
		
		$return_html.= '</div>';
	}
	
	$return_html.= '</div></div>';
	
	return $return_html;
}

add_shortcode('ppb_team', 'ppb_team_func');


function ppb_promo_box_func($atts, $content) {

	//extract short code attr
	extract(shortcode_atts(array(
		'title' => '',
		'button_text' => '',
		'button_url' => '',
	), $atts));
	
	$return_html ='<div class="page_content_wrapper">';
	$return_html.= do_shortcode('[tg_promo_box title="'.$title.'" shadow="1" button_text="'.urldecode($button_text).'" button_url="'.$button_url.'"]'.$content.'[/tg_promo_box]');
	$return_html.='</div><br class="clear"/>';
	
	return $return_html;
}

add_shortcode('ppb_promo_box', 'ppb_promo_box_func');
?>