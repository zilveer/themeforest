<?php	
	global $mr_tailor_theme_options;
	global $woocommerce;
    global $wp_version;
?>
<!DOCTYPE html>
<html class="no-js" <?php language_attributes(); ?>>

<head>
    <meta charset="<?php bloginfo( 'charset' ); ?>">
    <meta name="viewport" content="width=device-width, initial-scale=1.0, maximum-scale=1.0, user-scalable=no" />
    
    <!-- ******************************************************************** -->
    <!-- * Title ************************************************************ -->
    <!-- ******************************************************************** -->
    
    <title><?php wp_title( '|', true, 'right' ); ?></title>
    
    <link rel="profile" href="http://gmpg.org/xfn/11">
    <link rel="pingback" href="<?php bloginfo( 'pingback_url' ); ?>">
    
    <!-- ******************************************************************** -->
    <!-- * Custom Favicon *************************************************** -->
    <!-- ******************************************************************** -->
    
    <?php
	if ( (isset($mr_tailor_theme_options['favicon']['url'])) && (trim($mr_tailor_theme_options['favicon']['url']) != "" ) ) {
        
        if (is_ssl()) {
            $favicon_image_img = str_replace("http://", "https://", $mr_tailor_theme_options['favicon']['url']);		
        } else {
            $favicon_image_img = $mr_tailor_theme_options['favicon']['url'];
        }
	?>
    
    <!-- ******************************************************************** -->
    <!-- * Favicon ********************************************************** -->
    <!-- ******************************************************************** -->
    
    <link rel="shortcut icon" href="<?php echo $favicon_image_img; ?>" type="image/x-icon" />
        
    <?php } ?>
    
    <!-- ******************************************************************** -->
    <!-- * Custom Header JavaScript Code ************************************ -->
    <!-- ******************************************************************** -->
    
    <?php if ( (isset($mr_tailor_theme_options['header_js'])) && ($mr_tailor_theme_options['header_js'] != "") ) : ?>
		<script type="text/javascript">
			<?php echo $mr_tailor_theme_options['header_js']; ?>
		</script>
    <?php endif; ?>

    <!-- ******************************************************************** -->
    <!-- * Sticky header for mobiles **************************************** -->
    <!-- ******************************************************************** -->
    
    <?php if ( (isset($mr_tailor_theme_options['sticky_header'])) ) : ?>
        <script type="text/javascript">
            var stickyHeader = <?php echo $mr_tailor_theme_options['sticky_header']; ?>;
        </script>
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

					$header_transparency_class = "";
					$transparency_scheme = "";
					
					if ( (isset($mr_tailor_theme_options['main_header_background_transparency'])) && ($mr_tailor_theme_options['main_header_background_transparency'] == "1" ) ) {
						$header_transparency_class = "transparent_header";
					} else {
                        $header_transparency_class = "normal_header";
                    }
					
					if ( (isset($mr_tailor_theme_options['main_header_transparency_scheme'])) ) {
						$transparency_scheme = $mr_tailor_theme_options['main_header_transparency_scheme'];
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

					} else {
                        $header_transparency_class = "normal_header";
                        $transparency_scheme = "";
                    }
					
					if ( (get_post_meta($page_id, 'page_header_transparency', true)) && (get_post_meta($page_id, 'page_header_transparency', true) == "no_transparency") ) {
						$header_transparency_class = "normal_header";
						$transparency_scheme = "";
					}

                    if (class_exists('WooCommerce')) 
                    {
                        if (is_shop())
                        {
                            if ( (get_post_meta(get_option( 'woocommerce_shop_page_id' ), 'page_header_transparency', true)) && (get_post_meta(get_option( 'woocommerce_shop_page_id' ), 'page_header_transparency', true) != "inherit") ) {
                                $header_transparency_class = "transparent_header";
                                $transparency_scheme = get_post_meta( get_option( 'woocommerce_shop_page_id' ), 'page_header_transparency', true );

                            } else {
                                $header_transparency_class = "normal_header";
                                $transparency_scheme = "";
                            }
                            
                            if ( (get_post_meta(get_option( 'woocommerce_shop_page_id' ), 'page_header_transparency', true)) && (get_post_meta(get_option( 'woocommerce_shop_page_id' ), 'page_header_transparency', true) == "no_transparency") ) {
                                $header_transparency_class = "normal_header";
                                $transparency_scheme = "";
                            }
                        }

                        if ( is_product_category() && is_woocommerce() )
                        {
                            // die('here');

                            if ( $mr_tailor_theme_options['shop_category_header_transparency_scheme'] == 'inherit' )
                            {
                                // do nothing, inherit
                            }
                            else if ( $mr_tailor_theme_options['shop_category_header_transparency_scheme'] == 'no_transparency' )
                            {
                                $header_transparency_class = "";
                                $transparency_scheme = "";
                            }
                            else 
                            {
                                $header_transparency_class = "transparent_header";
                                $transparency_scheme = $mr_tailor_theme_options['shop_category_header_transparency_scheme'];
                            }
                        }
                    }
					
					?>
                    
                    <div id="page" class="<?php echo $header_transparency_class; ?> <?php echo $transparency_scheme; ?>">
                    
                        <?php do_action( 'before' ); ?>
                        
                        <div class="top-headers-wrapper">
						
							<?php if ( (!isset($mr_tailor_theme_options['top_bar_switch'])) || ($mr_tailor_theme_options['top_bar_switch'] == "1" ) ) : ?>                        
                                <?php include_once('header-topbar.php'); ?>
                            <?php endif; ?>                      
                            
                            <?php
                            
							if ( (isset($mr_tailor_theme_options['header_layout'])) && ($mr_tailor_theme_options['header_layout'] == "0" ) ) {
								include_once('header-default.php');
							} else {
								include_once('header-centered.php');
							}
							
							?>
                        
                        </div>
                        
                        <?php if (function_exists('wc_print_notices')) : ?>
                        <?php wc_print_notices(); ?>
                        <?php endif; ?>
