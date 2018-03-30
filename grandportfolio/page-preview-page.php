<?php
/**
 * The main template file for preview content builder display page.
 *
 * @package WordPress
*/

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

get_header(); 

//if dont have password set
if(!post_password_required())
{
	wp_enqueue_script("grandportfolio-custom-onepage", get_template_directory_uri()."/js/custom_onepage.js", false, THEMEVERSION, true);
?>

<?php
//Get page header display setting
$page_show_title = get_post_meta($current_page_id, 'page_show_title', true);

if(empty($page_show_title))
{
	//Get current page tagline
	$page_tagline = get_post_meta($current_page_id, 'page_tagline', true);

	$pp_page_bg = '';
	//Get page featured image
	if(has_post_thumbnail($current_page_id, 'full'))
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
	
	//Check if enable content builder
	$ppb_enable = get_post_meta($current_page_id, 'ppb_enable', true);
	
	$grandportfolio_topbar = grandportfolio_get_topbar();
	
	//Get header background title style
	$tg_page_title_bg_bg_style = kirki_get_option('tg_page_title_bg_bg_style');
?>
<div id="page_caption" class="<?php if(!empty($pp_page_bg)) { ?>hasbg parallax <?php } ?> <?php if(!empty($grandportfolio_topbar)) { ?>withtopbar<?php } ?> <?php if(!empty($screen_class)) { ?>split<?php } ?> <?php if(!empty($ppb_enable)) { ?>ppb_enable<?php } ?> <?php echo esc_attr($tg_page_title_bg_bg_style); ?>">
	<?php if(!empty($pp_page_bg)) { ?>
		<div id="bg_regular" style="background-image:url(<?php echo esc_url($pp_page_bg); ?>);"></div>
	<?php } ?>
	<?php
	    if(!empty($tg_page_title_img_blur))
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
			<h1><?php the_title(); ?></h1>
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
		$grandportfolio_screen_class = grandportfolio_get_screen_class();
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
			<h1 <?php if(!empty($pp_page_bg) && !empty($grandportfolio_topbar)) { ?>class ="withtopbar"<?php } ?>><?php the_title(); ?></h1>
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
	<?php
		}
	?>
</div>
<?php
}
?>

<div class="ppb_wrapper">
<?php
	$ppb_form_data_order = get_transient('grandportfolio_'.$post->ID.'_data_order');
	$ppb_page_content = '';
	
	if(isset($ppb_form_data_order))
	{
	    $ppb_form_item_arr = explode(',', $ppb_form_data_order);
	}
	
	$ppb_shortcodes = array();
	
	require_once get_template_directory() . "/lib/contentbuilder.shortcode.lib.php";
	
	if(isset($ppb_form_item_arr[0]) && !empty($ppb_form_item_arr[0]))
	{
	    $ppb_shortcode_code = '';
	    $ppb_form_item_data = get_transient('grandportfolio_'.$post->ID.'_data');
	    $ppb_form_item_size = get_transient('grandportfolio_'.$post->ID.'_size');
	
	    foreach($ppb_form_item_arr as $key => $ppb_form_item)
	    {
		    if(isset($ppb_form_item_data[$ppb_form_item]))
		    {
		    	$ppb_form_item_data_obj = json_decode(stripslashes($ppb_form_item_data[$ppb_form_item]));
		    	
		    	$ppb_shortcode_content_name = $ppb_form_item_data_obj->shortcode.'_content';
		    	
		    	if(isset($ppb_form_item_data_obj->$ppb_shortcode_content_name))
		    	{
		    		$ppb_shortcode_code = '['.$ppb_form_item_data_obj->shortcode.' size="'.$ppb_form_item_size[$ppb_form_item].'" ';
		    		
		    		//Get shortcode title
		    		$ppb_shortcode_title_name = $ppb_form_item_data_obj->shortcode.'_title';
		    		if(isset($ppb_form_item_data_obj->$ppb_shortcode_title_name))
		    		{
		    			$ppb_shortcode_code.= 'title="'.esc_attr(rawurldecode($ppb_form_item_data_obj->$ppb_shortcode_title_name), ENT_QUOTES, "UTF-8").'" ';
		    		}
		    		
		    		//Get shortcode attributes
		    		if(isset($ppb_shortcodes[$ppb_form_item_data_obj->shortcode]))
		    		{
			    		$ppb_shortcode_arr = $ppb_shortcodes[$ppb_form_item_data_obj->shortcode];
			    		
			    		foreach($ppb_shortcode_arr['attr'] as $attr_name => $attr_item)
			    		{
			    			$ppb_shortcode_attr_name = $ppb_form_item_data_obj->shortcode.'_'.$attr_name;
			    			
			    			if(isset($ppb_form_item_data_obj->$ppb_shortcode_attr_name))
			    			{
			    				$ppb_shortcode_code.= $attr_name.'="'.esc_attr(rawurldecode($ppb_form_item_data_obj->$ppb_shortcode_attr_name)).'" ';
			    			}
			    		}
			    	}
	
		    		$ppb_shortcode_code.= ']'.rawurldecode($ppb_form_item_data_obj->$ppb_shortcode_content_name).'[/'.$ppb_form_item_data_obj->shortcode.']';
		    	}
		    	else if(isset($ppb_shortcodes[$ppb_form_item_data_obj->shortcode]))
		    	{
		    		$ppb_shortcode_code = '['.$ppb_form_item_data_obj->shortcode.' size="'.$ppb_form_item_size[$ppb_form_item].'" ';
		    		
		    		//Get shortcode title
		    		$ppb_shortcode_title_name = $ppb_form_item_data_obj->shortcode.'_title';
		    		if(isset($ppb_form_item_data_obj->$ppb_shortcode_title_name))
		    		{
		    			$ppb_shortcode_code.= 'title="'.esc_attr(rawurldecode($ppb_form_item_data_obj->$ppb_shortcode_title_name), ENT_QUOTES, "UTF-8").'" ';
		    		}
		    		
		    		//Get shortcode attributes
		    		if(isset($ppb_shortcodes[$ppb_form_item_data_obj->shortcode]))
		    		{
			    		$ppb_shortcode_arr = $ppb_shortcodes[$ppb_form_item_data_obj->shortcode];
			    		
			    		foreach($ppb_shortcode_arr['attr'] as $attr_name => $attr_item)
			    		{
			    			$ppb_shortcode_attr_name = $ppb_form_item_data_obj->shortcode.'_'.$attr_name;
			    			
			    			if(isset($ppb_form_item_data_obj->$ppb_shortcode_attr_name))
			    			{
			    				$ppb_shortcode_code.= $attr_name.'="'.esc_attr(rawurldecode($ppb_form_item_data_obj->$ppb_shortcode_attr_name)).'" ';
			    			}
			    		}
			    	}
		    		
		    		$ppb_shortcode_code.= ']';
		    	}
		    	
		    	$ppb_page_content.= grandportfolio_apply_content($ppb_shortcode_code);
	        }
        }
    }
    //echo $ppb_shortcode_code;
    echo $ppb_page_content;
}
?>
</div>

<?php get_footer(); ?>