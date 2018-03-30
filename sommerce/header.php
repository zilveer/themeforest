<?php
/**
 * The Header for our theme.
 *
 * @package WordPress
 * @subpackage YIW Themes
 * @since 1.0
 */
 global $yiw_mobile;
?><!DOCTYPE html>
<!--[if IE 6]>
<html id="ie6" <?php language_attributes(); ?>>
<![endif]-->
<!--[if IE 7]>
<html id="ie7" <?php language_attributes(); ?>>
<![endif]-->
<!--[if IE 8]>
<html id="ie8" <?php language_attributes(); ?>>
<![endif]-->
<!--[if IE 9]>
<html id="ie9" <?php language_attributes(); ?>>
<![endif]-->
<!--[if !(IE 6) | !(IE 7) | !(IE 8)  ]><!-->
<html <?php language_attributes(); ?>>
<!--<![endif]-->
<head>
<meta charset="<?php bloginfo( 'charset' ); ?>" />
<?php if ( ! $yiw_mobile->isIpad() ) : ?>
<meta name="viewport" content="width=device-width" />
<?php endif ?>

	<link rel="stylesheet" type="text/css" media="all" href="<?php bloginfo( 'stylesheet_url' ); ?>" />
	<link rel="pingback" href="<?php bloginfo( 'pingback_url' ); ?>" />

	<?php if ( yiw_get_option( 'responsive', 1 ) ) : ?>
	<link rel="stylesheet" type="text/css" media="screen and (max-width: 960px)" href="<?php echo get_template_directory_uri(); ?>/css/lessthen980.css" />
	<link rel="stylesheet" type="text/css" media="screen and (max-width: 600px)" href="<?php echo get_template_directory_uri(); ?>/css/lessthen600.css" />
	<link rel="stylesheet" type="text/css" media="screen and (max-width: 480px)" href="<?php echo get_template_directory_uri(); ?>/css/lessthen480.css" />
	<?php endif; ?>

    <?php
		// styles
        wp_enqueue_style( 'prettyPhoto' );
		wp_enqueue_style( 'Droid-google-font',  yiw_ssl_url( 'http://fonts.googleapis.com/css?family=Droid+Sans' ) );
        wp_enqueue_style( 'jquery-tipsy' );

		// scripts
        wp_enqueue_script( 'jquery-prettyPhoto' );
        wp_enqueue_script( 'jquery-tipsy' );
        wp_enqueue_script( 'jquery-tweetable' );
    	wp_enqueue_script( 'jquery-nivo' );
	    wp_enqueue_script( 'jquery-cycle' );
        wp_enqueue_script( 'jquery-easing' );

        // slider libraries
		if ( is_home() || is_front_page() || is_page_template('home.php') || get_page_template_slug( get_option('woocommerce_shop_page_id') ) == 'home.php' ) :

            $slider_type = yiw_slider_type();

            if ( in_array( $slider_type, array( 'cycle', 'nivo' ) ) )
		        wp_enqueue_style( 'slider-' . $slider_type,        get_template_directory_uri()."/css/slider-". $slider_type .".css" );

			// elegant
			if ( $slider_type == 'elegant' ) :
	    		wp_enqueue_script( 'jquery-cycle' );

		    // flash
		    elseif ( $slider_type == 'flash' ) :
		        wp_enqueue_script( 'swfobject' );

		    // thumbnails
		    elseif ( $slider_type == 'thumbnails' ) :
		        wp_enqueue_script( 'jquery-aw-showcases', get_template_directory_uri()."/js/jquery.aw-showcase.js" );

		    // cycle
		    elseif ( $slider_type == 'cycle' ) :
		        wp_enqueue_script( 'jquery-cycle' );
		        wp_enqueue_script( 'swfobject' );

		    // nivo
		    elseif ( $slider_type == 'nivo' ) :
		        wp_enqueue_script( 'jquery-nivo' );

		    // rotating
		    elseif ( $slider_type == 'rotating' ) :
        		wp_enqueue_style( 'jquery-rotating',   	get_template_directory_uri()."/css/jquery-rotating.css" );
		        wp_enqueue_script( 'jquery-rotating',	get_template_directory_uri()."/js/jquery.RotateImageMenu.js", array('jquery'), '1.0', true );
		        //wp_enqueue_script( 'jquery-transform',	get_template_directory_uri()."/js/jquery.transform-0.9.3.min.js", array('jquery') );
		    endif;

		endif;

        wp_enqueue_script( 'jquery-mobilemenu', YIW_THEME_JS_URL . 'jquery.mobilemenu.js', array('jquery'), '1.0', true);

        // add select menu on mobile
        if ( yiw_get_option('responsive-menu') ) {
            add_filter('body_class','add_menu_responsive_class');
        }

        // custom
        wp_enqueue_script( 'jquery-custom',      get_template_directory_uri()."/js/jquery.custom.js", array('jquery'), '1.0', true);

		/* We add some JavaScript to pages with the comment form
		 * to support sites with threaded comments (when in use).
		 */
		if ( is_singular() && get_option( 'thread_comments' ) )
			wp_enqueue_script( 'comment-reply' );

        wp_enqueue_style( 'sommerce-custom',   	get_template_directory_uri()."/custom.css" );

        $body_class = '';
        if ( ( yiw_get_option( 'responsive', 1 ) && ! $GLOBALS['is_IE'] ) || ( yiw_get_option( 'responsive', 1 ) && yiw_ieversion() >= 9 ) )
            $body_class = ' responsive';
    ?>

    <?php if ( ! ( function_exists( 'has_site_icon' ) && has_site_icon() ) ) : ?>
    <!-- [favicon] begin -->
    <link rel="shortcut icon" type="image/x-icon" href="<?php yiw_favicon(); ?>" />
    <link rel="icon" type="image/x-icon" href="<?php yiw_favicon(); ?>" />
    <!-- [favicon] end -->
    <?php endif; ?>

    <?php wp_head() ?>
