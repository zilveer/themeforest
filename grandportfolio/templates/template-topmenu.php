<?php
//Get page ID
if(is_object($post))
{
    $obj_page = get_page($post->ID);
}
$current_page_id = '';

if(isset($obj_page->ID))
{
    $current_page_id = $obj_page->ID;
}
elseif(is_home())
{
    $current_page_id = get_option('page_on_front');
}
?>

<div class="header_style_wrapper">
<?php
    //Check if display top bar
    $tg_topbar = kirki_get_option('tg_topbar');
    if(THEMEDEMO && isset($_GET['topbar']) && !empty($_GET['topbar']))
	{
	    $tg_topbar = true;
	}
    
    $grandportfolio_topbar = grandportfolio_get_topbar();
    grandportfolio_set_topbar($tg_topbar);
    
    if(!empty($tg_topbar))
    {
?>

<!-- Begin top bar -->
<div class="above_top_bar">
    <div class="page_content_wrapper">
    
    <?php
    	//Check topbar content option
    	$tg_topbar_content = kirki_get_option('tg_topbar_content');
    
    	if($tg_topbar_content != 'center_menu')
    	{
    ?>
    <div class="top_contact_info">
		<?php
		    $tg_menu_contact_hours = kirki_get_option('tg_menu_contact_hours');
		    
		    if(!empty($tg_menu_contact_hours))
		    {	
		?>
		    <span id="top_contact_hours"><i class="fa fa-clock-o"></i><?php echo esc_html($tg_menu_contact_hours); ?></span>
		<?php
		    }
		?>
		<?php
		    //Display top contact info
		    $tg_menu_contact_number = kirki_get_option('tg_menu_contact_number');
		    
		    if(!empty($tg_menu_contact_number))
		    {
		?>
		    <span id="top_contact_number"><a href="tel:<?php echo esc_attr($tg_menu_contact_number); ?>"><i class="fa fa-phone"></i><?php echo esc_html($tg_menu_contact_number); ?></a></span>
		<?php
		    }
		?>
    </div>
    <?php
    	}
    ?>
    	
    <?php
    	//Display Top Menu
    	if ( has_nav_menu( 'top-menu' ) ) 
		{
		    wp_nav_menu( 
		        	array( 
		        		'menu_id'			=> 'top_menu',
		        		'menu_class'		=> 'top_nav',
		        		'theme_location' 	=> 'top-menu',
		        	) 
		    ); 
		}
    ?>
    </div>
</div>
<?php
    }
?>
<!-- End top bar -->

<?php
	//Get Page Menu Transparent Option
	//Get Page Menu Transparent Option
	$page_on_front = get_option('page_on_front');
	if(is_home() && $page_on_front == 0)
	{
		$page_menu_transparent = 0;
	}
	else
	{
		$page_menu_transparent = get_post_meta($current_page_id, 'page_menu_transparent', true);
	}

    $pp_page_bg = '';
    //Get page featured image
    if(has_post_thumbnail($current_page_id, 'full'))
    {
        $image_id = get_post_thumbnail_id($current_page_id); 
        $image_thumb = wp_get_attachment_image_src($image_id, 'full', true);
        $pp_page_bg = $image_thumb[0];
    }
    
   if(!empty($pp_page_bg) && basename($pp_page_bg)=='default.png')
    {
    	$pp_page_bg = '';
    }
	
	//Check if Woocommerce is installed	
	if(class_exists('Woocommerce') && grandportfolio_is_woocommerce_page())
	{
		//Check if woocommerce page
		$shop_page_id = get_option( 'woocommerce_shop_page_id' );
		$page_menu_transparent = get_post_meta($shop_page_id, 'page_menu_transparent', true);
	}
	
	if(is_single() && !empty($pp_page_bg) && !grandportfolio_is_woocommerce_page())
	{
	    $post_type = get_post_type();
	    
	    switch($post_type)
	    {
	    	case 'events':
	    	default:
	    		$page_menu_transparent = 1;	
	    	break;
	    	
	    	case 'post':
			    $page_menu_transparent = get_post_meta($current_page_id, 'post_menu_transparent', true);
			break;
			
	    	case 'galleries':
	    		$page_menu_transparent = 0;	
	    	break; 
	    	
	    	case 'portfolios':
	    		$page_menu_transparent = get_post_meta($current_page_id, 'portfolio_menu_transparent', true);
	    	break;
	    }
	}
	else if(is_single() && empty($pp_page_bg) && !grandportfolio_is_woocommerce_page())
	{
		$page_menu_transparent = 0;	
	}
	
	if(is_search())
	{
	    $page_menu_transparent = 0;
	}
	
	if(is_404())
	{
	    $page_menu_transparent = 0;
	}
	
	$grandportfolio_homepage_style = grandportfolio_get_homepage_style();
	if($grandportfolio_homepage_style == 'fullscreen')
	{
	    $page_menu_transparent = 1;
	}
