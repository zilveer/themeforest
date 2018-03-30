<?php
/*
  Template name: My Account with Sidebar
 */

global $post, $yith_wcwl;
$current_url = get_permalink();
$wishlist_url = '';

if (in_array('yith-woocommerce-wishlist/init.php', apply_filters('active_plugins', get_option('active_plugins')))) {
    $wishlist_url = $yith_wcwl->get_wishlist_url();
}
$myaccount_page_id = get_option('woocommerce_myaccount_page_id');
$myaccount_page = get_permalink($myaccount_page_id);

get_header();
?>
<div id="content" class=" builder-section col-lg-12" > 
    <div class="row">
        <?php if (is_user_logged_in()) { ?> 
            <div class="col-lg-3 builder-section my-account">  
                <div class="row">
                    <div class="col-lg-3 ">  
                        <?php
                        $current_user = wp_get_current_user();
                        $user_id = $current_user->ID;
                        echo get_avatar($user_id, 60);
                        ?>
                        <h4 class="user-name"><?php echo $current_user->display_name ?></h4>
                        <?php
                        if (jwOpt::get_option('top_bar_logout', '0') == '1' && jwOpt::get_option('top_bar_logout_pageid', '') != '') {
                            $logout_link = wp_logout_url(get_permalink(jwOpt::get_option('top_bar_logout_pageid', '')));
                        } else if (class_exists('WooCommerce')) {
                            $logout_link = site_url() . '/?customer-logout=true';
                        } else {
                            $logout_link = wp_logout_url();
                        }
                        ?>
                        <span class="logout-link"><a href="<?php echo $logout_link; ?>">Log out</a></span>		 
                    </div>
                </div>
                <div class="row">
                    <div class="col-lg-3 widget widget_nav_menu">  
                        <?php if (has_nav_menu('my_account')) { ?>
                            <?php
                            wp_nav_menu(array(
                                'theme_location' => 'my_account',
                                'menu_class' => 'menu',
                                'depth' => 0,
                            ));
                            if (jwOpt::get_option('top_bar_logout', '0') == '1') {
                                $logoutLink = '';
                                if (jwOpt::get_option('top_bar_logout_pageid', '') != '') {
                                    $logoutLink = get_permalink(jwOpt::get_option('top_bar_logout_pageid', ''));
                                }
                                echo '<ul class="menu">';
                                echo '<li><a href="' . wp_logout_url($logoutLink) . '">' . __('Logout', 'jawtemplates') . '</a></li>';
                                echo '</ul>';
                            }
                            ?>
                        <?php } else { ?>
                            Define your 'My Account' navigation in Apperance -> Menus
                        <?php } ?>
                    </div>
                </div>
            </div> 


            <div class="col-lg-9 jaw-my-account">     
                <?php while (have_posts()) : the_post(); ?>
                    <h1><?php the_title(); ?></h1>

                    <?php
                    //puvodne tu byl revoComposer zakazany, ale uzivatele to matlo, tak to snad nebude delat naky vylomeniny
                    the_content();
                    ?>

                <?php endwhile; // end of the loop.    ?>	
            </div>

        <?php } else { ?>  

            <?php while (have_posts()) : the_post(); ?>
                <h1><?php the_title(); ?></h1>

                <?php the_content(); ?>
                <?php //do_action('register_form'); ?>
            <?php endwhile; // end of the loop. ?>		

        <?php } ?>
    </div>
</div>

<?php get_footer(); ?>

