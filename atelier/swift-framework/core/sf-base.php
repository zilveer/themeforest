<?php

    /*
    *
    *	Swift Base Layout Functions
    *	------------------------------------------------
    *	Swift Framework v3.0
    * 	Copyright Swift Ideas 2016 - http://www.swiftideas.com
    *
    *	sf_base_layout()
    *	sf_base_sidebar()
    *
    */

    /* BASE LAYOUT OUTPUT
    ================================================== */
    if ( ! function_exists( 'sf_base_layout' ) ) {
        function sf_base_layout( $template, $type = "" ) {

            global $post, $sf_options;
            $sidebar_var           = sf_base_sidebar($type);
            $sidebar_config        = $sidebar_var['config'];
            $left_sidebar          = $sidebar_var['left'];
            $right_sidebar         = $sidebar_var['right'];
            $page_wrap_class       = $sidebar_var['page_wrap_class'];
            $remove_bottom_spacing = $remove_top_spacing = $sidebar_progress_menu = "";
			$pb_fw_mode = true;
			$pb_active = false;
			if ( $post ) {
				$pb_active = sf_get_post_meta($post->ID, '_spb_js_status', true);
			}
			if ($sidebar_config != "no-sidebars" || $pb_active != "true") {
				$pb_fw_mode = false;
			}

            if ( $post && !is_search() && is_singular() ) {
                $remove_bottom_spacing = sf_get_post_meta( $post->ID, 'sf_no_bottom_spacing', true );
                $remove_top_spacing    = sf_get_post_meta( $post->ID, 'sf_no_top_spacing', true );
            	$sidebar_progress_menu = sf_get_post_meta( $post->ID, 'sf_sidebar_progress_menu', true );
            }

            if ( $remove_bottom_spacing ) {
                $page_wrap_class .= ' no-bottom-spacing';
            }
            if ( $remove_top_spacing ) {
                $page_wrap_class .= ' no-top-spacing';
            }
            if ( $sidebar_progress_menu == "left-sidebar" || $sidebar_progress_menu == "right-sidebar" ) {
            	$pb_fw_mode = false;
            }
            
            $cont_width = $sidebar_width = "";
			if ($sf_options['sidebar_width'] == "reduced") {
				$cont_width = apply_filters("sf_base_layout_cont_width_reduced", "col-sm-9");
				$sidebar_width = apply_filters("sf_base_layout_cont_width_reduced_sidebar", "col-sm-3");
			} else {
				$cont_width = apply_filters("sf_base_layout_cont_width", "col-sm-8");
				$sidebar_width = apply_filters("sf_base_layout_cont_width_sidebar", "col-sm-4");
			}

            ?>

        <?php if ( !$remove_top_spacing ) {
	        	if ($pb_fw_mode || $sidebar_config != "no-sidebars") { ?>
					<div class="content-divider-wrap container"><div class="content-divider sf-elem-bb"></div></div>
				<?php } else { ?>
					<div class="content-divider-wrap"><div class="content-divider sf-elem-bb"></div></div>
				<?php }
			} ?>

        <div class="inner-page-wrap <?php echo esc_attr($page_wrap_class); ?> clearfix">

            <!-- OPEN page -->
            <?php if ( $sidebar_config == "left-sidebar" ) { ?>
            <div class="<?php echo esc_attr($cont_width); ?> push-right clearfix">
            <?php } else if ($sidebar_config == "right-sidebar") { ?>
            <div class="<?php echo esc_attr($cont_width); ?> clearfix">
            <?php } else if ($sidebar_config == "both-sidebars") { ?>
            <div class="col-sm-9 clearfix">
            <?php } else { ?>
            <div class="clearfix">
        <?php } ?>

            <?php if ( $sidebar_config == "both-sidebars" ) { ?>
                <div class="row">

                    <div class="page-content col-sm-8 hfeed clearfix">

                        <?php sf_get_template( $template, $type ); ?>

                    </div>

                    <aside class="sidebar left-sidebar col-sm-4">

                        <?php do_action( 'sf_before_sidebar' ); ?>
                        <?php do_action( 'sf_before_left_sidebar' ); ?>

                        <div class="sidebar-widget-wrap sticky-widget">
                            <?php dynamic_sidebar( $left_sidebar ); ?>
                        </div>

                        <?php do_action( 'sf_after_sidebar' ); ?>

                    </aside>

                </div>
            <?php } else { ?>

                <div class="page-content hfeed clearfix">

                    <?php sf_get_template( $template, $type ); ?>

                </div>

            <?php } ?>

            <!-- CLOSE page -->
            </div>

            <?php if ( $sidebar_config == "left-sidebar" ) { ?>

                <aside class="sidebar left-sidebar <?php echo esc_attr($sidebar_width); ?>">

                    <?php do_action( 'sf_before_sidebar' ); ?>
                    <?php do_action( 'sf_before_left_sidebar' ); ?>

                    <div class="sidebar-widget-wrap sticky-widget">
                        <?php dynamic_sidebar( $left_sidebar ); ?>
                    </div>

                    <?php do_action( 'sf_after_sidebar' ); ?>

                </aside>

            <?php } else if ( $sidebar_config == "right-sidebar" ) { ?>

                <aside class="sidebar right-sidebar <?php echo esc_attr($sidebar_width); ?>">

                    <?php do_action( 'sf_before_sidebar' ); ?>
                    <?php do_action( 'sf_before_right_sidebar' ); ?>

                    <div class="sidebar-widget-wrap sticky-widget">
                        <?php dynamic_sidebar( $right_sidebar ); ?>
                    </div>

                    <?php do_action( 'sf_after_sidebar' ); ?>

                </aside>

            <?php } else if ( $sidebar_config == "both-sidebars" ) { ?>


                <aside class="sidebar right-sidebar col-sm-3">

                    <?php do_action( 'sf_before_sidebar' ); ?>
                    <?php do_action( 'sf_before_right_sidebar' ); ?>

                    <div class="sidebar-widget-wrap sticky-widget">
                        <?php dynamic_sidebar( $right_sidebar ); ?>
                    </div>

                    <?php do_action( 'sf_after_sidebar' ); ?>

                </aside>

            <?php } ?>

            </div>

        <?php
        }
    }


    /* SIDEBAR CONFIG OUTPUT
    ================================================== */
    if ( ! function_exists( 'sf_base_sidebar' ) ) {
        function sf_base_sidebar($type) {

            // VARIABLES
            global $post, $sf_options;

            // DEFAULT SIDEBAR CONFIG
            $default_sidebar_config = $sf_options['default_sidebar_config'];
            $default_left_sidebar   = $sf_options['default_left_sidebar'];
            $default_right_sidebar  = $sf_options['default_right_sidebar'];
            $buddypress             = sf_is_buddypress();
            $bbpress                = sf_is_bbpress();
            $sidebar_config         = $left_sidebar = $right_sidebar = $sidebar_progress_menu = "";

            // ARCHIVE / CATEGORY SIDEBAR CONFIG
            if ( is_search() || is_archive() || is_author() || is_category() || is_home() ) {
                $default_sidebar_config = $sf_options['archive_sidebar_config'];
                $default_left_sidebar   = $sf_options['archive_sidebar_left'];
                $default_right_sidebar  = $sf_options['archive_sidebar_right'];
            }

            // DIRECTORY ARCHIVE
            if ( is_post_type_archive( 'directory' ) ) {
                $sidebar_config = "no-sidebars";
            }

            // PORTFOLIO CATEGORY SIDEBAR CONFIG
            if ( is_tax( 'portfolio-category' ) ) {
                $sidebar_config = "no-sidebars";
            }

            if ( is_tax( 'download_category' ) ) {
                $default_left_sidebar  = 'crowdfunding-sidebar';
                $default_right_sidebar = 'crowdfunding-sidebar';
            }

            // BUDDYPRESS SIDEBAR CONFIG
            if ( $buddypress != "" ) {
                $default_sidebar_config = $sf_options['bp_sidebar_config'];
                $default_left_sidebar   = $sf_options['bp_sidebar_left'];
                $default_right_sidebar  = $sf_options['bp_sidebar_right'];
            }

            // BBPRESS SIDEBAR CONFIG
            if ( $bbpress ) {
                $default_sidebar_config = $sf_options['bb_sidebar_config'];
                $default_left_sidebar   = $sf_options['bb_sidebar_left'];
                $default_right_sidebar  = $sf_options['bb_sidebar_right'];
            }

            // CURRENT POST/PAGE SIDEBAR CONFIG
            if ( $post && is_singular() ) {
                $sidebar_config = sf_get_post_meta( $post->ID, 'sf_sidebar_config', true );
                $left_sidebar   = sf_get_post_meta( $post->ID, 'sf_left_sidebar', true );
                $right_sidebar  = sf_get_post_meta( $post->ID, 'sf_right_sidebar', true );
                $sidebar_progress_menu = sf_get_post_meta( $post->ID, 'sf_sidebar_progress_menu', true );
            }

            if ( is_404() ) {
                $sidebar_config = $sf_options['404_sidebar_config'];
                $left_sidebar   = $sf_options['404_left_sidebar'];
                $right_sidebar  = $sf_options['404_right_sidebar'];
            }

            // DEFAULTS
            if ( $sidebar_config == "" ) {
                $sidebar_config = $default_sidebar_config;
            }
            if ( $left_sidebar == "" ) {
                $left_sidebar = $default_left_sidebar;
            }
            if ( $right_sidebar == "" ) {
                $right_sidebar = $default_right_sidebar;
            }

            // EVENTS
            if ( $type == "events-ls" ) {
            	$sidebar_config = "left-sidebar";
            	$left_sidebar = "events-sidebar-left";
            }
            if ( $type == "events-rs" ) {
            	$sidebar_config = "right-sidebar";
            	$right_sidebar = "events-sidebar-right";
            }
            if ( $type == "events-bs" ) {
            	$sidebar_config = "both-sidebars";
            	$left_sidebar = "events-sidebar-left";
            	$right_sidebar = "events-sidebar-right";
            }
            
            // Sidebar Progress Menu
            if ( $sidebar_progress_menu == "left-sidebar" && !( $sidebar_config == "left-sidebar" || $sidebar_config == "both-sidebars" ) ) {
            	$sidebar_config = "left-sidebar";
            }
            if ( $sidebar_progress_menu == "right-sidebar" && !( $sidebar_config == "right-sidebar" || $sidebar_config == "both-sidebars" ) ) {
            	$sidebar_config = "right-sidebar";
            }
            if ( $sidebar_progress_menu == "left-sidebar" ) {
            	$left_sidebar = "";
            	add_action( 'sf_before_left_sidebar', 'sf_side_progress_menu' );
            }
            if ( $sidebar_progress_menu == "right-sidebar" ) {
            	$right_sidebar = "";
            	add_action( 'sf_before_right_sidebar', 'sf_side_progress_menu' );
            }

            // SET SIDEBAR GLOBAL
            sf_set_sidebar_global( $sidebar_config );

            // PAGE WRAP CLASS
            $page_wrap_class = '';
            if ( $sidebar_config == "left-sidebar" ) {
                $page_wrap_class = 'has-left-sidebar has-one-sidebar row';
            } else if ( $sidebar_config == "right-sidebar" ) {
                $page_wrap_class = 'has-right-sidebar has-one-sidebar row';
            } else if ( $sidebar_config == "both-sidebars" ) {
                $page_wrap_class = 'has-both-sidebars row';
            } else {
                $page_wrap_class = 'has-no-sidebar';
            }
            
            if ( $sidebar_progress_menu == "left-sidebar" || $sidebar_progress_menu == "right-sidebar" ) {
            	$page_wrap_class .= ' has-progress-menu progress-menu-' . $sidebar_progress_menu;
            }

            if ( is_singular( 'post' ) || is_singular( 'portfolio' ) || is_singular( 'team' ) ) {
                $sidebar_config = "no-sidebar";
            }

            // RETURN
            $sidebar_var                    = array();
            $sidebar_var['config']          = $sidebar_config;
           	$sidebar_var['left']            = strtolower($left_sidebar);
            $sidebar_var['right']           = strtolower($right_sidebar);
            $sidebar_var['page_wrap_class'] = $page_wrap_class;

            return $sidebar_var;
        }
    }
    
    
    /* PAGE BORDERS
    ================================================== */
    function sf_page_borders() {
	    ?>
	    <div class="sf-site-top-border"></div>
	    <div class="sf-site-bottom-border"></div>
	    <div class="sf-site-left-border"></div>
	    <div class="sf-site-right-border"></div>
    <?php
    }
    //add_action('sf_before_page_container', 'sf_page_borders', 2);
?>
