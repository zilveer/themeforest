<?php
/**
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

//Check if gallery template
$grandportfolio_page_gallery_id = grandportfolio_get_page_gallery_id();
if(!empty($grandportfolio_page_gallery_id))
{
	$current_page_id = $grandportfolio_page_gallery_id;
}

//Check if password protected
get_template_part("/templates/template-password");

//Get gallery images
$all_photo_arr = get_post_meta($current_page_id, 'wpsimplegallery_gallery', true);

//Get default gallery sorting
$all_photo_arr = grandportfolio_resort_gallery_img($all_photo_arr);

get_header();

$grandportfolio_topbar = grandportfolio_get_topbar();

//Get gallery header
get_template_part("/templates/template-gallery-header");

wp_enqueue_script("grandportfolio-custom-mixed_masonry", get_template_directory_uri()."/js/custom_mixed_masonry.js", false, THEMEVERSION, true);
?>

<div class="inner">

	<div class="inner_wrapper nopadding">
	
	<div id="page_main_content" class="sidebar_content full_width nopadding fixed_column">
	
	<div id="portfolio_mixed_filter_wrapper" class="portfolio_mixed_filter_wrapper gallery three_cols portfolio-content section content clearfix" data-columns="3">
	
	<?php
		$tg_full_image_caption = kirki_get_option('tg_full_image_caption');
	
		$large_counter = 1;
		$next_number_to_add = 4;
		$next_trigger = 1;
	
	    foreach($all_photo_arr as $key => $photo_id)
	    {
	        $small_image_url = '';
	        $image_url = '';
	        
	        //Calculated columns size
			$grid_wrapper_class = 'classic3_cols';
			$column_class = 'one_third gallery3';
			$grandportoflio_image_size = 'grandportfolio-gallery-grid';
			
			$large_counter_trigger = FALSE;
			
			if($next_trigger == $key+1)
			{
				$large_counter_trigger = TRUE;
				$next_trigger = $next_trigger+$next_number_to_add;
				
				if($next_number_to_add == 4)
				{
					$next_number_to_add = 2;
				}
				else if($next_number_to_add==2)
				{
					$next_number_to_add = 4;
				}
			}
			
			if($large_counter_trigger)
			{
				$wrapper_class = 'three_cols double_size';
				$grid_wrapper_class = 'classic3_cols double_size';
				$column_class = 'one_third gallery3 double_size';
				$grandportoflio_image_size = 'grandportfolio-gallery-grid-large';
			}
			
			$large_counter++;
	        
	        if(!empty($photo_id))
	        {
	        	$image_url = wp_get_attachment_image_src($photo_id, 'original', true);
	        	$small_image_url = wp_get_attachment_image_src($photo_id, $grandportoflio_image_size, true);
	        }
	        
	        //Get image meta data
	        $image_caption = get_post_field('post_excerpt', $photo_id);
	        $image_alt = get_post_meta($photo_id, '_wp_attachment_image_alt', true);
	        
	        //Get image purchase URL
			$grandportfolio_purchase_url = get_post_meta($photo_id, 'grandportfolio_purchase_url', true);
			
			if(!empty($grandportfolio_purchase_url))
			{
			    $image_caption.= '<a href="'.esc_url($grandportfolio_purchase_url).'" class="button ghost"><i class="fa fa-shopping-cart marginright"></i>'.esc_html__('Purchase', 'grandportfolio-translation' ).'</a>';
			}
	?>
	<div class="element grid <?php echo esc_attr($grid_wrapper_class); ?>">
	
		<div class="<?php echo esc_attr($column_class); ?> static filterable gallery_type animated<?php echo esc_attr($key+1); ?>" data-id="post-<?php echo esc_attr($key+1); ?>">
		
			<?php 
			    if(isset($image_url[0]) && !empty($image_url[0]))
			    {
			?>		
			    <a <?php if(!empty($tg_full_image_caption)) { ?>data-caption="<?php if(!empty($image_caption)) { ?><?php echo esc_attr($image_caption); ?><?php } ?>"<?php } ?> class="fancy-gallery" href="<?php echo esc_url($image_url[0]); ?>">
			        <img src="<?php echo esc_url($small_image_url[0]); ?>" alt="<?php echo esc_attr($image_alt); ?>" />
			    </a>
			<?php
			    }		
			?>
		
		</div>
		
	</div>
	<?php
		}
	?>
		
	</div>
	
	</div>

</div>
</div>

</div>
<?php get_footer(); ?>
<!-- End content -->