</head>

<body <?php body_class( "no_js" . $body_class ) ?>>

	<!-- START LIGHT WRAPPER -->
	<div class="bgLight group">

		<!-- START WRAPPER -->
		<div class="wrapper group">

			<!-- START BG WRAPPER -->
			<div class="bgWrapper group">

			    <!-- START HEADER -->
			    <div id="header" class="group">

					<!-- .inner -->
					<div class="inner group">

				        <!-- START LOGO -->
				        <div id="logo" class="group">

                            <?php if( function_exists( 'has_custom_logo' ) && has_custom_logo() ) : ?>

                                <?php the_custom_logo() ?>

                            <?php else: ?>

                                <a href="<?php echo home_url() ?>" title="<?php bloginfo('name') ?>">
                                    <?php if ( yiw_get_option( 'show_image_logo' ) ) : ?>
                                        <img src="<?php yiw_logo() ?>" alt="Logo <?php bloginfo('name') ?>" />
                                    <?php else : ?>
                                        <span class="logo-title"><?php bloginfo( 'name' ) ?></span>
                                    <?php endif; ?>
                                </a>

                            <?php endif; ?>


							<?php if ( yiw_get_option( 'show_description_logo' ) ) : ?>
							<p class="logo-description"><?php bloginfo( 'description' ) ?></p>
                            <?php endif; ?>

				        </div>
				        <!-- END LOGO -->

				        <!-- START LINKSBAR -->
				        <?php get_template_part( 'linksbar' ); ?>
				        <!-- END LINKSBAR -->

				        <div class="clear"></div>

				        <!-- START NAV -->
				        <div id="nav" class="group <?php echo yiw_get_option( 'nav_type' ) ?>">
				            <?php
								$nav_args = array(
				                    'theme_location' => 'nav',
				                    'container' => 'none',
				                    'menu_class' => 'level-1',
				                    'depth' => apply_filters( 'yiw_main_menu_depth', 3),
				                    //'fallback_fb' => false,
				                    //'walker' => new description_walker()
				                );

				                wp_nav_menu( $nav_args );
				            ?>
				        </div>
				        <!-- END NAV -->

                        <?php
                        /**
                         * After Main nav
                         *
                         * @since sommerce 2.9.2
                         */
                        do_action( 'yiw_after_main_nav' ) ?>

						<?php if( yiw_get_option( 'show_searchform' ) ) : ?>
						<!-- START SEARCH FORM -->
						<?php
							$submit_label = create_function( '', 'return "&gt;";' );
							$label = create_function( '', 'return "' . __( 'search', 'yiw' ) . '";' );
							add_filter( 'yiw_searchform_submitlabel', $submit_label );
							add_filter( 'yiw_searchform_label', $label );
							get_search_form();
							remove_filter( 'yiw_searchform_submitlabel', $submit_label );
							remove_filter( 'yiw_searchform_label', $label );
						?>
						<!-- END SEARCH FORM -->
						<?php endif; ?>

					</div>
					<!-- end .inner -->

			    </div>
			    <!-- END HEADER -->

				<?php get_template_part( 'slider' ); ?>

			    <!-- START PRIMARY SECTION -->
			    <div id="primary" class="inner group">

				    <?php get_template_part( 'slogan' ); ?>