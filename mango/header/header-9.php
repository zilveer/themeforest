<?php
/**
 * The template for header 9
 *
 *
 * @package WordPress
 * @subpackage mango
 * @since mango 1.0
 */
global $mango_settings, $mobile_menu, $search_button_class,$filter;
?>
<header id="header" class="header-absolute sticky-menu mango_header9" role="banner">
    <div class="container">
        <div class="nav-logo nav-left">
            <h1 class="logo"><a href="<?php echo esc_url( home_url( '/' ) ); ?>" title="<?php echo get_bloginfo("description"); ?>"><img src="<?php echo esc_url(mango_get_logo_url());?>" alt="<?php bloginfo("title") ?>"></a><span><?php echo get_bloginfo("description"); ?></span></h1>
        </div><!-- End .nav-left -->
        <div class="nav-right">
            <div class="header-row">
             <?php if($mango_settings['show-searchform']) { ?>
                <div class="dropdown search-dropdown">
                    <a class="dropdown-toggle" href="#" data-toggle="dropdown">
                        <i class="fa fa-search"></i>
                    </a>
                    <div class="dropdown-menu pull-right" role="menu">
                      <?php $search_button_class = " btn-custom2";
                        get_template_part("inc/mango_searchform");
                      ?>
                    </div><!-- end .dropdown-menu -->
                </div><!-- End .search-dropdown -->
             <?php  } ?>													
                <?php mango_compare_wishlist_links(false) ?>
                <?php mango_minicart(false, "count" ); ?>
                <?php if($mobile_menu){ ?>
                    <button type="button" id="mobile-menu-btn">
                        <span class="sr-only"><?php __("Toggle navigation",'mango') ?></span>
                        <i class="fa fa-navicon"></i>
                    </button>
                <?php } ?>
            </div><!-- End .header-row -->
        </div><!-- End .nav-right -->
        <?php if(has_nav_menu('main_menu')) { ?>
                    <?php
                    wp_nav_menu (
                        array (
                            'theme_location' => 'main_menu',
                            'menu_id' => 'menu-main-navigation',
                            'menu_class' => 'menu ttb-dropdown',
                            "depth" => 5,
                            'container'       => 'nav',
                            'container_class' => 'nav-right',
                            'walker' => new mango_top_navwalker
                        ) );
        } ?>
    </div><!-- End .container -->
</header><!-- End #header -->