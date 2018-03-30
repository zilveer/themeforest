<!DOCTYPE HTML>
<html <?php language_attributes(); ?>>
<!--[if IE 7 ]>    <html class= "ie7"> <![endif]-->
<!--[if IE 8 ]>    <html class= "ie8"> <![endif]-->
<!--[if IE 9 ]>    <html class= "ie9"> <![endif]-->
<!--[if lt IE 9]>
   <script>
      document.createElement('header');
      document.createElement('nav');
      document.createElement('section');
      document.createElement('article');
      document.createElement('aside');
      document.createElement('footer');
   </script>
<![endif]-->
<head>
<meta charset="<?php bloginfo( 'charset' ); ?>">
<meta name="viewport" content="width=device-width, initial-scale=1.0, maximum-scale=1.0">
<title><?php wp_title(''); ?></title>
<?php if ( is_singular() && get_option( 'thread_comments' ) ) wp_enqueue_script( 'comment-reply' ); ?>
<link rel="pingback" href="<?php bloginfo( 'pingback_url' ); ?>">
<!-- *************************************************************************
*****************                FAVICON               ********************
************************************************************************** -->
<?php if ( get_theme_mod( 'cr3ativ_conference_favicon' ) ) : ?>
<?php $favicon = ( get_theme_mod( 'cr3ativ_conference_favicon' ) ); ?> 
<link rel="shortcut icon" href="<?php echo ($favicon); ?>">
<?php else : ?>
<?php endif; ?>
<!--[if lt IE 9]>
<script src="//html5shim.googlecode.com/svn/trunk/html5.js"></script>
<![endif]-->
<!-- *************************************************************************
*****************              CUSTOM CSS              ********************
************************************************************************** -->
<style type="text/css">
    
<?php if ( get_theme_mod( 'cr3ativ_conference_customcss' ) ) : ?>

<?php echo ( get_theme_mod( 'cr3ativ_conference_customcss' ) ); ?>

<?php else : ?>

<?php endif; ?>
    
</style>
    
<?php $header_image=get_header_image(); if ( ! empty( $header_image ) ) : ?>
<a href="<?php echo esc_url( home_url( '/' ) ); ?>"><img src="<?php echo esc_url( $header_image ); ?>" class="header-image" width="<?php echo get_custom_header()->width; ?>" height="<?php echo get_custom_header()->height; ?>" alt="" /></a>
<?php endif; ?>

<style type="text/css">
    
<?php if ( get_theme_mod( 'cr3ativ_conference_color1' ) ) : ?><?php $color1 =  ( get_theme_mod( 'cr3ativ_conference_color1' ) ); ?><?php else : $color1 = '#4d515c'; ?><?php endif; ?>
    
<?php if ( get_theme_mod( 'cr3ativ_conference_color2' ) ) : ?><?php $color2 =  ( get_theme_mod( 'cr3ativ_conference_color2' ) ); ?><?php else : $color2 = '#ffffff'; ?><?php endif; ?>
    
<?php if ( get_theme_mod( 'cr3ativ_conference_color3' ) ) : ?><?php $color3 =  ( get_theme_mod( 'cr3ativ_conference_color3' ) ); ?><?php else : $color3 = '#2294e5'; ?><?php endif; ?>
    
<?php if ( get_theme_mod( 'cr3ativ_conference_color4' ) ) : ?><?php $color4 =  ( get_theme_mod( 'cr3ativ_conference_color4' ) ); ?><?php else : $color4 = '#e1e3e7'; ?><?php endif; ?>

<?php if ( get_theme_mod( 'cr3ativ_conference_color6' ) ) : ?><?php $color6 =  ( get_theme_mod( 'cr3ativ_conference_color6' ) ); ?><?php else : $color6 = '#888f9e'; ?><?php endif; ?>
    
/**********This is the setting of the background image for the footer widget wrapper and the date wrapper on the homepage**********/
    
    
/**********This is the setting of the color picker 1**********/

h1, h2, h3, h4, h5, h6, .cr3ativconference_speaker_name, .cr3ativconference_speaker_name a, .cr3ativconference_speaker_company a, b, strong, p.seshspeakername a, .metadate > a, h1.blog_title a, .paginationprev a:hover, .paginationnext a:hover, blockquote, blockquote p, .conference-time, .cr3ativconference_speaker_singletitle, h6.navigation a, .blog_meta_data.single p.lildarker, .comment-author, #commentform label, .button_tag a:hover, input[type="text"]:focus, input[type="email"]:focus, input[type="url"]:focus, input[type="password"]:focus, input[type="tel"]:focus, textarea:focus, input[type="submit"]:hover, .wpcf7-form label {color:<?php echo ($color1); ?>;}
    
body .creativ-shortcode-button-colour-theme:hover {border:1px solid <?php echo ($color1); ?> !important;}
    
body .creativ-shortcode-button-colour-theme:hover, body .creativ-shortcode-tab-buttons a.active, body .creativ-shortcode-tab-buttons a:hover {color:<?php echo ($color1); ?> !important;}
    
hr, blockquote:before {border-bottom: 1px solid <?php echo ($color1); ?> !important;}
    
body.blog hr {border-bottom: 2px solid <?php echo ($color1); ?> !important;}
        
/**********This is the setting of the color picker 2**********/
    
.nav li a, .highlight_homepage_button > a, .home_centered, h1.title, .home_centered h1, .home_centered h2, .home_centered h3, .home_centered h4, .home_centered h5, .home_centered h6, .session_index_date h1.conference_date, .top_of_page_button a, .nav2 > li a, .menu_sign:before {color:<?php echo ($color2); ?>;}
    
.nav li:hover {border-bottom:1px solid <?php echo ($color2); ?>;}
    
