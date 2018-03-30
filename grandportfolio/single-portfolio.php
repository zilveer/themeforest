<?php
/**
 * The main template file for display single post portfolio.
 *
 * @package WordPress
*/

if(isset($post->ID))
{
    $current_page_id = $post->ID;
}

get_header(); 

//Include custom header feature
get_template_part("/templates/template-portfolio-header");
?>

<?php
	//Check if use page builder
	$ppb_form_data_order = '';
	$ppb_form_item_arr = array();
	$ppb_enable = get_post_meta($current_page_id, 'ppb_enable', true);
?>

<?php
	if(!empty($ppb_enable))
	{
		//if dont have password set
		if(!post_password_required())
		{
?>
<div class="ppb_wrapper <?php if(!empty($pp_page_bg)) { ?>hasbg<?php } ?> <?php if(!empty($pp_page_bg) && !empty($global_pp_topbar)) { ?>withtopbar<?php } ?>">
<?php
	grandportfolio_apply_builder($current_page_id, 'portfolios');
?>
</div>
<?php
		} //end if dont have password set
		else
		{
?>
<div id="page_content_wrapper" class="<?php if(!empty($pp_page_bg)) { ?>hasbg<?php } ?> <?php if(!empty($pp_page_bg) && !empty($global_pp_topbar)) { ?>withtopbar<?php } ?>">
    <div class="inner">
    	<!-- Begin main content -->
    	<div class="inner_wrapper">
    		<div class="sidebar_content full_width">
<?php
			the_content();
?>
    		<br/><br/></div>
    	</div>
    </div>
</div>
<?php
		}
	}
	else
	{
?>
    
    <div class="inner">

    	<!-- Begin main content -->
    	<div class="inner_wrapper">

	    	<div class="sidebar_content full_width">
	    	
	    		<?php
					if (have_posts())
					{ 
						while (have_posts()) : the_post();
		
						the_content();
		    		    
		    		    endwhile; 
		    		}
		    	?>
		    </div>
		    
    	</div>
    
    </div>
    <!-- End main content -->
   
</div> 
		    	
<?php
} // End if not using content builder
?>

<?php
//Check if displays recent portfolio
$tg_portfolio_recent = kirki_get_option('tg_portfolio_recent');

