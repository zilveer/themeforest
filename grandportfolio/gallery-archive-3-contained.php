<?php
/**
 * Template Name: Gallery Archive 3 Columns Contained
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

//Check if disable slideshow hover effect
$tg_gallery_hover_slide = kirki_get_option( "tg_gallery_hover_slide" );

if(!empty($tg_gallery_hover_slide))
{
	wp_enqueue_script("cycle2", get_template_directory_uri()."/js/jquery.cycle2.min.js", false, THEMEVERSION, true);
	wp_enqueue_script("grandportfolio-custom-cycle", get_template_directory_uri()."/js/custom_cycle.js", false, THEMEVERSION, true);
}
?>

<?php
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
        if(empty($term) && have_posts()) 
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
	
	<div id="portfolio_filter_wrapper" class="gallery three_cols portfolio-content section content clearfix" data-columns="3">
	
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
	            $small_image_url = wp_get_attachment_image_src($image_id, 'grandportfolio-gallery-grid', true);
	        }
	        
	        $permalink_url = get_permalink($gallery_ID);
	?>
	<div class="element grid classic3_cols">
	
		<div class="one_third gallery3 static filterable gallery_type archive animated<?php echo esc_attr($key+1); ?>" data-id="post-<?php echo esc_attr($key+1); ?>">
		
			<?php 
			    if(!empty($small_image_url[0]))
			    {
			?>	
			    <a href="<?php echo esc_url($permalink_url); ?>">
			    	<div class="gallery_archive_desc">
			    		<h4><?php the_title(); ?></h4>
			    		<div class="post_detail"><?php the_excerpt(); ?></div>
			    	</div>
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
					    	$slide_image_url = wp_get_attachment_image_src($photo, 'grandportfolio-gallery-grid', true);
					?>
					<li><img src="<?php echo esc_url($slide_image_url[0]); ?>" alt="" class="static"/></li>
					<?php
					    }
					?>
					</ul>
					<?php
					    }
					?>
			        <img src="<?php echo esc_url($small_image_url[0]); ?>" alt="<?php echo esc_attr(get_the_title()); ?>" />
			    </a>
			<?php
			    }		
			?>
		
		</div>
		
	</div>
	<?php
	    $key++;
	    endwhile; endif;	
	?>
		
	</div>
	
	</div>

</div>
</div>
<br class="clear"/>
</div>
<?php get_footer(); ?>
<!-- End content -->