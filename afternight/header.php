<!DOCTYPE html>

<!--[if lt IE 7]> <html class="no-js lt-ie9 lt-ie8 lt-ie7 oldie" lang="en"> <![endif]-->
<!--[if IE 7]>    <html class="no-js lt-ie9 lt-ie8 oldie" lang="en"> <![endif]-->
<!--[if IE 8]>    <html class="no-js lt-ie9 oldie" lang="en"> <![endif]-->

<?php
    function is_facebook(){
        if(!(stristr($_SERVER["HTTP_USER_AGENT"],'facebook') === FALSE)) {
            return true;
        }
    }
?>
<!--[if gt IE 8]><!--> <html xmlns="http://www.w3.org/1999/xhtml" <?php language_attributes(); ?> <?php if(is_facebook()){ echo ' xmlns:fb="http://ogp.me/ns/fb#" ';} ?> ><!--<![endif]-->

<head>
    <meta http-equiv="Content-Type" content="<?php bloginfo('html_type'); ?>; charset=<?php bloginfo('charset'); ?>" />
    <meta name="robots"  content="index, follow" />
    
    <?php  
        $template = LBTemplate::figure_out_template(); /*initialize template*/
        if (!isset($template)){
            $temp_events = get_option('single_layout');

            $template = LBTemplate::get_template_by_id( $temp_events['template']);
           // var_dump($template );
        }
     
    ?>
    

    <?php 
        if( options::logic( 'blog_post' , 'post_sharing' ) || options::logic( 'blog_post' , 'page_sharing' ) || options::logic( 'general' , 'fb_comments' ) ){ 
            /*BOF if sharing or FB comments are enebled*/
    ?>
    <?php if( is_single() || is_page() ){ ?>
    <meta name="description" content="<?php echo strip_tags(post::get_excerpt($post, $ln=150)); ?>" /> 
    <?php }else{ ?>
    <meta name="description" content="<?php echo get_bloginfo('description'); ?>" /> 
    <?php } ?>

    <?php if( is_single() || is_page() ){ ?>
        <meta property="og:title" content="<?php the_title() ?>" />
        <meta property="og:site_name" content="<?php echo get_bloginfo('name'); ?>" />
        <meta property="og:url" content="<?php the_permalink() ?>" />
        <meta property="og:type" content="article" />
        <meta property="og:locale" content="en_US" /> 
        <meta property="og:description" content="<?php echo get_bloginfo('description'); ?>"/>
        <?php 
            if(options::get_value( 'social' , 'facebook_app_id' ) != ''){
                ?><meta property='fb:app_id' content='<?php echo options::get_value( 'social' , 'facebook_app_id' ); ?>'><?php
            }
            
            global $post;
            $src  = wp_get_attachment_image_src( get_post_thumbnail_id( $post -> ID ) , 'thumbnail' );
            if(strlen($src[0])){
                echo '<meta property="og:image" content="'.$src[0].'"/>';     
            }else{
                echo '<meta property="og:image" content="'.get_template_directory_uri().'/fb_screenshot.png"/>';
            }
            
            if(strlen($src[0])){
                echo ' <link rel="image_src" href="'.$src[0].'" />';           
            }

            wp_reset_query();   
        }else{ ?>
            <meta property="og:title" content="<?php echo get_bloginfo('name'); ?>"/>
            <meta property="og:site_name" content="<?php echo get_bloginfo('name'); ?>"/>
            <meta property="og:url" content="<?php echo home_url() ?>/"/>
            <meta property="og:type" content="blog"/>
            <meta property="og:locale" content="en_US"/>
            <meta property="og:description" content="<?php echo get_bloginfo('description'); ?>"/>
            <meta property="og:image" content="<?php echo get_template_directory_uri()?>/fb_screenshot.png"/> 
    <?php
            }

        } /*EOF if sharing or FB comments are enebled*/
    ?>

    <title><?php bloginfo('name'); ?> &raquo; <?php bloginfo('description'); ?><?php if ( is_single() ) { ?><?php } ?><?php wp_title(); ?></title>

    <!-- Set the viewport width to device width for mobile -->
    <meta name="viewport" content="width=device-width, initial-scale=1.0, minimum-scale=1.0" />

    <?php
        if( strlen( options::get_value( 'styling' , 'favicon' ) ) ){
            $path_parts = pathinfo( options::get_value( 'styling' , 'favicon' ) );
            if( $path_parts['extension'] == 'ico' ){
    ?>
                <link rel="shortcut icon" href="<?php echo options::get_value( 'styling' , 'favicon' ); ?>" />
    <?php
            }else{
    ?>
                <link rel="shortcut icon" href="<?php echo get_template_directory_uri(); ?>/favicon.ico" />
    <?php
            }
        }else{
    ?>
            <link rel="shortcut icon" href="<?php echo get_template_directory_uri(); ?>/favicon.ico" />
    <?php
        }
    ?>

    <link rel="profile" href="http://gmpg.org/xfn/11" />

    <link rel="pingback" href="<?php bloginfo('pingback_url'); ?>" />
  
  <!--[if lt IE 9]>
        <link rel="stylesheet" href="<?php echo get_template_directory_uri(); ?>/css/autoinclude/ie.css">
    <![endif]-->

        <!-- IE Fix for HTML5 Tags -->
    <!--[if lt IE 9]>
        <script src="http://html5shiv.googlecode.com/svn/trunk/html5.js"></script>
    <![endif]-->    
    
    <?php
        
        $background = options::get_value( 'styling' , 'menu_color' );   
        

        $menu_color = options::get_value( 'styling' , 'menu_text_color' );
        
        $menu_hover_bg_color = options::get_value( 'styling' , 'menu_hover_bg_color' );
        

        
        $menu_hover_text_color = options::get_value( 'styling' , 'menu_hover_text_color' );
        
        $breaking_news_bg_color = options::get_value( 'blog_post' , 'breaking_news_bg_color' );
        $breaking_news_text_color = options::get_value( 'blog_post' , 'breaking_news_text_color' );

