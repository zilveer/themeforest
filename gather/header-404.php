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

    <body <?php body_class( !$cththemes_options['disable_animation']? 'animate-page' : '' );?> data-spy="scroll" data-target="#navbar" data-offset="100">
        <?php if($cththemes_options['show_loader']):?>
        <div class="preloader"></div>  
        <?php endif;?> 