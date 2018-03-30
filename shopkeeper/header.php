<?php
	global $shopkeeper_theme_options, $woocommerce, $wp_version;
?>

<!DOCTYPE html>

<!--[if IE 9]>
<html class="ie ie9" <?php language_attributes(); ?>>
<![endif]-->

<html <?php language_attributes(); ?>>

<head>
    <meta charset="<?php bloginfo( 'charset' ); ?>">
    <meta name="viewport" content="width=device-width, initial-scale=1.0, maximum-scale=1.0, user-scalable=no" />
    
    <link rel="profile" href="http://gmpg.org/xfn/11">
    <link rel="pingback" href="<?php bloginfo( 'pingback_url' ); ?>">    
    
    <!-- ******************************************************************** -->
    <!-- * Custom Favicon *************************************************** -->
    <!-- ******************************************************************** -->
    
    <?php
	if ( (isset($shopkeeper_theme_options['favicon']['url'])) && (trim($shopkeeper_theme_options['favicon']['url']) != "" ) ) {
        
        if (is_ssl()) {
            $favicon_image_img = str_replace("http://", "https://", $shopkeeper_theme_options['favicon']['url']);		
        } else {
            $favicon_image_img = $shopkeeper_theme_options['favicon']['url'];
        }
	?>
    
    <!-- ******************************************************************** -->
    <!-- * Favicon ********************************************************** -->
    <!-- ******************************************************************** -->
    
    <link rel="shortcut icon" href="<?php echo esc_url($favicon_image_img); ?>" />
        
    <?php } ?>
    
    <!-- ******************************************************************** -->
    <!-- * Custom Header JavaScript Code ************************************ -->
    <!-- ******************************************************************** -->
    
    <?php if ( (isset($shopkeeper_theme_options['header_js'])) && ($shopkeeper_theme_options['header_js'] != "") ) : ?>
        <?php echo $shopkeeper_theme_options['header_js']; ?>
    <?php endif; ?>

	
    <!-- ******************************************************************** -->
    <!-- * WordPress wp_head() ********************************************** -->
    <!-- ******************************************************************** -->
    
    <?php wp_head(); ?>
</head>

<body <?php body_class(); ?>>

	<div id="st-container" class="st-container">

        <div class="st-pusher">
            
            <div class="st-pusher-after"></div>   
                
                <div class="st-content">

                    
                    <?php

					$header_sticky_class = "";
					$header_transparency_class = "";
					$transparency_scheme = "";
					
					if ( (isset($shopkeeper_theme_options['sticky_header'])) && ($shopkeeper_theme_options['sticky_header'] == "1" ) ) {
						$header_sticky_class = "sticky_header";
					}
					
					if ( (isset($shopkeeper_theme_options['main_header_transparency'])) && ($shopkeeper_theme_options['main_header_transparency'] == "1" ) ) {
						$header_transparency_class = "transparent_header";
					}
					
					if ( (isset($shopkeeper_theme_options['main_header_transparency_scheme'])) ) {
						$transparency_scheme = $shopkeeper_theme_options['main_header_transparency_scheme'];
					}
					
					$page_id = "";
					if ( is_single() || is_page() ) {
						$page_id = get_the_ID();
					} else if ( is_home() ) {
						$page_id = get_option('page_for_posts');		
					}
					
					if ( (get_post_meta($page_id, 'page_header_transparency', true)) && (get_post_meta($page_id, 'page_header_transparency', true) != "inherit") ) {
						$header_transparency_class = "transparent_header";
						$transparency_scheme = get_post_meta( $page_id, 'page_header_transparency', true );
					}
					
					if ( (get_post_meta($page_id, 'page_header_transparency', true)) && (get_post_meta($page_id, 'page_header_transparency', true) == "no_transparency") ) {
						$header_transparency_class = "";
						$transparency_scheme = "";
					}

					if (class_exists('WooCommerce')) 
                    {
                        if ( is_product_category() && is_woocommerce() )
                        {
                        	if ( $shopkeeper_theme_options['shop_category_header_transparency_scheme'] == 'inherit' )
                        	{
                        		// do nothing, inherit
                        	}
                        	else if ( $shopkeeper_theme_options['shop_category_header_transparency_scheme'] == 'no_transparency' )
                        	{
                        		$header_transparency_class = "";
								$transparency_scheme = "";
                        	}
                        	else 
                        	{
	                            $header_transparency_class = "transparent_header";
	                            $transparency_scheme = $shopkeeper_theme_options['shop_category_header_transparency_scheme'];
                        	}
                        }
                    }
					
					/*if ( is_shop() ) {
						$header_transparency_class = "";
					}*/
					
					?>
                    
                    <div id="page_wrapper" class="<?php echo $header_sticky_class; ?> <?php echo $header_transparency_class; ?> <?php echo $transparency_scheme; ?>">
                    
                        <?php do_action( 'before' ); ?>                     
                        
                        <?php
    
						$header_max_width_style = "100%";
						if ( (isset($shopkeeper_theme_options['header_width'])) && ($shopkeeper_theme_options['header_width'] == "custom") ) {
							$header_max_width_style = $shopkeeper_theme_options['header_max_width']."px";
						} else {
							$header_max_width_style = "100%";
						}
						
						?>
                        
                        <div class="top-headers-wrapper">
						
                            <?php if ( (isset($shopkeeper_theme_options['top_bar_switch'])) && ($shopkeeper_theme_options['top_bar_switch'] == "1" ) ) : ?>                        
                                <?php include(locate_template('header-topbar.php')); ?>						
                            <?php endif; ?>
                            
                            <?php if ( isset($shopkeeper_theme_options['main_header_layout']) ) : ?>
								
								<?php if ( $shopkeeper_theme_options['main_header_layout'] == "1" ) : ?>
									<?php include(locate_template('header-default.php')); ?>
                                <?php elseif ( $shopkeeper_theme_options['main_header_layout'] == "2" ) : ?>
                                	<?php include(locate_template('header-centered-2menus.php')); ?>
                                <?php elseif ( $shopkeeper_theme_options['main_header_layout'] == "3" ) : ?>
                                	<?php include(locate_template('header-centered-menu-under.php')); ?>
								<?php endif; ?>
                                
                            <?php else : ?>
                            
                            	<?php include(locate_template('header-default.php')); ?>
                            
                            <?php endif; ?>
                        
                        </div>
						
						