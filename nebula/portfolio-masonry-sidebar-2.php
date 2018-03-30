<?php
/**
 * Template Name: Portfolio Masonry 2 Columns Right Sidebar
 * The main template file for display gallery page.
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

//Get page sidebar
$page_sidebar = get_post_meta($current_page_id, 'page_sidebar', true);

//If not select sidebar then select default one
if(empty($page_sidebar))
{
	$page_sidebar = 'Page Sidebar';
}

get_header();
?>
<input type="hidden" id="pp_wall_columns" name="pp_wall_columns" value="2"/>
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
<div id="page_caption" class="nomargin">
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

<?php  
//Get all sets and sorting option
$pp_portfolio_set_sort = get_option('pp_portfolio_set_sort');

$sets_arr = get_terms('portfoliosets', 'hide_empty=0&hierarchical=0&parent=0&orderby='.$pp_portfolio_set_sort);
    
if(!empty($sets_arr) && empty($term))
{
?>
    <ul id="portfolio_filters" class="portfolio-main filter full"> 
    	<li class="all-projects active">
    		<a class="active" href="javascript:;" data-filter="*"><?php echo _e( 'All', THEMEDOMAIN ); ?></a>
    		<span class="separator">/</span>
    	</li>
    	<?php
    		foreach($sets_arr as $key => $set_item)
    		{
    	?>
    	<li class="cat-item <?php echo $set_item->slug; ?>" data-type="<?php echo $set_item->slug; ?>" style="clear:none">
    		<a data-filter=".<?php echo $set_item->slug; ?>" href="javascript:;" title="<?php echo $set_item->name; ?>"><?php echo $set_item->name; ?></a>
    		<span class="separator">/</span>
    	</li> 
    	<?php
    		}
    	?>
    </ul><br class="clear"/>
<?php
}
?>

<div id="page_content_wrapper">
    
    <div class="inner">

    	<!-- Begin main content -->
    	<div class="inner_wrapper">
    		
    		<div class="sidebar_content nomargintop">
    		
    		<?php
			    if(empty($term))
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
    
    $query_string = 'paged='.$paged.'&orderby=menu_order&order=ASC&post_type=portfolios&numberposts=-1&posts_per_page='.$pp_portfolio_items_page;
    query_posts($query_string);
?>
<div id="photo_wall_wrapper" class="has_sidebar">
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
    	    
    	    $small_image_url = wp_get_attachment_image_src($image_id, 'gallery_m_fh', true);
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
    	if(($key)%3==0)
    	{
    		$last_class = 'last';
    	}
    	
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
<div class="wall_entry two_cols <?php echo $portfolio_item_set; ?>">
    <?php 
	    if(!empty($image_url[0]))
	    {
	?>		
	    <div class="wall_thumbnail dynamic_height gallery_type animated<?php echo $key+1; ?>">
	    <?php
	    		$portfolio_type = get_post_meta($portfolio_ID, 'portfolio_type', true);
	    		$portfolio_video_id = get_post_meta($portfolio_ID, 'portfolio_video_id', true);
	    		
	    		switch($portfolio_type)
	    		{
	    		case 'External Link':
	    			$portfolio_link_url = get_post_meta($portfolio_ID, 'portfolio_link_url', true);
	    	?>
	    	<a target="_blank" href="<?php echo $portfolio_link_url; ?>">
	    		<img src="<?php echo $small_image_url[0]; ?>" alt="" />

		        <div class="thumb_content">
		    	    <h3><?php echo get_the_title(); ?></h3>
		    	    <span><?php echo get_the_excerpt(); ?></span>
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
	    	
	            <div class="thumb_content">
		    	    <h3><?php echo get_the_title(); ?></h3>
		    	    <span><?php echo get_the_excerpt(); ?></span>
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
	    	
	            <div class="thumb_content">
		    	    <h3><?php echo get_the_title(); ?></h3>
		    	    <span><?php echo get_the_excerpt(); ?></span>
		    	</div>
	        </a>
        	
        	<?php
        		break;
        		//end fullscreen video Content
        		
        		case 'Image':
	    	?>
	    	
	    	<a data-title="<strong><?php echo get_the_title(); ?></strong><?php echo remove_shortcode(get_the_content()); ?>" href="<?php echo $image_url[0]; ?>" class="fancy-gallery">
	    		<img src="<?php echo $small_image_url[0]; ?>" alt="" />
	    	
	            <div class="thumb_content">
		    	    <h3><?php echo get_the_title(); ?></h3>
		    	    <span><?php echo get_the_excerpt(); ?></span>
		    	</div>
		    </a>
	    	
	    	<?php
	    		break;
	    		//end image
	    		
	    		case 'Youtube Video':
	    	?>
	    	
	    	<a title="<?php echo get_the_title(); ?>" href="#video_<?php echo $portfolio_video_id; ?>" class="lightbox_youtube">
	    		<img src="<?php echo $small_image_url[0]; ?>" alt="" />
	    	
	            <div class="thumb_content">
		    	    <h3><?php echo get_the_title(); ?></h3>
		    	    <span><?php echo get_the_excerpt(); ?></span>
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

	            <div class="thumb_content">
		    	    <h3><?php echo get_the_title(); ?></h3>
		    	    <span><?php echo get_the_excerpt(); ?></span>
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

		    	<div class="thumb_content">
		    	    <h3><?php echo get_the_title(); ?></h3>
		    	    <span><?php echo get_the_excerpt(); ?></span>
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
	    </div>
	<?php
	    }		
	?>

</div>

<?php
    endwhile; endif; 
?>
</div>

<?php
    //Get Social Share
    get_template_part("/templates/template-share");
?>

</div>
    	
    		<div class="sidebar_wrapper">
    		
    			<div class="sidebar_top"></div>
    		
    			<div class="sidebar">
    			
    				<div class="content">
    			
    					<ul class="sidebar_widget">
    					<?php dynamic_sidebar($page_sidebar); ?>
    					</ul>
    				
    				</div>
    		
    			</div>
    			<br class="clear"/>
    	
    			<div class="sidebar_bottom"></div>
    		</div>
    	</div>
    	
    </div>
    <!-- End main content -->

</div>  

<?php
$gallery_audio = get_post_meta($current_page_id, 'gallery_audio', true);

if(!empty($gallery_audio))
{
?>
<div class="gallery_audio">
	<?php echo do_shortcode('[audio width="30" height="30" src="'.$gallery_audio.'"]'); ?>
</div>
<?php
}
?>
<br class="clear"/>
<?php
	get_footer();
?>