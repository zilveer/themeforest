<?php

/**

 * The template for header 19

 *

 *

 * @package WordPress

 * @subpackage mango

 * @since mango 1.0

 */

global $mango_settings, $mobile_menu, $search_button_class,$filter;

?>

<?php $large_side_header =  mango_side_header_large() ?>

<header class="side-menu left dark <?php echo esc_attr($large_side_header) ; ?> mango_header19" >

    <div class="<?php echo ($large_side_header)?"side-menu-container side-menu-wrapper":"side-menu-wrapper" ?>">

        <h1 class="logo">

            <a href="<?php echo esc_url( home_url( '/' ) ); ?>" title="<?php echo get_bloginfo("description"); ?>"><img src="<?php echo esc_url(mango_get_logo_url());?>" alt="<?php bloginfo("title") ?>"></a>

        </h1>

        <?php if($mango_settings['show-searchform']) { ?>

                <div class="header-search-container header-simple-search">

                    <?php get_search_form(); ?>

                </div>

            <?php } ?>

        <?php mango_cart_total() ?>

        <?php if(has_nav_menu('main_menu')) {

                    wp_nav_menu (

                        array (

                            'theme_location' => 'main_menu',

                            'menu_id' => 'menu-main-navigation',

                            'menu_class' => 'smenu',

                            "depth" => 5,

                            'container'       => 'nav',

                            //'walker' => new mango_top_navwalker

                        ) );

              } ?>

        <div id="side-menu-footer">

            <?php get_template_part("inc/social-icons"); ?>

           <p class="copyright"><?php echo htmlspecialchars_decode(esc_textarea($mango_settings['mango_copyright'])) ?></p>

        </div>

        <?php if($mobile_menu){ ?>

            <button type="button" id="mobile-menu-btn">

                <span class="sr-only"><?php __("Toggle navigation",'mango') ?></span>

                <i class="fa fa-navicon"></i>

            </button>

        <?php } ?>

    </div><!-- End #side-menu-wrapper -->

</header><!-- end .side-menu -->