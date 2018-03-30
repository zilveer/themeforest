<?php
/**
 * @package Gather - Event Landing Page Wordpress Theme
 * @author Cththemes - http://themeforest.net/user/cththemes
 * @date: 10-8-2015
 *
 * @copyright  Copyright ( C ) 2014 - 2015 cththemes.com . All rights reserved.
 * @license    GNU General Public License version 2 or later; see LICENSE
 */

 ?>
<!DOCTYPE HTML>
<?php 
    global $cththemes_options; 
    global $wp_query;

    $navigation_type = get_post_meta($wp_query->get_queried_object_id(), "_cmb_navigation_type", true);
    if(!$navigation_type){
        $navigation_type = $cththemes_options['navigation_type'];
    }
?>
<html <?php language_attributes(); ?>>
    <head>
        <meta charset="<?php bloginfo( 'charset' ); ?>"/>
        <link rel="profile" href="http://gmpg.org/xfn/11" />
        <link rel="pingback" href="<?php bloginfo( 'pingback_url' ); ?>" />
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <meta name="viewport" content="width=device-width, initial-scale=1.0, maximum-scale=1.0, user-scalable=no">
        <?php if ( ! function_exists( 'has_site_icon' ) || ! has_site_icon() ) { ?>
        <!-- Favicon -->        
        <link rel="shortcut icon" href="<?php echo esc_url($cththemes_options['favicon']['url']);?>" type="image/x-icon"/>
        <?php } ?>
        
        <?php    
    
        wp_head(); ?>
        
    </head>

    <body <?php body_class( !$cththemes_options['disable_animation']? 'animate-page' : ''  );?> data-spy="scroll" data-target="#navbar" data-offset="100">
        <?php if($cththemes_options['show_loader']):?>
        <div class="preloader"></div>  
        <?php endif;?> 

        <!-- Fixed navbar -->
    <nav class="navbar navbar-default<?php echo ($navigation_type == 'reveal')? ' navbar-fixed-top reveal-menu js-reveal-menu reveal-menu-hidden' : (($navigation_type == 'sticky')? ' navbar-fixed-top' :'');?>">
        <div class="container">
            <div class="navbar-header">
                <button type="button" class="navbar-toggle collapsed" data-toggle="collapse" data-target="#navbar" aria-expanded="false" aria-controls="navbar">
                    <span class="sr-only"><?php _e('Toggle navigation','gather');?></span>
                    <span class="icon-bar"></span>
                    <span class="icon-bar"></span>
                    <span class="icon-bar"></span>
                </button>
                <a class="navbar-brand" href="<?php echo esc_url(home_url('/'));?>">
                <?php if($cththemes_options['logo']['url']):?>
                    <img src="<?php echo esc_url($cththemes_options['logo']['url']);?>" width="<?php echo esc_attr($cththemes_options['logo_size_width'] );?>" height="<?php echo esc_attr($cththemes_options['logo_size_height'] );?>" class="responsive-img logo-vis" alt="<?php bloginfo('name');?>" />
                <?php endif;?>
                <?php if($cththemes_options['logo_text']):?>
                    <h1 class="logo_text"><?php echo esc_html($cththemes_options['logo_text']);?></h1>
                <?php endif;?>
                <?php if($cththemes_options['slogan']):?>
                    <h3 class="slogan"><em><?php echo esc_html($cththemes_options['slogan']);?></em></h3>
                <?php endif;?>
                </a>
            </div>
            <div id="navbar" class="navbar-collapse collapse">
            <?php 
                $defaults1= array(
                    'theme_location'  => 'onepage',
                    'menu'            => '',
                    'container'       => '',
                    'container_class' => '',
                    'container_id'    => '',
                    'menu_class'      => 'gather_main-nav nav navbar-nav navbar-right',
                    'menu_id'         => '',
                    'echo'            => true,
                    // 'fallback_cb'     => 'wp_page_menu ',
                    // 'walker'          => new Walker_Nav_Menu(),
                    'fallback_cb'     => 'wp_bootstrap_navwalker::fallback',
                    'walker'          => new wp_bootstrap_navwalker(),
                    'before'          => '',
                    'after'           => '',
                    'link_before'     => '',
                    'link_after'      => '',
                    'items_wrap'      => '<ul id="%1$s" class="%2$s">%3$s</ul>',
                    'depth'           => 0,
                );
                
                if ( has_nav_menu( 'onepage' ) ) {
                    wp_nav_menu( $defaults1 );
                }
            ?>
            <?php 
            if(is_active_sidebar('top_social_widget')){
                dynamic_sidebar('top_social_widget');
            }
            ?>
            </div>
            <!--/.nav-collapse -->
        </div>
    </nav>