.nav ul li ul li:hover, .nav ul li ul li.current_page_item, .nav ul li ul li ul li:hover, .nav ul li ul li ul li.current_page_item, .nav ul li ul li.current-menu-item, .nav ul li ul li ul li.current-menu-item, .nav2 li a:hover {border-left:5px solid <?php echo ($color2); ?>;}
    
.nav2 ul.sub-menu li a:hover, .nav2 ul.sub-menu li.current-menu-item > a {border-left: 2px solid <?php echo ($color2); ?>;}
    
.nav li.current_page_item {border-bottom:1px solid <?php echo ($color2); ?>;}
    
.shorthr {border-bottom: 1px solid <?php echo ($color2); ?> !important;}
    
.highlight_homepage_button > a, .top_of_page_button a { border: 1px solid <?php echo ($color2); ?>;}
    
.main_content, .highlight_homepage_button > a:hover, .top_of_page_button a:hover { background-color:<?php echo ($color2); ?>;}
    
.home_centered hr {border-bottom: 1px solid <?php echo ($color2); ?> !important;}   
    
/**********This is the setting of the color picker 3**********/

a, a:hover, .cr3ativconference_speaker_name a:hover, p.seshspeakername a:hover, h1.blog_title a:hover, h6.navigation a:hover {color:<?php echo ($color3); ?>;}
    
.creativ-shortcode-alertbox-colour-theme.creativ-shortcode-alertbox a, h2.sponsorname a, h2.sponsorname a:hover {color:<?php echo ($color3); ?> !important;}
    
.session_index_date {background-color:<?php echo ($color3); ?>; }
    
h2.meeting_date a:hover, h6.session a:hover { border-left: 5px solid <?php echo ($color3); ?>; }
    
/**********This is the setting of the color picker 4**********/
    
.main_content {box-shadow: 0 0 0 1px <?php echo ($color4); ?> inset;} 
    
div.highlight { 
    border-bottom: 1px solid <?php echo ($color4); ?>;
    border-top: 1px solid <?php echo ($color4); ?>;
}
    
.paginationnext a, .paginationprev a, .button_tag a, input[type="text"], input[type="email"], input[type="url"], input[type="password"], input[type="tel"], textarea, input[type="submit"] {border:1px solid <?php echo ($color4); ?>;}
    
body .creativ-shortcode-button-colour-theme, body .creativ-shortcode-alertbox-colour-theme, body .creativ-shortcode-toggle, body .creativ-shortcode-tabpane, pre {border:1px solid <?php echo ($color4); ?> !important;}
    
body .creativ-shortcode-tab-buttons a {border-color:<?php echo ($color4); ?> !important;}
    
table thead { background: none repeat scroll 0 0 <?php echo ($color4); ?>; }
    
/**********This is the setting of the color picker 5**********/

body, .metaauthor > a, .metacats > a, .metacomments > a, .paginationprev a, .paginationnext a, .blog_content h1.quote_title, body.single-cr3ativspeaker h5.date, .blog_meta_data.single p, h6.navigation, .button_tag a, input[type="text"], input[type="email"], input[type="url"], input[type="password"], input[type="tel"], textarea, input[type="submit"] {color:<?php echo ($color6); ?>;}
    
.paginationnext a:hover, .paginationprev a:hover, .button_tag a:hover, input[type="text"]:focus, input[type="email"]:focus, input[type="url"]:focus, input[type="password"]:focus, input[type="tel"]:focus, textarea:focus, input[type="submit"]:hover {border:1px solid <?php echo ($color6); ?>;}
    
body .creativ-shortcode-button-colour-theme, .creativ-shortcode-alertbox-colour-theme.creativ-shortcode-alertbox p, body .creativ-shortcode-tab-buttons a {color: <?php echo ($color6); ?> !important;}


</style>

<?php wp_head(); ?>

</head>

<body <?php body_class(); ?>>

    <!-- Start of header wrapper -->
    <div id="header_wrapper">

        <!-- Start of header -->
        <header>

            <!-- Start of top logo -->
            <div class="top_logo">
                <?php if ( get_theme_mod( 'cr3ativ_conference_logo' ) ) : ?>

                <a href='<?php echo esc_url( home_url( '/' ) ); ?>' title='<?php echo esc_attr( get_bloginfo( 'name', 'display' ) ); ?>' rel='<?php _e( 'home', 'cr3_attend_theme' ); ?>'><img src='<?php echo esc_url( get_theme_mod( 'cr3ativ_conference_logo' ) ); ?>' alt='<?php echo esc_attr( get_bloginfo( 'name', 'display' ) ); ?>'></a>

                <?php else : ?>

                <h1 class='site-title'><a href='<?php echo esc_url( home_url( '/' ) ); ?>' title='<?php echo esc_attr( get_bloginfo( 'name', 'display' ) ); ?>' rel='<?php _e( 'home', 'cr3_attend_theme' ); ?>'><?php bloginfo( 'name' ); ?></a></h1>

                <?php endif; ?>

            </div>
            <!-- End of top logo -->

            <!-- Start of menu container -->
            <div class="menu_container">

                <!-- Start of nav menu -->
                <div class="nav">

                <?php wp_nav_menu( array( 'menu_class'=>'nav', 'theme_location' => 'primary', ) ); ?>
                <div class="clearfix"></div>

                </div>
                <!-- End of nav menu -->

                <div class="clearfix"></div>

                <!-- Start of responsivenav --> 
                <div class="responsivenav">
                <?php wp_nav_menu(
                array(
                'menu_class' => 'nav2',
                'theme_location'  => 'responsive',
                )
                );
                ?>

                </div><!-- End of responsivenav -->  

            </div>
            <!-- End of menu container -->

            <div class="clearfix"></div>

        </header>
        <!-- End of header -->

    </div>
    <!-- End of header wrapper -->