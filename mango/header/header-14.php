<?php
/**
 * The template for header 14
 *
 *
 * @package WordPress
 * @subpackage mango
 * @since mango 1.0
 */
global $mango_settings, $mobile_menu, $search_button_class,$filter;
?>
<header id="header" class="header13 header-fullwidth mango_header14" role="banner">
    <div id="header-top" class="sticky-menu">
        <div class="container-fluid">
            <div class="nav-logo nav-left">
                <h1 class="logo"><a href="<?php echo esc_url( home_url( '/' ) ); ?>" title="<?php echo get_bloginfo("description"); ?>"><img src="<?php echo esc_url(mango_get_logo_url());?>" alt="<?php bloginfo("title") ?>"></a><span><?php echo get_bloginfo("description"); ?></span></h1>
            </div><!-- End .nav-left -->

            <div class="nav-left">
                <div class="header-row">
                    <?php get_template_part("inc/language"); ?>
                </div><!-- End .header-row -->
            </div><!-- End .nav-left -->
            <?php if(has_nav_menu('main_menu')) {
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

        </div><!-- end .container -->
    </div><!-- End #header-top -->
    <div id="header-inner">
        <div class="container-fluid">
            <?php if(has_nav_menu("header_14_menu")){ ?>
            <div class="nav-left">
                <div class="dropdown department-dropdown btt-dropdown">
                    <a class="dropdown-toggle" href="#" id="department-dropdown" data-toggle="dropdown" aria-expanded="true" title="Shop by Department">
                        <i class="fa fa-navicon"></i><span class="hidden-xss"><?php
                            echo ($mango_settings['mango_header14_menu_title'])? esc_attr($mango_settings[ 'mango_header14_menu_title' ]) : __("Menu",'mango');
                            ?></span>
                    </a>
                  <?php  wp_nav_menu (
                                array (
                                    'theme_location' => 'header_14_menu',
                                    'menu_id' => '',
                                    'menu_class' => 'dropdown-menu',
                                    'items_wrap' => '<ul id="%1$s" class="%2$s" role="menu">%3$s</ul>',
                                    "depth" => 1,
                                    'container'       => false,
                                    'link_before' => '<i class="fa fa-angle-right"></i>'
                                    )
                            );?>
                </div>
            </div><!-- End .nav-left -->
            <?php } ?>
            <div class="nav-center nav-left">
                <?php if($mobile_menu){ ?>
                    <button type="button" id="mobile-menu-btn">
                        <span class="sr-only"><?php __("Toggle navigation",'mango') ?></span>
                        <i class="fa fa-navicon"></i>
                    </button>
                <?php } ?>
                    <?php if($mango_settings['show-searchform']) { ?>
                        <div class="header-search-container">
                            <?php  $search_button_class = " btn-custom";
                                get_template_part("inc/mango_searchform"); ?>
                        </div>
                    <?php } ?>
            </div><!-- End .nav-center -->
            <div class="nav-right">
                <div class="header-row">				<?php if($mango_settings['show-loginform']){?>
					<?php if(is_user_logged_in()){ ?>
					  <div class="dropdown language-dropdown btt-dropdown">
					
					<a class="dropdown-toggle header-link" href="#"  id="logout-dropdown" data-toggle="dropdown" aria-expanded="true">
					<i class="fa fa-user"></i><span class="header-text"></span><i class="fa fa-caret-down"></i> 
					</a> 
					<ul class="dropdown-menu" role="menu">
					
					<li  role="presentation" tabindex="-1" href="<?php 		echo wp_logout_url( home_url() ); ?>">
						<a href="<?php 		echo wp_logout_url( home_url() ); ?>">
							<i class="fa fa-sign-out"></i>
							<span class="">
							<?php _e("Logout",'mango') ;?>
							</span>
						 </a>
						 
					</li>
						<li  role="presentation" tabindex="-1" href="<?php 		echo wp_logout_url( home_url() ); ?>">
						<a href="<?php echo site_url('my-account'); ?>">
							<i class="fa fa-user"></i>
							<span class="">
							<?php _e("My Account",'mango') ;?>
							</span>
						 </a>
						 
					</li>
					<ul>
						</div>
					<?php  }else { ?>
						<div class="dropdown search-dropdown ">
							<a class="dropdown-toggle  " href="<?php echo site_url('login');  ?>">
								<i class="fa fa-lock"></i>
								<span class="header-text">
									<?php _e("Login",'mango') ?>
								</span>
							</a>
						</div>
					<?php } } ?>
                    <?php mango_compare_wishlist_links() ?>
                    <?php mango_minicart(); ?>
                </div><!-- End .header-row -->

            </div><!-- End .nav-right -->
        </div><!-- End .container -->
    </div><!-- End #header-inner -->
</header><!-- End #header -->