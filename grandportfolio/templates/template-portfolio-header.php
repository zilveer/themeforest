<?php
/**
*	Get Current page object
**/
$page = get_page($post->ID);

/**
*	Get current page id
**/

if(!isset($current_page_id) && isset($page->ID))
{
    $current_page_id = $page->ID;
}

//Get page header display setting
$page_title = get_the_title();
$page_menu_transparent = 0;

$post_ft_type = get_post_meta(get_the_ID(), 'post_ft_type', true);
$portfolio_hide_image = get_post_meta(get_the_ID(), 'portfolio_hide_image', true);

if(empty($portfolio_hide_image) && has_post_thumbnail($current_page_id, 'full'))
{
	$pp_page_bg = '';
	
	//Get page featured image
	if(has_post_thumbnail($current_page_id, 'original'))
    {
        $image_id = get_post_thumbnail_id($current_page_id); 
        $image_thumb = wp_get_attachment_image_src($image_id, 'original', true);
        
        if(isset($image_thumb[0]) && !empty($image_thumb[0]))
        {
        	$pp_page_bg = $image_thumb[0];
        	$page_menu_transparent = 1;
        }
        
        //Check if add blur effect
		$tg_page_title_img_blur = kirki_get_option('tg_page_title_img_blur');
    }
    
    $grandportfolio_topbar = grandportfolio_get_topbar();
    $grandportfolio_screen_class = grandportfolio_get_screen_class();
    
    //Get header background title style
	$tg_page_title_bg_bg_style = kirki_get_option('tg_page_title_bg_bg_style');
?>
<div id="page_caption" class="<?php if(!empty($pp_page_bg)) { ?>hasbg parallax<?php } ?> <?php if(!empty($grandportfolio_topbar)) { ?>withtopbar<?php } ?> <?php if(!empty($grandportfolio_screen_class)) { ?>split<?php } ?> <?php echo esc_attr($tg_page_title_bg_bg_style); ?>">

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
</div>
<?php
}
?>

<!-- Begin content -->
<?php
//Check if use page builder
$ppb_enable = get_post_meta($current_page_id, 'ppb_enable', true);

if(empty($ppb_enable))
{
	$grandportfolio_page_content_class = grandportfolio_get_page_content_class();
?>
<div id="page_content_wrapper" class="<?php if(!empty($pp_page_bg)) { ?>hasbg <?php } ?><?php if(!empty($pp_page_bg) && !empty($grandportfolio_topbar)) { ?>withtopbar <?php } ?><?php if(!empty($grandportfolio_page_content_class)) { echo esc_attr($grandportfolio_page_content_class); } ?>">
	<div class="post_caption">
		<h1><?php echo esc_html($page_title); ?></h1>
		<div class="post_detail">
		    <?php the_excerpt(); ?>
		</div>
	</div>
<?php
}
?>