if(!empty($tg_portfolio_recent))
{
	$args = array(
        'numberposts' => 4,
        'order' => 'DESC',
        'orderby' => 'date',
        'post_type' => array('portfolios'),
    );
    $recent_post = get_posts($args);
    
    if(!empty($recent_post))
    {
?>
<br class="clear"/><br/>
<div class="standard_wrapper">
	<hr/><br class="clear"/><br/>
	<h6 class="subtitle"><span><?php esc_html_e('Recent Portfolios', 'grandportfolio-translation' ); ?></span></h6><hr class="title_break"/>
	<br class="clear"/>
	<div class="single_recent_portfolio gallery four_cols portfolio-content section content clearfix" data-columns="4">
<?php
	foreach($recent_post as $recent_item)
	{
		$image_url = '';
		$portfolio_ID = $recent_item->ID;
		    	
		if(has_post_thumbnail($portfolio_ID, 'large'))
		{
		    $image_id = get_post_thumbnail_id($portfolio_ID);
		    $image_url = wp_get_attachment_image_src($image_id, 'large', true);
		    
		    $small_image_url = wp_get_attachment_image_src($image_id, 'grandportfolio-gallery-grid', true);
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
		
		//Get portfolio category
		$portfolio_item_set = '';
		$portfolio_item_sets = wp_get_object_terms($portfolio_ID, 'portfoliosets');
		
		if(is_array($portfolio_item_sets))
		{
		    foreach($portfolio_item_sets as $set)
		    {
		    	$portfolio_item_set.= $set->slug.' ';
		    }
		}
?>
	<div class="element grid classic4_cols <?php echo esc_attr($portfolio_item_set); ?>" data-type="<?php echo esc_attr($portfolio_item_set); ?>">
	
		<div class="one_fourth gallery4 classic static filterable gallery_type">
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
					<a target="_blank" href="<?php echo esc_url($portfolio_link_url); ?>">
						<img src="<?php echo esc_url($small_image_url[0]); ?>" alt="<?php echo esc_attr($recent_item->post_title); ?>"/>
						<div class="portfolio_classic_icon_wrapper">
							<div class="portfolio_classic_icon_content">
								<i class="fa fa-chain"></i>
							</div>
						</div>
		            </a>
					
					<?php
						break;
						//end external link
						
						case 'Portfolio Content':
        				default:
        			?>
        			<a href="<?php echo esc_url(get_permalink($portfolio_ID)); ?>">
        				<img src="<?php echo esc_url($small_image_url[0]); ?>" alt="<?php echo esc_attr($recent_item->post_title); ?>" />
        				<div class="portfolio_classic_icon_wrapper">
							<div class="portfolio_classic_icon_content">
								<i class="fa fa-mail-forward"></i>
							</div>
						</div>
		            </a>
	                
	                <?php
						break;
						//portfolio content
        				
        				case 'Image':
					?>
					<a data-caption="<?php echo esc_attr($recent_item->post_title); ?>" href="<?php echo esc_url($image_url[0]); ?>" class="fancy-gallery">
						<img src="<?php echo esc_url($small_image_url[0]); ?>" alt="<?php echo esc_attr($recent_item->post_title); ?>" />
						<div class="portfolio_classic_icon_wrapper">
							<div class="portfolio_classic_icon_content">
								<i class="fa fa-search-plus"></i>
							</div>
						</div>
	                </a>
					
					<?php
						break;
						//end image
						
						case 'Youtube Video':
					?>
					
					<a href="https://www.youtube.com/embed/<?php echo esc_attr($portfolio_video_id); ?>" class="lightbox_youtube" data-options="width:900, height:488">
						<img src="<?php echo esc_url($small_image_url[0]); ?>" alt="<?php echo esc_attr($recent_item->post_title); ?>" />
						<div class="portfolio_classic_icon_wrapper">
							<div class="portfolio_classic_icon_content">
								<i class="fa fa-play"></i>
							</div>
						</div>
		            </a>
					
					<?php
						break;
						//end youtube
					
					case 'Vimeo Video':
					?>
					<a href="https://player.vimeo.com/video/<?php echo esc_attr($portfolio_video_id); ?>?badge=0" class="lightbox_vimeo" data-options="width:900, height:506">
						<img src="<?php echo esc_url($small_image_url[0]); ?>" alt="<?php echo esc_attr($recent_item->post_title); ?>" />
						<div class="portfolio_classic_icon_wrapper">
							<div class="portfolio_classic_icon_content">
								<i class="fa fa-play"></i>
							</div>
						</div>
		            </a>
					
					<?php
						break;
						//end vimeo
						
					case 'Self-Hosted Video':
					
						//Get video URL
						$portfolio_mp4_url = get_post_meta($portfolio_ID, 'portfolio_mp4_url', true);
						$preview_image = wp_get_attachment_image_src($image_id, 'large', true);
					?>
					<a href="<?php echo esc_url($portfolio_mp4_url); ?>" class="lightbox_vimeo">
						<img src="<?php echo esc_url($small_image_url[0]); ?>" alt="<?php echo esc_attr($recent_item->post_title); ?>" />
						<div class="portfolio_classic_icon_wrapper">
							<div class="portfolio_classic_icon_content">
								<i class="fa fa-play"></i>
							</div>
						</div>
		            </a>
					
					<?php
						break;
						//end self-hosted
					?>
					
					<?php
						}
						//end switch
					?>
					
					<div id="portfolio_desc_<?php echo esc_attr($portfolio_ID); ?>" class="portfolio_desc portfolio4 filterable">
        			    <h5><?php echo esc_html($recent_item->post_title); ?></h5>
					    <div class="post_detail"><?php echo esc_html($recent_item->post_excerpt); ?></div>
				    </div>
			<?php
				}		
			?>
		</div>
	</div>
<?php
	}
	//End foreach
?>
	</div>
</div>
<?php
	//Check if display portfolio page link
	$tg_portfolio_url = kirki_get_option('tg_portfolio_url');
	
	if(!empty($tg_portfolio_url))
	{
?>
	<div class="portfolio_recent_link">
		<a class="tooltip" href="<?php echo esc_url($tg_portfolio_url); ?>" title="<?php echo esc_attr(esc_html_e('View All Portfolios', 'grandportfolio-translation' )); ?>"><i class="fa fa-th-large marginright middle"></i></h6></a>
	</div>
	<br class="clear"/>
<?php
	}
?>

<?php
	}
}
?>
		    
