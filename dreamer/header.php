<!DOCTYPE html>
<!--[if lt IE 7]> <html class="no-js lt-ie9 lt-ie8 lt-ie7" lang="en"> <![endif]-->
<!--[if IE 7]>    <html class="no-js lt-ie9 lt-ie8" lang="en"> <![endif]-->
<!--[if IE 8]>    <html class="no-js lt-ie9" lang="en"> <![endif]-->
<!--[if gt IE 8]><!--><html class="no-js" <?php language_attributes(); ?>> <!--<![endif]-->
<head>

    <!-- MetaTags -->
    <meta charset="<?php bloginfo( 'charset' ); ?>" />
    <meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1" />
    <title><?php wp_title(' '); ?><?php if(wp_title(' ', false)) { echo ' -'; } ?> <?php bloginfo('name'); ?></title>
    <link rel="profile" href="http://gmpg.org/xfn/11" />

    <!-- Set the viewport width to device width for mobile -->
    <meta name="viewport" content="width=device-width" />
    <meta name="HandheldFriendly" content="True">
    <meta name="MobileOptimized" content="320">
    <meta name="apple-mobile-web-app-capable" content="yes">
    <meta name="apple-touch-fullscreen" content="yes"/>

    <!-- This script prevents links from opening in Mobile Safari. https://gist.github.com/1042026 -->
    <script>(function(a,b,c){if(c in b&&b[c]){var d,e=a.location,f=/^(a|html)$/i;a.addEventListener("click",function(a){d=a.target;while(!f.test(d.nodeName))d=d.parentNode;"href"in d&&(d.href.indexOf("http")||~d.href.indexOf(e.host))&&(a.preventDefault(),e.href=d.href)},!1)}})(document,window.navigator,"standalone")</script>

    <!-- IE Fix for HTML5 Tags -->
    <!--[if lt IE 9]><script src="http://html5shiv.googlecode.com/svn/trunk/html5.js"></script><![endif]-->

    <!-- RSS + PingBack -->
    <link rel="alternate" type="application/rss+xml" title="RSS 2.0" href="<?php bloginfo('rss2_url'); ?>" />
    <link rel="alternate" type="text/xml" title="RSS .92" href="<?php bloginfo('rss_url'); ?>" />
    <link rel="alternate" type="application/atom+xml" title="Atom 1.0" href="<?php bloginfo('atom_url'); ?>" />
    <link rel="pingback" href="<?php bloginfo( 'pingback_url' ); ?>" />

    <!-- WPHEAD -->
    <?php wp_head(); ?>

</head>
<body id="homepage" <?php body_class(); ?>>

<?php global $smof_data;
$show_loader = $smof_data['hide_loader'];
$your_uploaded_loader = $smof_data['uploaded_loader'];
$dreamer_slideshow_pattern = $smof_data['slideshow_pattern'];
$dreamer_slideshow_overlay = $smof_data['slideshow_overlay'];
$dreamer_slideshow_triangles_overlay = $smof_data['slideshow_triangles_overlay'];
$dreamer_facebook_header = $smof_data['facebook_header'];
$dreamer_twitter_header = $smof_data['twitter_header'];
$dreamer_homepage_content = $smof_data['homepage_content'];
$pattern_image = $smof_data['slideshow_pattern_image'];
$overlay_color = $smof_data['slideshow_overlay_color'];
?>



<?php if ($show_loader): ?>
<?php else: ?>
    <!-- Loader -->
    <div id="loading">
        <?php
        $template_url = get_template_directory_uri();
        if (isset($your_uploaded_loader[0]) && $your_uploaded_loader[1]) {
            echo '<img src="' .$your_uploaded_loader. '"  alt="">'  ;
        } else {
            echo '<img src="' .$template_url. '/images/loader.gif"  alt="">';
        } ?>
    </div>
<?php endif ?>


<?php
if ($dreamer_slideshow_pattern && !empty($pattern_image)) {
    echo'<div class="slideshow-pattern" style="background-image: url('.$pattern_image.');"></div>';
} else {
} ?>