/*        if( strlen(options::get_value( 'styling' , 'boxed_bg_color' ) ) ){
            $content_title_bg = "background-color: ".options::get_value( 'styling' , 'boxed_bg_color' )."!important";
        }else{
            $content_title_bg = '';
        }*/

        $template_directory_uri = get_template_directory_uri();
        
        $rgb_color = hex2rgb(options::get_value( 'styling','menu_color' ));
        $rgb_submenu = hex2rgb(options::get_value( 'styling' , 'menu_hover_bg_color' ));
        if(strlen(options::get_value('styling','menu_bg_color_opacity'))){
            $rgb_color = $rgb_color.' '. 0.01*(int)options::get_value('styling','menu_bg_color_opacity');
            $rgb_sbmenu_color = $rgb_submenu.' '. 0.01*(int)options::get_value('styling','menu_bg_color_opacity');
        }
        $rgba_bg = "background-color: rgba(".$rgb_color.") !important; ";
        $rgba_submenu_bg = "background-color: rgba(".$rgb_sbmenu_color.") !important; ";


        if( strlen( $background ) || strlen( $text_color ) ){
            echo <<<endhtml
            <style type="text/css">
                header #header-container .sticky-menu-container a {color: $menu_color;}
                header #header-container .sticky-menu-container { $rgba_bg }
                header #header-container .sticky-menu-container .sf-menu li li:hover a, 
                header #header-container .sticky-menu-container .sf-menu li li.sfHover a, 
                header #header-container .sticky-menu-container .sf-menu li li a { color: $menu_hover_text_color !important;  }
                header #header-container .sticky-menu-container .sf-menu li.selected a, header #header-container .sticky-menu-container .sf-menu li:hover a{color:$menu_hover_text_color !important;}
                header #header-container .sticky-menu-container .sf-menu li.selected, 
                header #header-container .sticky-menu-container .sf-menu li:hover, 
                header #header-container .sticky-menu-container .sf-menu li.sfHover,
                header #header-container .sticky-menu-container .sf-menu li li,
                header #header-container .sticky-menu-container .sf-menu li li:hover a { $rgba_submenu_bg }               
            </style>
endhtml;
        }

        $view_posrt_width = options::get_value( 'styling' , 'viewport_width' );
        echo <<<endhtml
            <style type="text/css">
                div.row{width:$view_posrt_width;}
                div.login-box-container{width:$view_posrt_width;}
                header #header-container .sticky-menu-container .sticky-content{ max-width:$view_posrt_width;}
            </style>