<?php
    $tg_portfolio_next_prev = kirki_get_option('tg_portfolio_next_prev');
    
    if(!empty($tg_portfolio_next_prev))
    {

    $args = array(
    	'before'           => '<p>' . esc_html__('Pages:', 'grandportfolio-translation'),
    	'after'            => '</p>',
    	'link_before'      => '',
    	'link_after'       => '',
    	'next_or_number'   => 'number',
    	'nextpagelink'     => esc_html__('Next page', 'grandportfolio-translation'),
    	'previouspagelink' => esc_html__('Previous page', 'grandportfolio-translation'),
    	'pagelink'         => '%',
    	'echo'             => 1
    );
    wp_link_pages($args);
?>
<?php
    //Get Previous and Next Post
    $prev_post = get_previous_post();
    
    //If previous post is empty then get last post
    if(empty($prev_post))
    {
    	$args = array(
            'numberposts' => 1,
            'order' => 'ASC',
            'orderby' => 'menu_order',
            'post_type' => array('portfolios'),
        );
        $prev_post = get_posts($args);
        
    	$prev_post_bak = $prev_post[0];
    	unset($prev_post);
    	$prev_post = $prev_post_bak;
    }
    
    $next_post = get_next_post();
    
    //If next post is empty then get first post
    if(empty($next_post))
    {
    	$args = array(
            'numberposts' => 1,
            'order' => 'DESC',
            'orderby' => 'menu_order',
            'post_type' => array('portfolios'),
        );
        $next_post = get_posts($args);
    	
    	$next_post_bak = $next_post[0];
    	unset($next_post);
    	$next_post = $next_post_bak;
    }
?>
<div class="portfolio_post_wrapper">
<?php
   //Get Next Post
   if (!empty($next_post)): 
   $next_image_thumb = wp_get_attachment_image_src(get_post_thumbnail_id($next_post->ID), 'thumbnail', true);
   if(isset($next_image_thumb[0]))
   {
       $image_file_name = basename($next_image_thumb[0]);
   }
?>
   <div class="portfolio_post_next">
   		<a class="portfolio_next tooltip" title="<?php echo esc_attr($next_post->post_title); ?> →" href="<?php echo esc_url(get_permalink( $next_post->ID )); ?>">
     		<i class="fa fa-angle-right"></i>
     	</a>
    </div>
<?php endif; ?>

<?php
   //Get Previous Post
   if (!empty($prev_post)): 
   	$prev_image_thumb = wp_get_attachment_image_src(get_post_thumbnail_id($prev_post->ID), 'thumbnail', true);
   	if(isset($prev_image_thumb[0]))
   	{
   	    $image_file_name = basename($prev_image_thumb[0]);
   	}
?>
   	<div class="portfolio_post_previous">
   		<a class="portfolio_prev tooltip" title="← <?php echo esc_attr($prev_post->post_title); ?>" href="<?php echo esc_url(get_permalink( $prev_post->ID )); ?>">
     		<i class="fa fa-angle-left"></i>
     	</a>
    </div>
<?php endif; ?>

</div>
<?php
    
} //End if display previous and next portfolios
?>

<br class="clear"/>
<?php get_footer(); ?>