<?php
/**
*	Get Current page object
**/
if(!is_null($post))
{
	$page_obj = get_page($post->ID);
}

$current_page_id = '';

/**
*	Get current page id
**/

if(!is_null($post) && isset($page_obj->ID))
{
    $current_page_id = $page_obj->ID;
}

//Get Page Menu Transparent Option
$page_menu_transparent = get_post_meta($current_page_id, 'page_menu_transparent', true);

//Get page header display setting
$page_title = get_the_title();
$page_show_title = get_post_meta($current_page_id, 'page_show_title', true);

if(is_tag())
{
	$page_show_title = 0;
	$page_title = single_cat_title( '', false );
	$term = 'tag';
} 
elseif(is_category())
{
    $page_show_title = 0;
	$page_title = single_cat_title( '', false );
	$term = 'category';
}
elseif(is_archive())
{
	$page_show_title = 0;

	if ( is_day() ) : 
		$page_title = get_the_date(); 
    elseif ( is_month() ) : 
    	$page_title = get_the_date('F Y'); 
    elseif ( is_year() ) : 
    	$page_title = get_the_date('Y'); 
    elseif ( !empty($term) ) : 
    	$ob_term = get_term_by('slug', get_query_var( 'term' ), get_query_var( 'taxonomy' ) );
    	$page_taxonomy = get_taxonomy($ob_term->taxonomy);
    	$page_title = $ob_term->name;
    else :
    	$page_title = esc_html__('Blog Archives', 'grandportfolio-translation'); 
    endif;
    
    $term = 'archive';
    
}
else if(is_search())
{
	$page_show_title = 0;
	$page_title = esc_html__('Search', 'grandportfolio-translation' );
	$term = 'search';
}

$grandportfolio_hide_title= grandportfolio_get_hide_title();
if($grandportfolio_hide_title == 1)
{
	$page_show_title = 1;
}

$grandportfolio_screen_class = grandportfolio_get_screen_class();
if($grandportfolio_screen_class == 'split' OR $grandportfolio_screen_class == 'split wide')
{
	$page_show_title = 0;
}

$grandportfolio_page_template = grandportfolio_get_page_template();

