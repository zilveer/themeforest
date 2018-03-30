<?php
/**
 * The main template file for display page.
 *
 * @package WordPress
*/

/**
*	Get current page id
**/
$current_page_id = get_option( 'woocommerce_shop_page_id' );

get_header();

//Get Shop Sidebar
$page_sidebar = '';

//Get Shop Sidebar Display Settting
$tg_shop_layout = kirki_get_option('tg_shop_layout');

if(THEMEDEMO && isset($_GET['sidebar']))
{
	$tg_shop_layout = 'sidebar';
}

if($tg_shop_layout == 'sidebar')
{
	$page_sidebar = 'Shop Sidebar';
}
?>

<?php
//Check if woocommerce page
$shop_page_id = get_option( 'woocommerce_shop_page_id' );
$page_show_title = get_post_meta($shop_page_id, 'page_show_title', true);

if(empty($page_show_title))
{
	if(!is_product_category())
	{
		$page_title = get_the_title($current_page_id);
	
		//Get current page tagline
		$page_tagline = get_post_meta($current_page_id, 'page_tagline', true);
	}
	else
	{
		$page_title = single_cat_title( '', false );
		$page_tagline = category_description();
	}

	$pp_page_bg = '';
	$shop_page_id = get_option( 'woocommerce_shop_page_id' );
	
	//Get page featured image
	if(has_post_thumbnail($shop_page_id, 'full'))
    {
        $image_id = get_post_thumbnail_id($shop_page_id); 
        $image_thumb = wp_get_attachment_image_src($image_id, 'full', true);
        
        if(isset($image_thumb[0]) && !empty($image_thumb[0]))
        {
        	$pp_page_bg = $image_thumb[0];
        }
    }
    
    //Check if add blur effect
	$tg_page_title_img_blur = kirki_get_option('tg_page_title_img_blur');
    
    $grandportfolio_topbar = grandportfolio_get_topbar();
?>
<div id="page_caption" <?php if(!empty($pp_page_bg)) { ?>class="hasbg parallax"<?php } ?>>
	<?php if(!empty($pp_page_bg)) { ?>
		<div id="bg_regular" style="background-image:url(<?php echo esc_url($pp_page_bg); ?>);"></div>
	<?php } ?>
	<?php
	    if(!empty($tg_page_title_img_blur) && !empty($pp_page_bg))
	    {
	    	$ajax_nonce = wp_create_nonce('tgajax-post-contact-nonce');
	?>
	<div id="bg_blurred" style="background-image:url(<?php echo admin_url('admin-ajax.php').'?action=grandportfolio_blurred_image&src='.esc_url($pp_page_bg).'&tg_security='.$ajax_nonce; ?>);"></div>
	<?php
	    }
	?>

	<div class="page_title_wrapper">
		<div class="page_title_inner">
			<h1 <?php if(!empty($pp_page_bg) && !empty($grandportfolio_topbar)) { ?>class ="withtopbar"<?php } ?>><?php echo grandportfolio_get_first_title_word(esc_html($page_title)); ?></h1>
			<?php
		    	if(!empty($page_tagline))
		    	{
		    ?>
		    	<div class="page_tagline">
		    		<?php echo strip_tags($page_tagline); ?>
		    	</div>
		    <?php
		    	}
		    ?>
		</div>
		<?php if(empty($pp_page_bg)) { ?>
			<br class="clear"/>
		<?php
			}
		?>
	</div>
</div>
<?php
}
?>

<!-- Begin content -->
<div id="page_content_wrapper" <?php if(!empty($pp_page_bg)) { ?>class="hasbg"<?php } ?>>
    <div class="inner ">
    	<!-- Begin main content -->
    	<div class="inner_wrapper">
    		<div class="sidebar_content <?php if(empty($page_sidebar)) { ?>full_width<?php } else { ?>left_sidebar<?php } ?>">
				
				<?php woocommerce_content();  ?>
				
    		</div>
    		<?php if(!empty($page_sidebar)) { ?>
    		<div class="sidebar_wrapper left_sidebar">
	            <div class="sidebar">
	            
	            	<div class="content">
	            
	            		<?php 
						$page_sidebar = sanitize_title($page_sidebar);
						
						if (is_active_sidebar($page_sidebar)) { ?>
		    	    		<ul class="sidebar_widget">
		    	    		<?php dynamic_sidebar($page_sidebar); ?>
		    	    		</ul>
		    	    	<?php } ?>
	            	
	            	</div>
	        
	            </div>
            <br class="clear"/>
        
            <div class="sidebar_bottom"></div>
			</div>
			<br class="clear"/><br/>
    		<?php } ?>
    	</div>
    	<!-- End main content -->
    </div>
</div>
<!-- End content -->
<?php get_footer(); ?>