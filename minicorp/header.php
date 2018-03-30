<?php

global $ish_options;
global $sidebar_width;
global $ish_woo_id;
global $id_404;

?>
<!doctype html>

<!--[if lte IE 7]> <html class="ie7 ie-all" <?php language_attributes(); ?>> <![endif]-->
<!--[if IE 8]><html class="ie8 ie-all" <?php language_attributes(); ?>> <![endif]-->
<!--[if IE 9]><html class="ie9 ie-all" <?php language_attributes(); ?>> <![endif]-->
<!--[if IE 10]><html class="ie10 ie-all" <?php language_attributes(); ?>> <![endif]-->
<!--[if !IE]><!--> <html <?php language_attributes(); ?>><!--<![endif]-->

    <head>
        <meta charset="<?php bloginfo('charset'); ?>">

        <title><?php ishyoboy_title(); ?></title>

        <?php ishyoboy_meta_head(); ?>
        <meta name="author" content="IshYoBoy.com">

        <meta name="viewport" content="width=device-width">

        <!-- Place favicon.ico and apple-touch-icon.png (72x72) in the root directory -->
        <?php echo ishyoboy_get_favicon(); ?>

        <!-- Always force latest IE rendering engine (even in intranet) & Chrome Frame -->
        <meta http-equiv="X-UA-Compatible" content="IE=edge,chrome=1">

        <!-- HTML5 enabling script -->
        <!--[if lt IE 9]><script src="//html5shim.googlecode.com/svn/trunk/html5.js"></script><![endif]-->

        <?php
        /*
         * Call wp head
         */
        if ( is_singular() ) { wp_enqueue_script( 'comment-reply' ); }
        wp_head();
        ?>
        <!--[if IE 8]><link rel="stylesheet" href="<?php echo IYB_HTML_URI_CSS . '/ie8.css'; ?>"><![endif]-->

    </head>



    <body <?php body_class(ishyoboy_get_boxed_layout_class() . ' bg1'); ?>>

    <!-- Wrap whole page - boxed / unboxed -->
    <div class="wrapper-all">

        <?php if ( ishyoboy_use_expandable_header() ){?>
            <!-- Expandable part section -->
            <section class="part-expandable<?php echo ( ishyoboy_expandable_opened() ) ? '  expand-on' : '  expand-off'; ?>" id="part-expandable">

                <div class="row">
                    <?php $sidebar_width = 12; ?>
                    <?php if (function_exists('dynamic_sidebar') && dynamic_sidebar(ishyoboy_get_expandable_header())) : else : ?>

                    <!-- NO WIDGETS -->

                    <?php endif; ?>

                </div>

            </section>
            <!-- Expandable part section END -->
        <?php } ?>

        <?php ;
        if ( ishyoboy_use_header_bar() ){?>
            <!-- Top navigation section -->
            <section class="part-top-navigation" id="part-top-navigation">
                <div class="row">

                    <div class="<?php echo ( isset( $ish_options['header_bar_order'] ) && ( 'social-right' != $ish_options['header_bar_order']) )?  'left' : 'right'; ?>">
                        <?php if ( isset($ish_options['header_bar_social_icons']) && ('' != $ish_options['header_bar_social_icons']) ) { echo do_shortcode($ish_options['header_bar_social_icons']);}?>
                    </div>

                    <div class="<?php echo ( isset( $ish_options['header_bar_order'] ) && ( 'social-right' != $ish_options['header_bar_order']) )?  'right' : 'left'; ?>">
                        <?php if ( ishyoboy_wpml_plugin_active() ){
                            add_filter( 'wp_nav_menu_items', 'ishyoboy_add_language_selector', 10, 2 ) ;
                        }?>
                        <?php
                        if ( isset($ish_options['header_bar_menu']) && ('' != $ish_options['header_bar_menu']) ) {
                            wp_nav_menu( array( 'menu' => $ish_options['header_bar_menu'], 'container' => 'nav', 'container_class' => 'top-nav') );
                        }
                        elseif ( isset( $ish_options['header_bar_languages'] ) && ( '1' == $ish_options['header_bar_languages'] ) && ishyoboy_wpml_plugin_active() ){
                            echo '<nav class="top-nav"><ul><li class="top-nav-border"><a href="#">' . __( 'Language', 'ishyoboy' ) . '</a>' . ishyoboy_language_selector().'</li></ul><nav>';
                        }  ?>
                    </div>

                    <?php if ( ishyoboy_use_expandable_header() && !ishyoboy_expandable_opened() ) { ?>
                        <a id="expandable" href="#expandable" class="icon-down-open-1"></a>
                    <?php } ?>

                </div>
            </section>
            <!-- Top navigation section END -->
        <?php } ?>

        <!-- Header part section -->
        <section class="part-header<?php echo ( ishyoboy_is_sticky_nav_on() ) ? ( ' sticky-on' . ( ishyoboy_is_sticky_nav_responsive_on() ? ' sticky-show-responsive' : ' sticky-hide-responsive' ) ) : ' sticky-off'; ?>" id="part-header">
            <div class="row">

                <?php if ( !ishyoboy_use_header_bar() && ishyoboy_use_expandable_header() && !ishyoboy_expandable_opened() ) { ?>
                    <a id="expandable" href="#expandable" class="icon-down-open-1"></a>
                <?php } ?>

                <section class="grid12">

                    <div class="logo<?php echo ( ishyoboy_is_sticky_nav_on() && ishyoboy_is_sticky_nav_logo_on() ) ? ' show-in-sticky' : ' hide-in-sticky'; echo ( ishyoboy_use_logo() && ishyoboy_is_retina_logo() ) ? ' retina-yes' : ' retina-no'; ?>">
                        <div>
                            <?php if ( ishyoboy_use_logo() && ishyoboy_is_logo() ){ ?>
                                <a href="<?php echo esc_attr( apply_filters( 'ishyoboy_logo_url', home_url() ) ); ?>"><img src="<?php echo $ish_options['logo_image']; ?>" alt="<?php echo esc_attr(get_bloginfo('name')); ?>" title="<?php echo esc_attr(get_bloginfo('name')); ?>" /></a>
                            <?php } else { ?>
                                <a href="<?php echo esc_attr( apply_filters( 'ishyoboy_logo_url', home_url() )); ?>"><?php echo esc_attr(get_bloginfo('name')); ?></a>
                            <?php } ?>
                        </div>
                    </div>

                    <?php
                    $blog_tagline = get_bloginfo('description');
                    if ('' != $blog_tagline){ ?>
                        <div class="tagline<?php echo ( ishyoboy_is_sticky_nav_on() && ishyoboy_is_sticky_nav_tagline_on() ) ? ' show-in-sticky' : ' hide-in-sticky'; ?>">
                            <div><?php echo $blog_tagline; ?></div>
                        </div>
                    <?php } ?>

                    <nav class="main-nav" id="main-nav">
                        <?php if ( isset( $ish_options['mainnav_full'] ) && ( '1' == $ish_options['mainnav_full'] ) ) {
                            wp_nav_menu( array( 'theme_location' => 'header-menu', 'container' => '', 'menu_id' => 'mainnav', 'menu_class' => 'menu menu-full' ) );
                        } else{
                            wp_nav_menu( array( 'theme_location' => 'header-menu', 'container' => '', 'menu_id' => 'mainnav', 'menu_class' => 'menu menu-mini' ) );
                        } ?>
                    </nav>
                </section>

            </div>
        </section>
        <!-- Header part section END -->
