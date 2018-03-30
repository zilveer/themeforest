<?php
//Header File
if ( ! defined( 'ABSPATH' ) ) exit;
?>
<!DOCTYPE html>
<html <?php language_attributes(); ?>>
<head>
<meta charset="<?php bloginfo( 'charset' ); ?>">
<?php
	wp_head();
?>
</head>
<body <?php body_class(); ?>>
<div id="global" class="global">
    <div class="pagesidebar">
        <div class="sidebarcontent">    
            <h2 id="sidelogo">
            <a href="<?php echo vibe_site_url('','sidelogo'); ?>"><img src="<?php  echo apply_filters('wplms_logo_url',VIBE_URL.'/assets/images/logo.png','pagesidebar'); ?>" alt="<?php echo get_bloginfo('name'); ?>" /></a>
            </h2>
            <?php
                $args = apply_filters('wplms-mobile-menu',array(
                    'theme_location'  => 'mobile-menu',
                    'container'       => '',
                    'menu_class'      => 'sidemenu',
                    'fallback_cb'     => 'vibe_set_menu',
                ));

                wp_nav_menu( $args );
            ?>
        </div>
        <a class="sidebarclose"><span></span></a>
    </div>  
    <div class="pusher">
        <?php
            $fix=vibe_get_option('header_fix');
        ?>
        <div id="headertop">
            <div class="<?php echo vibe_get_container(); ?>">
                <div class="row">    
                    <div class="col-md-6 col-sm-6">
                        <div class="headertop_content">
                            <?php
                                $content = vibe_get_option('headertop_content');
                                echo do_shortcode($content);
                            ?>
                        </div>
                    </div>
                    <div class="col-md-6 col-sm-6">
                        <?php
                        if ( function_exists('bp_loggedin_user_link') && is_user_logged_in() ) :
                            ?>
                            <ul class="topmenu">
                                <li>
                                    <div id="topsearchdiv">
                                        <form role="search" method="get" id="searchform" action="<?php echo home_url( '/' ); ?>">
                                            <div>
                                                <input type="text" value="<?php the_search_query(); ?>" name="s" id="s" placeholder="<?php _e('Hit enter to search...','vibe'); ?>" />
                                                <?php 
                                                    $course_search=vibe_get_option('course_search');
                                                    if(isset($course_search) && $course_search)
                                                        echo '<input type="hidden" value="course" name="post_type" />';
                                                ?>
                                            </div>
                                        </form>
                                    </div>
                                </li>
                                <li><a href="<?php bp_loggedin_user_link(); ?>" class="smallimg vbplogin"><?php $n=vbp_current_user_notification_count(); echo ((isset($n) && $n)?'<em></em>':''); bp_loggedin_user_avatar( 'type=full' ); ?><?php bp_loggedin_user_fullname(); ?></a></li>
                                <?php do_action('wplms_header_top_login'); ?>
                            </ul>
                        <?php
                        else :
                            ?>
                            <ul class="topmenu">
                                <li>
                                    <div id="searchdiv">
                                        <form role="search" method="get" id="searchform" action="<?php echo home_url( '/' ); ?>">
                                            <div><input type="text" value="<?php the_search_query(); ?>" name="s" id="s" placeholder="<?php _e('Hit enter to search...','vibe'); ?>" />
                                                <?php 
                                                    $course_search=vibe_get_option('course_search');
                                                    if(isset($course_search) && $course_search)
                                                        echo '<input type="hidden" value="course" name="post_type" />';
                                                ?>
                                            </div>
                                        </form>
                                    </div>
                                </li>
                                <li><a href="#login" class="smallimg vbplogin"><?php _e('Login','vibe'); ?></a></li>
                                <li><?php if ( function_exists('bp_get_signup_allowed') && bp_get_signup_allowed() ) :
                                    $registration_link = apply_filters('wplms_buddypress_registration_link',site_url( BP_REGISTER_SLUG . '/' ));
                                    printf( __( '<a href="%s" class="vbpregister" title="'.__('Create an account','vibe').'">'.__('Sign Up','vibe').'</a> ', 'vibe' ), $registration_link );
                                endif; ?>
                                </li>
                            </ul>
                        <?php
                        endif;

                        echo vibe_socialicons();
                        ?>
                    </div>
                    <?php
                            $style = vibe_get_login_style();
                            if(empty($style)){
                                $style='default_login';
                            }
                        ?>
                    <div id="vibe_bp_login" class="<?php echo $style; ?>">
                        <?php
                            vibe_include_template("login/$style.php");
                         ?>
                   </div>
                </div> 
            </div>
        </div>
        <div class="header_content">
            <div class="<?php echo vibe_get_container(); ?>">
                <div class="row">
                    <div class="col-md-12 center">
                        <?php

                            if(is_home()){
                                echo '<h1 id="logo">';
                            }else{
                                echo '<h2 id="logo">';
                            }
                        ?>
                        
                            <a href="<?php echo vibe_site_url('','side'); ?>"><img src="<?php  echo apply_filters('wplms_logo_url',VIBE_URL.'/assets/images/logo.png','header'); ?>" alt="<?php echo get_bloginfo('name'); ?>" /></a>
                        <?php
                            if(is_home()){
                                echo '</h1>';
                            }else{
                                echo '</h2>';
                            }
                        ?>
                    </div>
                </div>
            </div>
        </div>
        <header class="standard center <?php if(isset($fix) && $fix){echo 'fix';} ?>">
            <div class="<?php echo vibe_get_container(); ?>">
                <div class="row">
                    <div class="col-md-12">
                        <a href="<?php echo vibe_site_url('','logo'); ?>" id="alt_logo"><img src="<?php  echo apply_filters('wplms_logo_url',VIBE_URL.'/images/logo.png','standard_header'); ?>" alt="<?php echo get_bloginfo('name'); ?>" /></a>
                        <?php
                            $args = apply_filters('wplms-main-menu',array(
                                 'theme_location'  => 'main-menu',
                                 'container'       => 'nav',
                                 'menu_class'      => 'menu',
                                 'walker'          => new vibe_walker,
                                 'fallback_cb'     => 'vibe_set_menu'
                             ));
                            wp_nav_menu( $args ); 
                        ?> 
                    </div>
                    <a id="trigger">
                        <span class="lines"></span>
                    </a>
                </div>
            </div>
        </header>