if(empty($page_show_title))
{
	//Get current page tagline
	$page_tagline = get_post_meta($current_page_id, 'page_tagline', true);
	
	if(is_category())
	{
		$page_tagline = category_description();
	}
	
	if(is_tag())
	{
		$page_tagline = category_description();
	}
	
	//If on gallery post type page
	if(is_single() && $post->post_type == 'galleries')
	{
		$page_tagline = get_the_excerpt();
	}

	if(is_archive() && get_query_var( 'taxonomy' ) == 'gallerycat')
	{
		$page_tagline = $ob_term->description;
	}
	
	if(is_search())
	{
		$page_tagline = esc_html__('Search Results for ', 'grandportfolio-translation' ).get_search_query();
	}

	$pp_page_bg = '';
	//Get page featured image
	if(has_post_thumbnail($current_page_id, 'full') && empty($term))
    {
        $image_id = get_post_thumbnail_id($current_page_id); 
        $image_thumb = wp_get_attachment_image_src($image_id, 'full', true);
        
        if(isset($image_thumb[0]) && !empty($image_thumb[0]))
        {
        	$pp_page_bg = $image_thumb[0];
        }
    }
    
    //Check if add blur effect
	$tg_page_title_img_blur = kirki_get_option('tg_page_title_img_blur');
	
	$grandportfolio_topbar = grandportfolio_get_topbar();
	
	//Get header background title style
	$tg_page_title_bg_bg_style = kirki_get_option('tg_page_title_bg_bg_style');
?>
<div id="page_caption" class="<?php if(!empty($pp_page_bg)) { ?>hasbg parallax <?php } ?> <?php if(!empty($grandportfolio_topbar)) { ?>withtopbar<?php } ?> <?php if(!empty($grandportfolio_screen_class)) { echo esc_attr($grandportfolio_screen_class); } ?> <?php echo esc_attr($tg_page_title_bg_bg_style); ?>">

	<?php
		//Check if page header background height is 100%
		$tg_page_title_bg_height = kirki_get_option('tg_page_title_bg_height');
		
		if($tg_page_title_bg_height == 100)
		{
	?>
		<div class="icon-scroll"></div>
	<?php
		}
	?>

	<?php if(!empty($pp_page_bg)) { ?>
		<div id="bg_regular" style="background-image:url(<?php echo esc_url($pp_page_bg); ?>);"></div>
	<?php } ?>
	<?php
	    if(!empty($tg_page_title_img_blur) && !empty($pp_page_bg) && $grandportfolio_screen_class != 'split')
	    {
	    	$ajax_nonce = wp_create_nonce('tgajax-post-contact-nonce');
	?>
	<div id="bg_blurred" style="background-image:url(<?php echo admin_url('admin-ajax.php').'?action=grandportfolio_blurred_image&src='.esc_url($pp_page_bg).'&tg_security='.$ajax_nonce; ?>);"></div>
	<?php
	    }
	?>
	
	<?php
		//If header background title style is center
		if($tg_page_title_bg_bg_style == 'center_title')
		{
	?>
	<div class="background_center_title_wrapper">
		<div class="title_content">
			<h1><?php echo esc_html($page_title); ?></h1>
			<?php
				if(!empty($page_tagline))
				{
			?>
				<div class="page_tagline">
		    		<?php echo wp_kses_post($page_tagline); ?>
		    	</div>
		    <?php
		    	}
		    ?>
		</div>
	</div>
	<div id="overlay_background_title"></div>
	<?php
		}
	?>
	
	<?php
		if($grandportfolio_screen_class == 'split')
		{
	?>
	<div class="bg_frame_split"></div>
	<?php
		}
	?>

	<?php
		//Check if display classic page title in this style
		if($grandportfolio_screen_class == 'split' OR $grandportfolio_screen_class == 'split wide' OR $tg_page_title_bg_bg_style == 'center_title')
		{
			$page_show_title = 1;	
		}
		
		if(empty($page_show_title))
		{
			//Get header alignment
			$tg_page_header_alignment = kirki_get_option('tg_page_header_alignment');
	?>
	<div class="page_title_wrapper <?php echo esc_attr($tg_page_header_alignment); ?>">
		<div class="page_title_inner">
			<h1 <?php if(!empty($pp_page_bg) && !empty($grandportfolio_topbar)) { ?>class ="withtopbar"<?php } ?>><?php echo esc_html($page_title); ?></h1>
			
			<?php
		    	if(!empty($page_tagline) && $grandportfolio_page_template != 'portfolio')
		    	{
		    ?>
		    	<?php
		    		if(empty($pp_page_bg)) 
		    		{
		    	?>
		    		<hr class="title_break">
		    	<?php
		    		}
		    	?>
		    	<div class="page_tagline">
		    		<?php echo wp_kses_post($page_tagline); ?>
		    	</div>
		    <?php
		    	}
		    	elseif($grandportfolio_page_template == 'portfolio')
		    	{
					//Include project filterable options
					get_template_part("/templates/template-portfolio-filterable");
		    	}
		    ?>
		    <?php
				//If portfolio templates
				if($grandportfolio_page_template == 'portfolio')
				{
					echo wp_kses_post($page_tagline);
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

<!-- Begin content -->
<?php
$grandportfolio_page_content_class = grandportfolio_get_page_content_class();
?>
<div id="page_content_wrapper" class="<?php if(!empty($pp_page_bg)) { ?>hasbg <?php } ?><?php if(!empty($pp_page_bg) && !empty($grandportfolio_topbar)) { ?>withtopbar <?php } ?><?php if(!empty($grandportfolio_page_content_class)) { echo esc_attr($grandportfolio_page_content_class); } ?>">