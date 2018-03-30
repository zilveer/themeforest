<?php
/**
 * Template Name: Gallery Archive Striped
 * The main template file for display gallery page.
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

get_header();

wp_enqueue_script("grandportfolio-horizontal-gallery", get_template_directory_uri()."/js/horizontal_gallery.js", false, THEMEVERSION, true);

//Check if disable slideshow hover effect
$tg_gallery_hover_slide = kirki_get_option( "tg_gallery_hover_slide" );

if(!empty($tg_gallery_hover_slide))
{
	wp_enqueue_script("cycle2", get_template_directory_uri()."/js/jquery.cycle2.min.js", false, THEMEVERSION, true);
	wp_enqueue_script("grandportfolio-custom-cycle", get_template_directory_uri()."/js/custom_cycle.js", false, THEMEVERSION, true);
}

$grandportfolio_screen_class = grandportfolio_get_screen_class();
grandportfolio_set_screen_class('single_gallery');

$grandportfolio_topbar = grandportfolio_get_topbar();

$grandportfolio_page_content_class = grandportfolio_get_page_content_class();
grandportfolio_set_page_content_class('wide');

//Include custom header feature
get_template_part("/templates/template-header");
?>

<!-- Begin content -->
<div id="page_content_wrapper" class="transparent horizontal">
	<div id="horizontal_gallery">
	<table id="horizontal_gallery_wrapper">
	<tbody><tr>
	<?php
	    //Get galleries
	    $paged = (get_query_var('paged')) ? get_query_var('paged') : 1;
	    $pp_portfolio_items_page = -1;
	    
	    $query_string = 'paged='.$paged.'&orderby=menu_order&order=ASC&post_type=galleries&posts_per_page=-1&suppress_filters=0';
	    
	    if(!empty($term))
	    {
	        $query_string .= '&gallerycat='.$term;
	    }
	    
	    if(THEMEDEMO)
	    {
		    $query_string .= '&gallerycat='.DEMOGALLERYID;
	    }
		
	    query_posts($query_string);
	
	    $key = 0;
	    if (have_posts()) : while (have_posts()) : the_post();
	    	$small_image_url = array();
	        $image_url = '';
	        $gallery_ID = get_the_ID();
	        		
	        if(has_post_thumbnail($gallery_ID, 'grandportfolio-gallery-striped'))
	        {
	            $image_id = get_post_thumbnail_id($gallery_ID);
	            $small_image_url = wp_get_attachment_image_src($image_id, 'grandportfolio-gallery-striped', true);
	        }
	        
	        $permalink_url = get_permalink($gallery_ID);

	        $content_class = 'even';
	        if($key%2!=0)
	        {
		        $content_class = 'odd';
	        }
	        else
	        {
		        $content_class = 'even';
	        }
	        
		    if(isset($small_image_url[0]) && !empty($small_image_url[0]))
		    {
	?>	
	<td>
		<a href="<?php echo esc_url($permalink_url); ?>">
	    	<div class="gallery_image_wrapper archive">
		    	<?php
				    $all_photo_arr = array();
				    
				    if(!empty($tg_gallery_hover_slide))
				    {
				    	//Get gallery images
				    	$all_photo_arr = get_post_meta($gallery_ID, 'wpsimplegallery_gallery', true);
				    	
				    	//Get only 5 recent photos
				    	$all_photo_arr = array_slice($all_photo_arr, 0, 5);
				    }
				    
				    if(!empty($all_photo_arr))
				    {
				?>
				<ul class="gallery_img_slides">
				<?php
				    foreach($all_photo_arr as $photo)
				    {
				    	$slide_image_url = wp_get_attachment_image_src($photo, 'grandportfolio-gallery-striped', true);
				?>
				<li><img src="<?php echo esc_url($slide_image_url[0]); ?>" alt="" class="static"/></li>
				<?php
				    }
				?>
				</ul>
				<?php
				    }
				?>
			    <div class="gallery_archive_desc">
			        <h6><?php the_title(); ?></h6>
			        <div class="post_detail"><?php the_excerpt(); ?></div>
			    </div>
			    <img src="<?php echo esc_url($small_image_url[0]); ?>" alt="<?php echo esc_attr(get_the_title()); ?>" class="horizontal_gallery_img"/>
			</div>
		</a>
	</td>
	
	<?php
		    }

	    $key++;
	    endwhile; endif;	
	?>
	</tr></tbody>
	</table>
	</div>
	</div>
</div>

<?php
	get_footer();
?>