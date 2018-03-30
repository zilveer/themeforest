<?php
/**
 * Template Name: Portfolio Fullscreen
 * The main template file for display portfolio page.
 *
 * @package WordPress
*/

/**
*	Get Current page object
**/
$ob_page = get_page($post->ID);
$current_page_id = '';

if(isset($ob_page->ID))
{
    $current_page_id = $ob_page->ID;
}

//important to apply dynamic header & footer style
$grandportfolio_homepage_style = grandportfolio_get_homepage_style();
grandportfolio_set_homepage_style('fullscreen');

get_header();

wp_enqueue_style("fullPage", get_template_directory_uri()."/css/jquery.fullPage.css", false, THEMEVERSION, "all");
wp_enqueue_script("fullPage", get_template_directory_uri()."/js/jquery.fullPage.min.js", false, THEMEVERSION, true);
wp_enqueue_script("grandportfolio-custom-fullpage", get_template_directory_uri()."/js/custom_fullpage.js", false, THEMEVERSION, true);
?>

<?php
	$grandportfolio_hide_title= grandportfolio_get_hide_title();
	grandportfolio_set_hide_title(1);
	
	$grandportfolio_page_content_class = grandportfolio_get_page_content_class();
	grandportfolio_set_page_content_class('wide');

    //Include custom header feature
	get_template_part("/templates/template-header");
?>

<!-- Begin content -->   
<div id="fullpage">
	
	<?php
	    //Get all portfolio items for paging
		
		if(is_front_page())
		{
		    $paged = (get_query_var('page')) ? get_query_var('page') : 1;
		}
		else
		{
		    $paged = (get_query_var('paged')) ? get_query_var('paged') : 1;
		}
		
		$query_string = 'paged='.$paged.'&orderby=menu_order&order=ASC&post_type=portfolios&numberposts=-1&suppress_filters=0&posts_per_page=-1';
	
		if(!empty($term))
		{
			$ob_term = get_term_by('slug', get_query_var( 'term' ), get_query_var( 'taxonomy' ) );
			$custom_tax = $wp_query->query_vars['taxonomy'];
		    $query_string .= '&posts_per_page=-1&'.$custom_tax.'='.$term;
		}
		query_posts($query_string);
	
	    $key = 0;
		if (have_posts()) : while (have_posts()) : the_post();
			$key++;
			$image_url = '';
			$portfolio_ID = get_the_ID();
					
			if(has_post_thumbnail($portfolio_ID, 'original'))
			{
			    $image_id = get_post_thumbnail_id($portfolio_ID);
			    $image_url = wp_get_attachment_image_src($image_id, 'original', true);
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
	        
		    if(!empty($image_url[0]))
		    {
		    	$portfolio_type = get_post_meta($portfolio_ID, 'portfolio_type', true);
				$portfolio_video_id = get_post_meta($portfolio_ID, 'portfolio_video_id', true);
				
				switch($portfolio_type)
			    {
				    case 'External Link':
				    	$portfolio_link_url = get_post_meta($portfolio_ID, 'portfolio_link_url', true);
				?>
				<div class="section gallery_archive">
			    	<div class="background_image" style="background-image: url('<?php echo esc_url($image_url[0]); ?>');">
				        <a href="<?php echo esc_url($portfolio_link_url); ?>">
				        	<div class="gallery_archive_desc">
				        		<h4><?php the_title(); ?></h4>
				        		<div class="post_detail"><?php the_excerpt(); ?></div>
				        	</div>
				        </a>
			    	</div>
			    </div>
				
			<?php
				    break;
				    //end external link
				    
				    case 'Portfolio Content':
				    default:
				?>
				<div class="section gallery_archive">
			    	<div class="background_image" style="background-image: url('<?php echo esc_url($image_url[0]); ?>');">
				        <a href="<?php echo esc_url(get_permalink($portfolio_ID)); ?>">
				        	<div class="gallery_archive_desc">
				        		<h4><?php the_title(); ?></h4>
				        		<div class="post_detail"><?php the_excerpt(); ?></div>
				        	</div>
				        </a>
			    	</div>
			    </div>
				
			<?php
				    break;
				    //end portfolio content
				    
				    case 'Image':
				?>
				<div class="section gallery_archive">
			    	<div class="background_image" style="background-image: url('<?php echo esc_url($image_url[0]); ?>');">
				        <a data-caption="<?php echo esc_attr(get_the_title()); ?>" href="<?php echo esc_url($image_url[0]); ?>" class="fancy-gallery">
				        	<div class="gallery_archive_desc">
				        		<h4><?php the_title(); ?></h4>
				        		<div class="post_detail"><?php the_excerpt(); ?></div>
				        	</div>
				        </a>
			    	</div>
			    </div>
				
			<?php
				    break;
				    //end image
				    
				    case 'Youtube Video':
				?>
				<div class="section gallery_archive">
			    	<div class="background_image" style="background-image: url('<?php echo esc_url($image_url[0]); ?>');">
				        <a href="https://www.youtube.com/embed/<?php echo esc_attr($portfolio_video_id); ?>" class="lightbox_youtube" data-options="width:900, height:488">
				        	<div class="gallery_archive_desc">
				        		<h4><?php the_title(); ?></h4>
				        		<div class="post_detail"><?php the_excerpt(); ?></div>
				        	</div>
				        </a>
			    	</div>
			    </div>
				
			<?php
				    break;
				    //end youtube video
				    
				    case 'Vimeo Video':
				?>
				<div class="section gallery_archive">
			    	<div class="background_image" style="background-image: url('<?php echo esc_url($image_url[0]); ?>');">
				        <a href="https://player.vimeo.com/video/<?php echo esc_attr($portfolio_video_id); ?>?badge=0" class="lightbox_vimeo" data-options="width:900, height:506">
				        	<div class="gallery_archive_desc">
				        		<h4><?php the_title(); ?></h4>
				        		<div class="post_detail"><?php the_excerpt(); ?></div>
				        	</div>
				        </a>
			    	</div>
			    </div>
				
			<?php
				    break;
				    //end vimeo video
				    
				    case 'Self-Hosted Video':
				    
				    //Get video URL
					$portfolio_mp4_url = get_post_meta($portfolio_ID, 'portfolio_mp4_url', true);
					$preview_image = wp_get_attachment_image_src($image_id, 'large', true);
				?>
				<div class="section gallery_archive">
			    	<div class="background_image" style="background-image: url('<?php echo esc_url($image_url[0]); ?>');">
				        <a href="<?php echo esc_url($portfolio_mp4_url); ?>" class="lightbox_vimeo">
				        	<div class="gallery_archive_desc">
				        		<h4><?php the_title(); ?></h4>
				        		<div class="post_detail"><?php the_excerpt(); ?></div>
				        	</div>
				        </a>
			    	</div>
			    </div>
				
			<?php
				    break;
				    //end vimeo video
			    }
		    }

	    $key++;
	    endwhile; endif;	
	?>
	
</div>
<?php get_footer(); ?>
<!-- End content -->