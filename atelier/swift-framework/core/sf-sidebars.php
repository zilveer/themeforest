<?php

    /*
    *
    *	Swift Framework Sidebar Functions
    *	------------------------------------------------
    *	Swift Framework v3.0
    * 	Copyright Swift Ideas 2016 - http://www.swiftideas.com
    *
    *	sf_setup_sidebars()
    *	sf_sidebars_array()
    *	sf_set_sidebar_global()
    *
    */

    /* REGISTER SIDEBARS
    ================================================== */
    if ( ! function_exists( 'sf_register_sidebars' ) ) {
        function sf_register_sidebars() {
            if ( function_exists( 'register_sidebar' ) ) {

                $current_theme = get_option( 'sf_theme');
                $current_theme_opts = 'sf_' . $current_theme . '_options';

                $sf_options    = get_option( $current_theme_opts );
                $footer_config = $sf_options['footer_layout'];
                $enable_global_banner = false;
                $gb_layout = '';
                if ( isset( $sf_options['enable_global_banner'] ) ) {
	                $enable_global_banner = $sf_options['enable_global_banner'];
	                $gb_layout 			  = $sf_options['global_banner_layout'];
                }
                $sidebar_before_title = apply_filters( 'sf_sidebar_before_title', '<div class="widget-heading title-wrap clearfix"><h4 class="spb-heading"><span>' );
                $sidebar_after_title = apply_filters( 'sf_sidebar_after_title', '</span></h4></div>' );
				$footer_before_title = apply_filters( 'sf_footer_before_title', '<div class="widget-heading title-wrap clearfix"><h6>' );
				$footer_after_title = apply_filters( 'sf_footer_after_title', '</h6></div>' );
				$gb_before_title 	= apply_filters( 'sf_gb_before_title', '<div class="widget-heading title-wrap clearfix"><h6>' );
				$gb_after_title 	= apply_filters( 'sf_gb_after_title', '</h6></div>' );


                register_sidebar( array(
                    'name'          => 'Sidebar One',
                    'id'			=> 'sidebar-1',
                    'description'   => 'This widget area can be selected in the page/post/product meta options, and also in the theme options panel - so that you can display it on pages of your choice.',
                    'before_widget' => '<section id="%1$s" class="widget %2$s clearfix">',
                    'after_widget'  => '</section>',
                    'before_title'  => $sidebar_before_title,
                    'after_title'   => $sidebar_after_title,
                ) );
                register_sidebar( array(
                    'name'          => 'Sidebar Two',
                    'id'			=> 'sidebar-2',
                    'description'   => 'This widget area can be selected in the page/post/product meta options, and also in the theme options panel - so that you can display it on pages of your choice.',
                    'before_widget' => '<section id="%1$s" class="widget %2$s clearfix">',
                    'after_widget'  => '</section>',
                    'before_title'  => $sidebar_before_title,
                    'after_title'   => $sidebar_after_title,
                ) );
                register_sidebar( array(
                    'name'          => 'Sidebar Three',
                    'id'			=> 'sidebar-3',
                    'description'   => 'This widget area can be selected in the page/post/product meta options, and also in the theme options panel - so that you can display it on pages of your choice.',
                    'before_widget' => '<section id="%1$s" class="widget %2$s clearfix">',
                    'after_widget'  => '</section>',
                    'before_title'  => $sidebar_before_title,
                    'after_title'   => $sidebar_after_title,
                ) );
                register_sidebar( array(
                    'name'          => 'Sidebar Four',
                    'id'			=> 'sidebar-4',
                    'description'   => 'This widget area can be selected in the page/post/product meta options, and also in the theme options panel - so that you can display it on pages of your choice.',
                    'before_widget' => '<section id="%1$s" class="widget %2$s clearfix">',
                    'after_widget'  => '</section>',
                    'before_title'  => $sidebar_before_title,
                    'after_title'   => $sidebar_after_title,
                ) );
                register_sidebar( array(
                    'name'          => 'Sidebar Five',
                    'id'			=> 'sidebar-5',
                    'description'   => 'This widget area can be selected in the page/post/product meta options, and also in the theme options panel - so that you can display it on pages of your choice.',
                    'before_widget' => '<section id="%1$s" class="widget %2$s clearfix">',
                    'after_widget'  => '</section>',
                    'before_title'  => $sidebar_before_title,
                    'after_title'   => $sidebar_after_title,
                ) );
                register_sidebar( array(
                    'name'          => 'Sidebar Six',
                    'id'			=> 'sidebar-6',
                    'description'   => 'This widget area can be selected in the page/post/product meta options, and also in the theme options panel - so that you can display it on pages of your choice.',
                    'before_widget' => '<section id="%1$s" class="widget %2$s clearfix">',
                    'after_widget'  => '</section>',
                    'before_title'  => $sidebar_before_title,
                    'after_title'   => $sidebar_after_title,
                ) );
                register_sidebar( array(
                    'name'          => 'Sidebar Seven',
                    'id'			=> 'sidebar-7',
                    'description'   => 'This widget area can be selected in the page/post/product meta options, and also in the theme options panel - so that you can display it on pages of your choice.',
                    'before_widget' => '<section id="%1$s" class="widget %2$s clearfix">',
                    'after_widget'  => '</section>',
                    'before_title'  => $sidebar_before_title,
                    'after_title'   => $sidebar_after_title,
                ) );
                register_sidebar( array(
                    'name'          => 'Sidebar Eight',
                    'id'			=> 'sidebar-8',
                    'description'   => 'This widget area can be selected in the page/post/product meta options, and also in the theme options panel - so that you can display it on pages of your choice.',
                    'before_widget' => '<section id="%1$s" class="widget %2$s clearfix">',
                    'after_widget'  => '</section>',
                    'before_title'  => $sidebar_before_title,
                    'after_title'   => $sidebar_after_title,
                ) );
                register_sidebar( array(
                    'id'            => 'footer-column-1',
                    'name'          => 'Footer Column 1',
                    'description'   => 'This widget area is used to display widgets in the footer. You can select the amount of footer columns in the theme options panel.',
                    'before_widget' => '<section id="%1$s" class="widget %2$s clearfix">',
                    'after_widget'  => '</section>',
                    'before_title'  => $footer_before_title,
                    'after_title'   => $footer_after_title,
                ) );
                if ( $footer_config != "footer-9" ) {
                    register_sidebar( array(
                        'id'            => 'footer-column-2',
                        'name'          => 'Footer Column 2',
                        'description'   => 'This widget area is used to display widgets in the footer. You can select the amount of footer columns in the theme options panel.',
                        'before_widget' => '<section id="%1$s" class="widget %2$s clearfix">',
                        'after_widget'  => '</section>',
                        'before_title'  => $footer_before_title,
                        'after_title'   => $footer_after_title,
                    ) );
                    register_sidebar( array(
                        'id'            => 'footer-column-3',
                        'name'          => 'Footer Column 3',
                        'description'   => 'This widget area is used to display widgets in the footer. You can select the amount of footer columns in the theme options panel.',
                        'before_widget' => '<section id="%1$s" class="widget %2$s clearfix">',
                        'after_widget'  => '</section>',
                        'before_title'  => $footer_before_title,
                        'after_title'   => $footer_after_title,
                    ) );
                }
                if ( $footer_config == "footer-1" ) {
                    register_sidebar( array(
                        'id'            => 'footer-column-4',
                        'name'          => 'Footer Column 4',
                        'description'   => 'This widget area is used to display widgets in the footer. You can select the amount of footer columns in the theme options panel.',
                        'before_widget' => '<section id="%1$s" class="widget %2$s clearfix">',
                        'after_widget'  => '</section>',
                        'before_title'  => $footer_before_title,
                        'after_title'   => $footer_after_title,
                    ) );
                }

                if ( class_exists( 'woocommerce' ) ) {

	                register_sidebar( array(
	                    'id'            => 'woocommerce-sidebar',
	                    'name'          => 'WooCommerce Sidebar',
	                    'description'   => 'This widget area is for you to use as a specialised WooCommerce widget area. You can select this widget area to be used in the Theme Options > WooCommerce Options panels, and also in the product meta options.',
	                    'before_widget' => '<section id="%1$s" class="widget %2$s clearfix">',
	                    'after_widget'  => '</section>',
	                    'before_title'  => $sidebar_before_title,
	                    'after_title'   => $sidebar_after_title,
	                ) );

	                if ( sf_theme_supports( 'mobile-shop-filters' ) ) {
	                	
	                	$woocommerce_filters_column_class = apply_filters( 'sf_woocommerce_mobile_filters_column_class' , 'col-sm-3' );

		                register_sidebar( array(
		                    'id'            => 'mobile-woocommerce-filters',
		                    'name'          => 'WooCommerce Filters',
		                    'description'   => 'This widget area is for you to use to display widgets in the Filters area of the shop display.',
		                    'before_widget' => '<section id="%1$s" class="widget %2$s '.$woocommerce_filters_column_class.' clearfix">',
		                    'after_widget'  => '</section>',
		                    'before_title'  => $sidebar_before_title,
		                    'after_title'   => $sidebar_after_title,
		                ) );

	                }

                }

                if ( class_exists( 'ATCF_CrowdFunding' ) ) {

	                register_sidebar( array(
	                    'id'            => 'crowdfunding-sidebar',
	                    'name'          => 'Crowdfunding Sidebar',
	                    'description'   => 'This widget area is for you to use as a specialised Crowdfunding widget area. The widgets added here will be shown on Crowdfunding pages.',
	                    'before_widget' => '<section id="%1$s" class="widget %2$s clearfix">',
	                    'after_widget'  => '</section>',
	                    'before_title'  => $sidebar_before_title,
	                    'after_title'   => $sidebar_after_title,
	                ) );

                }

                if ( class_exists( 'TribeEvents' ) ) {

                	register_sidebar( array(
                	    'id'            => 'events-sidebar-left',
                	    'name'          => 'Events Sidebar Left',
                	    'description'   => 'This widget area is for you to use as a specialised Events Calendar widget area. The widgets added here will be shown on templates dedicated for use on events pages.',
                	    'before_widget' => '<section id="%1$s" class="widget %2$s clearfix">',
                	    'after_widget'  => '</section>',
                	    'before_title'  => $sidebar_before_title,
                	    'after_title'   => $sidebar_after_title,
                	) );

                	register_sidebar( array(
                	    'id'            => 'events-sidebar-right',
                	    'name'          => 'Events Sidebar Right',
                	    'description'   => 'This widget area is for you to use as a specialised Events Calendar widget area. The widgets added here will be shown on templates dedicated for use on events pages.',
                	    'before_widget' => '<section id="%1$s" class="widget %2$s clearfix">',
                	    'after_widget'  => '</section>',
                	    'before_title'  => $sidebar_before_title,
                	    'after_title'   => $sidebar_after_title,
                	) );

                }

                if ( $enable_global_banner ) {

		            register_sidebar( array(
	                    'id'            => 'gb-column-1',
	                    'name'          => 'Global Banner Column 1',
	                    'description'   => 'This widget area is used to display widgets in the global banner. You can select the amount of columns in the theme options panel.',
	                    'before_widget' => '<section id="%1$s" class="widget %2$s clearfix">',
	                    'after_widget'  => '</section>',
	                    'before_title'  => $gb_before_title,
	                    'after_title'   => $gb_after_title,
	                ) );
	                if ( $gb_layout != "gb-9" ) {
	                    register_sidebar( array(
	                        'id'            => 'gb-column-2',
	                        'name'          => 'Global Banner Column 2',
	                        'description'   => 'This widget area is used to display widgets in the global banner. You can select the amount of columns in the theme options panel.',
	                        'before_widget' => '<section id="%1$s" class="widget %2$s clearfix">',
	                        'after_widget'  => '</section>',
	                        'before_title'  => $gb_before_title,
	                        'after_title'   => $gb_after_title,
	                    ) );
	                }
	                if ( $gb_layout != "gb-4" && $gb_layout != "gb-6" && $gb_layout != "gb-7" && $gb_layout != "gb-9" ) {
	                    register_sidebar( array(
	                        'id'            => 'gb-column-3',
	                        'name'          => 'Global Banner Column 3',
	                        'description'   => 'This widget area is used to display widgets in the global banner. You can select the amount of columns in the theme options panel.',
	                        'before_widget' => '<section id="%1$s" class="widget %2$s clearfix">',
	                        'after_widget'  => '</section>',
	                        'before_title'  => $gb_before_title,
	                        'after_title'   => $gb_after_title,
	                    ) );
	                }
	                if ( $gb_layout == "gb-1" ) {
	                    register_sidebar( array(
	                        'id'            => 'gb-column-4',
	                        'name'          => 'Global Banner Column 4',
	                        'description'   => 'This widget area is used to display widgets in the global banner. You can select the amount of columns in the theme options panel.',
	                        'before_widget' => '<section id="%1$s" class="widget %2$s clearfix">',
	                        'after_widget'  => '</section>',
	                        'before_title'  => $gb_before_title,
	                        'after_title'   => $gb_after_title,
	                    ) );
	                }

                }
            }
        }

        add_action( 'widgets_init', 'sf_register_sidebars', 0 );
    }


    /* GET SIDEBARS ARRAY
    ================================================== */
    function sf_sidebars_array() {
        $sidebars = array();

        foreach ( $GLOBALS['wp_registered_sidebars'] as $sidebar ) {
            $sidebars[ ucwords( $sidebar['id'] ) ] = $sidebar['name'];
        }

        return $sidebars;
    }


    /* SET SIDEBAR GLOBAL
    ================================================== */
    function sf_set_sidebar_global( $sidebar_config ) {
        global $sf_sidebar_config;
        if ( ( $sidebar_config == "left-sidebar" ) || ( $sidebar_config == "right-sidebar" ) ) {
            $sf_sidebar_config = 'one-sidebar';
        } else if ( $sidebar_config == "both-sidebars" ) {
            $sf_sidebar_config = 'both-sidebars';
        } else {
            $sf_sidebar_config = 'no-sidebars';
        }
    }
    
    
    /* CHECK SIDEBAR IS ACTIVE
    ================================================== */
    function sf_is_sidebar_active( $index ) {
        global $wp_registered_sidebars;
        $widgetcolums = wp_get_sidebars_widgets();
        if (isset($widgetcolums[$index]) && $widgetcolums[$index]) {
            return true;
        } else {
        	return false;
        }
    }
    
    
    /* RETURN SIDEBAR
    ================================================== */
    if ( !function_exists('sf_get_dynamic_sidebar') ) {
    	function sf_get_dynamic_sidebar($index) {
		    $sidebar_contents = "";
		    ob_start();
		    dynamic_sidebar($index);
		    $sidebar_contents = ob_get_clean();
		    return $sidebar_contents;
    	}
    }

?>
