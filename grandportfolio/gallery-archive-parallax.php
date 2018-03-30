<?php
/**
 * Template Name: Gallery Archive Parallax
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

$grandportfolio_page_content_class = grandportfolio_get_page_content_class();
grandportfolio_set_page_content_class('wide');

$grandportfolio_screen_class = grandportfolio_get_screen_class();
grandportfolio_set_screen_class('single_gallery');

//Include custom header feature
get_template_part("/templates/template-header");
?>

<!-- Begin content -->  
<div class="inner">

	<div class="inner_wrapper nopadding">
	
	<div id="page_main_content" class="sidebar_content full_width nopadding fixed_column">
	
	<?php 
        if(have_posts()) 
		{
	?>
		 <div class="standard_wrapper">
	<?php
        while ( have_posts() ) : the_post(); ?>		
	        <?php the_content(); break;  ?>
    <?php endwhile; ?>
    </div>
    <?php
    }
    ?>
	
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
	        		
	        if(has_post_thumbnail($gallery_ID, 'original'))
	        {
	            $image_id = get_post_thumbnail_id($gallery_ID);
	            $image_url = wp_get_attachment_image_src($image_id, 'original', true);
	        }
	        
	        $permalink_url = get_permalink($gallery_ID);

	    if(!empty($image_url[0]))
		{
			$background_image = $image_url[0];
			$background_image_width = $image_url[1];
			$background_image_height = $image_url[2];
	?>
	<div class="one archive_parallax parallax" data-id="post-<?php echo esc_attr($key+1); ?>" data-image="<?php echo esc_attr($background_image); ?>" data-width="<?php echo esc_attr($background_image_width); ?>" data-height="<?php echo esc_attr($background_image_height); ?>">
		<a href="<?php echo esc_url($permalink_url); ?>">
		    <div class="gallery_archive_desc">
		    	<h4><?php the_title(); ?></h4>
		    	<div class="post_detail"><?php the_excerpt(); ?></div>
		    </div>
		</a>
		
	</div>
	<?php
		}
	
	    $key++;
	    endwhile; endif;	
	?>
	
	</div>

</div>
</div>
</div>
<?php get_footer(); ?>
<!-- End content -->