endhtml;
        
    ?>

    <?php wp_head(); ?>
</head>

<?php 

    $position   = '';
    $repeat     = '';
    $bgatt      = '';
    $background_color = '';
    $background_img ='';

    if( is_single() || is_page() ){
        $settings = meta::get_meta( $post -> ID , 'settings' );
        if( ( isset( $settings['post_bg'] ) && !empty( $settings['post_bg'] ) ) || ( isset( $settings['color'] ) && !empty( $settings['color'] ) ) ){
            if( isset( $settings['post_bg'] ) && !empty( $settings['post_bg'] ) ){ 
                $background_img = "background-image: url('" . $settings['post_bg'] . "');";
            }

            if( isset( $settings['color'] ) && !empty( $settings['color'] ) ){
                $background_color = "background-color: " . $settings['color'] . "; ";
            }

            if( isset( $settings['position'] ) && !empty( $settings['position'] ) ){
                $position = 'background-position: '. $settings['position'] . ';';
            }
            if( isset( $settings['repeat'] ) && !empty( $settings['repeat'] ) ){
                $repeat = 'background-repeat: '. $settings['repeat'] . ';';
            }
            if( isset( $settings['attachment'] ) && !empty( $settings['attachment'] ) ){
                $bgatt = 'background-attachment: '. $settings['attachment'] . ';';
            }
        }else{
            if(get_background_image() == '' && get_bg_image() != ''){ 
                if(get_bg_image() != 'pattern.none.png'){
                    $background_img = 'background-image: url('.get_template_directory_uri().'/lib/images/pattern/'.get_bg_image().');';
                }else{
                    $background_img = '';
                }    
                /*if day or night images are set then we will add 'background-attachment:fixed'   */
                if(strpos(get_bg_image(),'.jpg')){
                    $background_img .= ' background-attachment:fixed';
                }
            }else{
                $background_img = '';
            }
            if(get_content_bg_color() != ''){
                $background_color = "background-color: " . get_content_bg_color() . "; ";
            }
        }
    }else{
        if(get_background_image() == '' && get_bg_image() != ''){
            if(get_bg_image() != 'pattern.none.png'){
                $background_img = 'background-image: url('.get_template_directory_uri().'/lib/images/pattern/'.get_bg_image().');';
            }else{
                $background_img = '';
            }    
            /*if day or night images are set then we will add 'background-attachment:fixed'   */
            if(strpos(get_bg_image(),'.jpg')){
                $background_img .= ' background-attachment:fixed;';
            }
        }else{
            $background_img = '';
        }
        if(get_content_bg_color() != ''){
            $background_color = "background-color: " . get_content_bg_color() . "; ";
        }

        if( strlen( get_background_image() ) ){
            $background_img = '';
        }

        if( strlen( get_background_color() ) ){
            $background_color = '';
        }
    }
    $bgimage = get_background_image();
    if ((options::get_value( 'styling' , 'background_position_100' ) == 'yes') && (!empty($bgimage)) && (get_theme_mod('background_repeat', 'repeat') == 'no-repeat') && get_theme_mod('background_attachment', 'fixed') == 'fixed') {
        if(isset( $settings['post_bg'] ) && $settings['repeat'] == "no-repeat"){
            $position_100 = 'background-size: cover; -moz- background-size: cover; -webkit-background-size: cover;';
        }else if(isset( $settings['post_bg'] ) && $settings['repeat'] != "no-repeat"){
            $position_100 = '';
        }else {
            $position_100 = 'background-size: cover; -moz- background-size: cover; -webkit-background-size: cover;';
        }

    } else {
        $position_100 = '';
    }

    if (!options::logic( 'styling' , 'apply_content_background' )) {
        $class = 'no_background_color';
    } else { $class= ''; }

    if(isset($template -> id)){  
        $class .= ' ' . 'template_' . $template -> id; // add the template ID as class
    }