?>
<div class="top_bar <?php if(!empty($page_menu_transparent)) { ?>hasbg<?php } ?> <?php if(!empty($tg_topbar)) { ?>withtopbar<?php } ?>">
    	
    	<!-- Begin logo -->
    	<div id="logo_wrapper">
    	<?php
    		//Get Soical Icon
			get_template_part("/templates/template-socials");
    	?>
    	
    	<!-- Begin right corner buttons -->
    	<div id="logo_right_button">
    		<?php
				$grandportfolio_page_gallery_id = grandportfolio_get_page_gallery_id();
				
				//Check global sharing option
				$tg_global_sharing = kirki_get_option('tg_global_sharing');
		    			
				if(is_single() OR !empty($grandportfolio_page_gallery_id) OR !empty($tg_global_sharing))
				{
			?>
			<div class="post_share_wrapper">
				<a id="page_share" href="javascript:;"><i class="fa fa-share-alt"></i></a>
			</div>
			<?php
				}
			?>
			
			<?php
			    $post_type = get_post_type();
			    
			    $gallery_download = get_post_meta($current_page_id, 'gallery_download', true);
			    
			    if(is_single() && $post_type == 'galleries' && !empty($gallery_download))
			    {
			?>
			<div class="post_download_wrapper">
			    <a id="gallery_download" class="tooltip" href="<?php echo esc_url($gallery_download); ?>" title="<?php esc_html_e('Download', 'grandportfolio-translation' ); ?>"><i class="fa fa-download"></i></a>
			</div>
			<?php	
			    }
			?>
    	
    		<?php
				if($grandportfolio_homepage_style == 'fullscreen')
				{
			?>
			<div class="view_fullscreen_wrapper">
				<a id="page_maximize" href="javascript:;"><i class="fa fa-expand"></i></a>
				<a id="page_minimize" href="javascript:;"><i class="fa fa-compress"></i></a>
			</div>
			<?php
				}
			?>
			
			<?php
			if (class_exists('Woocommerce')) {
			    //Check if display cart in header
			
			    $woocommerce = grandportfolio_get_woocommerce();
			    $cart_url = $woocommerce->cart->get_cart_url();
			    $cart_count = $woocommerce->cart->cart_contents_count;
			?>
			<div class="header_cart_wrapper">
			    <div class="cart_count"><?php echo esc_html($cart_count); ?></div>
			    <a href="<?php echo esc_url($cart_url); ?>"><i class="fa fa-shopping-cart"></i></a>
			</div>
			<?php
			}
			?>
    	
	    	<!-- Begin side menu -->
			<a href="javascript:;" id="mobile_nav_icon"></a>
			<!-- End side menu -->
			
    	</div>
    	<!-- End right corner buttons -->
    	
    	<?php
    	    //get custom logo
    	    $tg_retina_logo = kirki_get_option('tg_retina_logo');

    	    if(!empty($tg_retina_logo))
    	    {	
    	    	//Get image width and height
		    	$image_id = grandportfolio_get_image_id($tg_retina_logo);
		    	if(!empty($image_id))
		    	{
		    		$obj_image = wp_get_attachment_image_src($image_id, 'original');
		    		
		    		$image_width = 0;
			    	$image_height = 0;
			    	
			    	if(isset($obj_image[1]))
			    	{
			    		$image_width = intval($obj_image[1]/2);
			    	}
			    	if(isset($obj_image[2]))
			    	{
			    		$image_height = intval($obj_image[2]/2);
			    	}
		    	}
		    	else
		    	{
			    	$image_width = 0;
			    	$image_height = 0;
		    	}
    	?>
    	<div id="logo_normal" class="logo_container">
    		<div class="logo_align">
	    	    <a id="custom_logo" class="logo_wrapper <?php if(!empty($page_menu_transparent)) { ?>hidden<?php } else { ?>default<?php } ?>" href="<?php echo esc_url(home_url('/')); ?>">
	    	    	<?php
						if($image_width > 0 && $image_height > 0)
						{
					?>
					<img src="<?php echo esc_url($tg_retina_logo); ?>" alt="<?php esc_attr(get_bloginfo('name')); ?>" width="<?php echo esc_attr($image_width); ?>" height="<?php echo esc_attr($image_height); ?>"/>
					<?php
						}
						else
						{
							list($image_width, $image_height, $image_type, $image_attr) = getimagesize($tg_retina_logo);
							
							$image_width = intval($image_width/2);
							$image_height = intval($image_height/2);
					?>
	    	    	<img src="<?php echo esc_url($tg_retina_logo); ?>" alt="<?php esc_attr(get_bloginfo('name')); ?>" width="<?php echo(esc_attr($image_width)); ?>" height="<?php echo(esc_attr($image_height)); ?>"/>
	    	    	<?php 
		    	    	}
		    	    ?>
	    	    </a>
    		</div>
    	</div>
    	<?php
    	    }
    	?>
    	
    	<?php
    		//get custom logo transparent
    	    $tg_retina_transparent_logo = kirki_get_option('tg_retina_transparent_logo');

    	    if(!empty($tg_retina_transparent_logo))
    	    {
    	    	//Get image width and height
		    	$image_id = grandportfolio_get_image_id($tg_retina_transparent_logo);
		    	if(!empty($image_id))
		    	{
		    		$obj_image = wp_get_attachment_image_src($image_id, 'original');
		    		
		    		$image_width = 0;
			    	$image_height = 0;
			    	
			    	if(isset($obj_image[1]))
			    	{
			    		$image_width = intval($obj_image[1]/2);
			    	}
			    	if(isset($obj_image[2]))
			    	{
			    		$image_height = intval($obj_image[2]/2);
			    	}
		    	}
		    	else
		    	{
			    	$image_width = 0;
			    	$image_height = 0;
		    	}
    	?>
    	<div id="logo_transparent" class="logo_container">
    		<div class="logo_align">
	    	    <a id="custom_logo_transparent" class="logo_wrapper <?php if(empty($page_menu_transparent)) { ?>hidden<?php } else { ?>default<?php } ?>" href="<?php echo esc_url(home_url('/')); ?>">
	    	    	<?php
						if($image_width > 0 && $image_height > 0)
						{
					?>
					<img src="<?php echo esc_url($tg_retina_transparent_logo); ?>" alt="<?php esc_attr(get_bloginfo('name')); ?>" width="<?php echo esc_attr($image_width); ?>" height="<?php echo esc_attr($image_height); ?>"/>
					<?php
						}
						else
						{
							list($image_width, $image_height, $image_type, $image_attr) = getimagesize($tg_retina_transparent_logo);
							
							$image_width = intval($image_width/2);
							$image_height = intval($image_height/2);
					?>
	    	    	<img src="<?php echo esc_url($tg_retina_transparent_logo); ?>" alt="<?php esc_attr(get_bloginfo('name')); ?>" width="<?php echo(esc_attr($image_width)); ?>" height="<?php echo(esc_attr($image_height)); ?>"/>
	    	    	<?php 
		    	    	}
		    	    ?>
	    	    </a>
    		</div>
    	</div>
    	<?php
    	    }
    	?>
    	<!-- End logo -->
    	</div>
        
		<?php
			//Check if enable main menu
			$tg_menu_layout = grandportfolio_menu_layout();
			
			//Check if has custom menu
	        if(is_object($post) && $post->post_type == 'page')
	    	{
	    	    $page_menu = get_post_meta($current_page_id, 'page_menu', true);
	    	}
			
			if($tg_menu_layout == 'centeralign' && has_nav_menu( 'primary-menu' ))
			{
		?>
        <div id="menu_wrapper">
	        <div id="nav_wrapper">
	        	<div class="nav_wrapper_inner">
	        		<div id="menu_border_wrapper">
	        			<?php 	
	        				//Check if has custom menu
	        				if(is_object($post) && $post->post_type == 'page')
	    					{
	    						$page_menu = get_post_meta($current_page_id, 'page_menu', true);
	    					}
	        			
	        				if(empty($page_menu))
	    					{
	    						if ( has_nav_menu( 'primary-menu' ) ) 
	    						{
	    		    			    wp_nav_menu( 
	    		    			        	array( 
	    		    			        		'menu_id'			=> 'main_menu',
	    		    			        		'menu_class'		=> 'nav',
	    		    			        		'theme_location' 	=> 'primary-menu',
	    		    			        		'walker' => new grandportfolio_walker(),
	    		    			        	) 
	    		    			    ); 
	    		    			}
	    		    			else
	    		    			{
	    			    			echo '<div class="notice">'.esc_html__('Setup Menu via Wordpress Dashboard > Appearance > Menus', 'grandportfolio-translation' ).'</div>';
	    		    			}
	    	    			}
	    	    			else
	    				    {
	    				     	if( $page_menu && is_nav_menu( $page_menu ) ) {  
	    						    wp_nav_menu( 
	    						        array(
	    						            'menu' => $page_menu,
	    						            'walker' => new grandportfolio_walker(),
	    						            'menu_id'			=> 'main_menu',
	    		    			        	'menu_class'		=> 'nav',
	    						        )
	    						    );
	    						}
	    				    }
	        			?>
	        		</div>
	        	</div>
	        </div>
	        <!-- End main nav -->
        </div>
        <?php
        	}
        ?>
    </div>
</div>
