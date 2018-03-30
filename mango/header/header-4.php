<?php



/**



 * The template for header 4



 *



 *



 * @package WordPress



 * @subpackage mango



 * @since mango 1.0



 */



global $mango_settings, $mobile_menu, $search_button_class,$filter;



?>



<header id="header" class="header4 mango_header4" role="banner">

    <div id="header-top">

        <div class="container">

            <div class="nav-left">

                <div class="header-row">

                    <?php get_template_part("inc/language"); ?>

                    <?php mango_phone_info() ?>

                </div><!-- End .header-row -->

            </div><!-- End .nav-left -->

            <div class="nav-right">

                <?php get_template_part("inc/social-icons"); ?>

            </div><!-- End .nav-left -->

        </div><!-- end .container -->

    </div><!-- End #header-top -->

    <div id="header-inner">

        <div class="container">

            <div class="nav-logo nav-left">

                <h1 class="logo"><a href="<?php echo esc_url( home_url( '/' ) ); ?>" title="<?php echo get_bloginfo("description"); ?>"><img src="<?php echo esc_url(mango_get_logo_url());?>" alt="<?php bloginfo("title") ?>"></a><span><?php echo get_bloginfo("description"); ?></span></h1>

            </div><!-- End .nav-left -->

            <div class="nav-center nav-left">

                <?php if($mango_settings['show-searchform']) {

                    $search_button_class = " btn-custom";

                    get_template_part("inc/mango_searchform");

                } ?>

            </div><!-- End .nav-center -->

            <div class="nav-right">

                <div class="header-row">

                    <?php mango_compare_wishlist_links() ?>

                    <?php mango_minicart(); ?>

                    <?php if($mobile_menu){ ?>

                        <button type="button" id="mobile-menu-btn">

                            <span class="sr-only"><?php __("Toggle navigation",'mango') ?></span>

                            <i class="fa fa-navicon"></i>

                        </button>

                    <?php } ?>

                </div><!-- End .header-row -->

            </div><!-- End .nav-right -->

        </div><!-- End .container -->

    </div><!-- End #header-inner -->

    <?php if(has_nav_menu('main_menu')) { ?>

        <div id="menu-container" class="sticky-menu custom">

                <div class="container">

                    <?php

                    wp_nav_menu (

                        array (

                            'theme_location' => 'main_menu',

                            'menu_id' => 'menu-main-navigation',

                            'menu_class' => 'menu ltr-dropdown',

                            "depth" => 5,

                            'container'       => 'nav',

                            'walker' => new mango_top_navwalker

                       ) );

                    ?>

            </div><!-- End .container -->

        </div><!-- End .menu-cotainer -->

    <?php } ?>

</header><!-- End #header -->