?>
<body <?php body_class($class); ?> style="<?php echo $position_100 ; ?> <?php echo $background_color ; ?> <?php echo $background_img ; ?>  <?php echo $position; ?> <?php echo $repeat; ?> <?php echo $bgatt; ?>">
    <?php
        $defaults = array(
            'theme_location'  => '',
            'menu_id'         => 'mobile-hamburger',
            'container' => 'div',
            'container_class' => 'menu-main-menu-container'
        );
        if ( has_nav_menu( 'header_menu' ) ) {
            wp_nav_menu( $defaults ); 
        }
        $topmenu = array(
            'theme_location'  => 'top_menu',
            'menu_id'         => 'mobile-top-hamburger',
            'container' => 'div',
            'container_class'=> 'top-menu-mobile'
        );
        if ( has_nav_menu( 'top_menu' ) ) {
            wp_nav_menu( $topmenu ); 
        }

    ?>
    <?php  
        if( options::logic( 'blog_post' , 'post_sharing' ) || options::logic( 'blog_post' , 'page_sharing' ) || options::logic( 'general' , 'fb_comments' ) || is_element_used($template -> _header_rows, 'login') ){
            /*BOF if sharing or FB comments are enebled, OR login element is used in the header*/
    ?>       
    <script src="http://connect.facebook.net/en_US/all.js#xfbml=1" type="text/javascript" id="fb_script"></script>
    <?php 
        } /*EOF if sharing or FB comments are enebled*/
    ?>

    <div id="page" class="container <?php //if( options::logic( 'styling', 'boxed' ) ) echo 'boxed';?>">
        <div id="fb-root"></div>
        <div class="mobile-container">
            <a class="mobile-hamburger"><span></span></a> 
            <?php if ( has_nav_menu( 'top_menu' ) ) { ?><a class="top-menu-trigger"><span></span></a><?php } ?>
        </div>
        <div class="relative row">
            <?php
                $tooltip_builder = new TooltipBuilder();
                $tooltip_builder -> render_frontend();
            ?>
        </div>
        <?php
            if( options::logic( 'general' , 'fb_comments' ) ){
                if(options::get_value( 'social' , 'facebook_app_id' ) != ''){
        ?>
                    <?php
                        if( is_user_logged_in () ){
                    ?>
                            <script type="text/javascript">
                                FB.getLoginStatus(function(response) {
                                    if( typeof response.status == 'unknown' ){
                                        jQuery(function(){
                                            jQuery.cookie('fbs_<?php echo options::get_value( 'social' , 'facebook_app_id' ); ?>' , null , {expires: 365, path: '/'} );
                                        });
                                    }else{
                                        if( response.status == 'connected' ){
                                            jQuery(function(){
                                                jQuery('#fb_script').attr( 'src' ,  document.location.protocol + '//connect.facebook.net/en_US/all.js#appId=<?php echo options::get_value( 'social' , 'facebook_app_id' ); ?>' );
                                            });
                                        }
                                    }
                                });
                            </script>
                    <?php
                        }
                }
            }
        ?> 
        
        <?php
            /*login form*/
            if(!is_user_logged_in() && is_element_used($template -> _header_rows, 'login')){ /*show login box only when user is not logged in and Login element is enabled in the template*/

                if(isset($_GET['action']) && ($_GET['action'] == 'login' || $_GET['action'] == 'recover' || $_GET['action'] == 'register') ){
                    $login_box_style ='display: block;';
                }else{
                    $login_box_style =' display:none; ';
                }
            ?>
                <div class="login_box" style="<?php echo $login_box_style; ?>">
                    <div class="login-box-container">
                        <span class="close_box" onclick=" jQuery('.login_box').slideToggle(); jQuery('.mobile-user-menu').animate({opacity:1},500);"></span>
                        <?php    
                            get_template_part('login');
                        ?>
                    </div>
                </div>
            <?php    
            }
        ?>
        
        <header id="top">
            <div id="header-container">
                <?php
                    /*the following commented code was moved upper because we need this initialized
                     yearlyer to get the template header BG color and template heater text color*/
                    /*$template = LBTemplate::figure_out_template();*/
                    $template -> render_header();
                ?>

            </div>
        </header>