<?php
if ($dreamer_slideshow_overlay && !empty($overlay_color)) {
    echo'<div class="slideshow-overlay" style="background-color: '.$overlay_color.'"></div>';
} else {
} ?>

<?php
if ($dreamer_slideshow_triangles_overlay) {
    echo'<div class="triangle-top"></div><div class="triangle-bottom"></div>';
} else {
} ?>

<div class="mobile-nav-container">
    <div class="scroll-wrapp">
        <?php if (is_page_template('template-background-slideshow.php') || is_page_template('template-background-video.php') || is_page_template('template-revolution-slider.php')): ?>
            <?php $defaults = array(
                'theme_location'  => 'primary',
                'menu'            => '',
                'container'       => '',
                'echo'            => true,
                'fallback_cb'     => 'wp_page_menu',
                'items_wrap'      => '<ul id="menu-main-menu" class="%2$s">%3$s</ul>',
                'depth'           => 0,
                'walker'          => ''
            );
            wp_nav_menu( $defaults );
            ?>
        <?php else: ?>
            <?php $defaults = array(
                'theme_location'  => 'blog-menu',
                'menu'            => '',
                'container'       => '',
                'echo'            => true,
                'fallback_cb'     => '',
                'items_wrap'      => '<ul class="%2$s">%3$s</ul>',
                'depth'           => 0,
                'walker'          => ''
            );
            wp_nav_menu( $defaults );
            ?>
        <?php endif ?>
    </div>
</div>


<div class="header-container">

    <!-- Basic Needs -->
    <div class="row">
        <nav class="top-bar">
            <div class="menu-mobile-nav">
                <a href="#"><i class="fa fa-list"></i></a>
            </div>
            <ul>
                <li class="name">
                    <a href="<?php echo home_url(); ?>"><?php
                    $dreamer_logo = $smof_data['uploaded_logo'];
                    $template_url = get_template_directory_uri();
                    if (isset($dreamer_logo[0]) && $dreamer_logo[1]) {
                        echo '<img src="' .$dreamer_logo. '"  alt="">'  ;
                    } else {
                        echo '<img src="' .$template_url. '/images/logo.png"  alt="">';
                    } ?></a>
                </li>
            </ul>
            <?php if (is_page_template('template-background-slideshow.php') || is_page_template('template-background-video.php') || is_page_template('template-revolution-slider.php')): ?>
                <?php $defaults = array(
                    'theme_location'  => 'primary',
                    'menu'            => '',
                    'container'       => '',
                    'echo'            => true,
                    'fallback_cb'     => 'wp_page_menu',
                    'items_wrap'      => '<ul id="menu-main-menu" class="%2$s">%3$s</ul>',
                    'depth'           => 0,
                    'walker'          => ''
                );
                wp_nav_menu( $defaults );
                ?>
            <?php else: ?>
                <?php $defaults = array(
                    'theme_location'  => 'blog-menu',
                    'menu'            => '',
                    'container'       => '',
                    'echo'            => true,
                    'fallback_cb'     => '',
                    'items_wrap'      => '<ul class="%2$s">%3$s</ul>',
                    'depth'           => 0,
                    'walker'          => ''
                );
                wp_nav_menu( $defaults );
                ?>
            <?php endif ?>
        </nav>

        <?php if (!empty($dreamer_facebook_header)): ?>
        <?php echo '<a href="'.$dreamer_facebook_header. '" class="facebook-header" target="_blank"></a>'; ?>
        <?php endif ?>

        <?php if (!empty($dreamer_twitter_header)): ?>
        <?php echo '<a href="'.$dreamer_twitter_header. '" class="twitter-header" target="_blank"></a>'; ?>
        <?php endif ?>
    </div>
</div>

<?php
if (is_page_template('template-background-slideshow.php') || is_page_template('template-background-video.php') ) {
    get_template_part( 'includes/homepage-content' );
} else {
    //
} ?>