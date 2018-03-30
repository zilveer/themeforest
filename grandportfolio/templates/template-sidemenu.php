<?php 
    //Working on page transparent logic

	//Get page ID
	if(is_object($post))
	{
	    $page = get_page($post->ID);
	}
	$current_page_id = '';
	
	if(isset($page->ID))
	{
	    $current_page_id = $page->ID;
	}
	elseif(is_home())
	{
	    $current_page_id = get_option('page_on_front');
	}
	
    //If enable menu transparent
    $page_menu_transparent = 0;
    
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
    
    $grandportfolio_homepage_style = grandportfolio_get_homepage_style();
	
	if($grandportfolio_homepage_style == 'fullscreen')
    {
        $page_menu_transparent = 1;
    }
    
    if(is_search())
    {
	    $page_menu_transparent = 0;
    }
    
    if(is_category())
    {
	    $page_menu_transparent = 0;
    }
    
    if(is_404())
    {
	    $page_menu_transparent = 0;
    }
?>

<!-- Begin mobile menu -->
<a id="close_mobile_menu" href="javascript:;"></a>

<div class="mobile_menu_wrapper">
	<?php
		//Get side menu layout
		$tg_sidemenu_layout = kirki_get_option('tg_sidemenu_layout');
		
		if($tg_sidemenu_layout == 'menu_widgets')
		{
	?>

    <?php
    	//Get main menu layout
		$tg_menu_layout = grandportfolio_menu_layout();
    
	    //Check if display search in header	
	    $tg_menu_search = kirki_get_option('tg_menu_search');
	    if($tg_menu_layout == 'leftmenu')
	    {
    	    $tg_menu_search = 0;
	    }
	    
	    if(!empty($tg_menu_search))
	    {
	?>
	<form method="get" name="searchform" id="searchform" action="<?php echo esc_url(home_url('/')); ?>/">
	    <div>
	    	<input type="text" value="<?php the_search_query(); ?>" name="s" id="s" autocomplete="off" placeholder="<?php esc_html_e('Search...', 'grandportfolio-translation' ); ?>"/>
	    	<button>
	        	<i class="fa fa-search"></i>
	        </button>
	    </div>
	    <div id="autocomplete"></div>
	</form>
	<?php
	    }
	?>
	
	<?php
		//If left menu then display logo
		if($tg_menu_layout == 'leftmenu')
	    {
	    	$page_menu_transparent = 0;
    	    
    	    if($grandportfolio_homepage_style == 'fullscreen')
    	    {
    	        $page_menu_transparent = 1;
    	    }
	?>
	
	<?php
	if(empty($page_menu_transparent))
	{
	    //get custom logo
	    $tg_retina_logo = kirki_get_option('tg_retina_logo');

	    if(!empty($tg_retina_logo))
	    {	
	    	//Get image width and height
        	$image_id = grandportfolio_get_image_id($tg_retina_logo);
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
	?>
	<div class="logo_container">
		<div class="logo_align">
    	    <a class="logo_wrapper <?php if(!empty($page_menu_transparent)) { ?>hidden<?php } else { ?>default<?php } ?>" href="<?php echo esc_url(home_url('/')); ?>">
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
    	    	<img src="<?php echo esc_url($tg_retina_logo); ?>" alt="<?php esc_attr(get_bloginfo('name')); ?>" width="<?php echo esc_attr($image_width); ?>" height="<?php echo esc_attr($image_height); ?>"/>
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
	<?php
	}
	else
	{
        //get custom logo transparent
        $tg_retina_transparent_logo = kirki_get_option('tg_retina_transparent_logo');

        if(!empty($tg_retina_transparent_logo))
        {
        	//Get image width and height
	    	$image_id = grandportfolio_get_image_id($tg_retina_transparent_logo);
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
	    		?>
	        	<img src="<?php echo esc_url($tg_retina_transparent_logo); ?>" alt="<?php esc_attr(get_bloginfo('name')); ?>" width="48" height="58"/>
	        	<?php 
	    	    	}
	    	    ?>
	        </a>
        </div>
    </div>
    <?php
        }
	}
	?>
	
	<?php
	} //End if left menu
	?>
	
	<?php
	} //End if menu widgets layout
	?>
	
    <?php 
    	//Check if has custom menu
    	if(is_object($post) && $post->post_type == 'page')
    	{
    	    $page_menu = get_post_meta($post->ID, 'page_menu', true);
    	}	
    	
    	if ( has_nav_menu( 'side-menu' ) ) 
    	{
    		//If using menu widgets layout
	    	if($tg_sidemenu_layout == 'menu_widgets')
			{
	    	    wp_nav_menu( 
	    	        array( 
	    	            'menu_id'			=> 'mobile_main_menu',
	                    'menu_class'		=> 'mobile_main_nav',
	    	            'theme_location' 	=> 'side-menu',
	    	        )
	    	    ); 
	    	}
	    	else
	    	{
	    		$tg_walker = new Grandportfolio_Menu_With_Description;
	    	
		    	wp_nav_menu( 
	    	        array( 
	    	        	'container_class' 	=> 'mobile_menu_content',
	    	            'menu_id'			=> 'mobile_main_menu',
	                    'menu_class'		=> 'mobile_main_nav',
	    	            'theme_location' 	=> 'side-menu',
	    	            'walker' 			=> $tg_walker
	    	        )
	    	    ); 
	    	}
    	}
    ?>
    
    <?php
    	//If using menu widgets layout
    	if($tg_sidemenu_layout == 'menu_widgets')
		{
    ?>
    <!-- Begin side menu sidebar -->
    <div class="page_content_wrapper">
    	<div class="sidebar_wrapper">
            <div class="sidebar">
            
            	<div class="content">
            
            		<ul class="sidebar_widget">
            		<?php dynamic_sidebar('Side Menu Sidebar'); ?>
            		</ul>
            	
            	</div>
        
            </div>
    	</div>
    </div>
    <!-- End side menu sidebar -->
    <?php
	} //End if menu widgets layout
	?>
</div>
<?php
	$grandportfolio_page_menu_transparent = grandportfolio_get_page_menu_transparent();
	grandportfolio_set_page_menu_transparent($page_menu_transparent);
?>
<!-- End mobile menu -->