<!DOCTYPE html>
<!--[if lt IE 7 ]><html class="ie ie6" lang="en"> <![endif]-->
<!--[if IE 7 ]><html class="ie ie7" lang="en"> <![endif]-->
<!--[if IE 8 ]><html class="ie ie8" lang="en"> <![endif]-->
<!--[if IE 9 ]><html class="ie ie9" lang="en"> <![endif]-->
<!--[if !IE]><!--><html <?php language_attributes(); ?>> <!--<![endif]-->
<head>
<?php
	global $ttso;
	$logo                             = $ttso->st_sitelogo;
	$custom_logo                      = $ttso->st_logo_icon;
	$custom_logo_text                 = strip_tags( stripslashes( $ttso->st_logo_text ) );
	$toolbar                          = $ttso->st_toolbar;
	$responsive                       = $ttso->st_responsive;
	$boxedlayout                      = $ttso->st_boxedlayout;
	$true_sticky_header               = $ttso->st_true_sticky_header;
	$true_logo                        = $ttso->st_true_logo;
?>
<meta charset="utf-8" />
<?php if ( 'false' == $responsive ) : ?>
	<meta name="viewport" content="width=device-width, initial-scale=1.0" />
<?php endif; ?>
<title><?php wp_title( '&laquo;', true, 'right' ); ?> <?php bloginfo( 'name' ); ?></title>
<link rel="pingback" href="<?php bloginfo( 'pingback_url' ); ?>" />
<link rel="alternate" type="application/rss+xml" title="<?php bloginfo( 'name' ); ?>" href="<?php bloginfo( 'rss2_url' ); ?>" />

<?php wp_head(); ?>
<!--[if IE 8]>
<style type="text/css" media="screen">
header .sub-menu {
      behavior: url(<?php echo get_template_directory_uri(); ?>/css/PIE/PIE.php);
}
</style>
<![endif]-->

<!--[if IE]>
	<link rel="stylesheet" href="<?php echo get_template_directory_uri(); ?>/css/IE.css" />
<![endif]-->

<!--[if lt IE 9]>
	<script src="http://html5shiv.googlecode.com/svn/trunk/html5.js"></script>
	<script type="text/javascript" src="<?php echo get_template_directory_uri(); ?>/framework/js/IE.js"></script>
<![endif]-->

<?php get_template_part( 'template-part-page-styling', 'childtheme' ); ?>
</head>
<body <?php body_class();?>>
<?php
//sticky header
if (('Sticky Header - CSS3 Animated' == $true_sticky_header) || ('Sticky Header' == $true_sticky_header)) {
	$true_header_class  = 'class="tt-sticky-header"';
	$true_wrapper_class = 'class="tt-sticky-wrapper"';
}


//logo position class (called on line 90 of this file)
 if ('right' == $true_logo){
    $true_logo_class  = 'class="tt-logo-right"';
 } elseif ('center' == $true_logo){
    $true_logo_class  = 'class="tt-logo-center"';
} else {
    $true_logo_class  = '';
}


//boxed layout check
if ( 'true' == $boxedlayout ) {echo '<div id="tt-boxed-layout" '.$true_wrapper_class.'>';}else{echo '<div id="tt-wide-layout" '.$true_wrapper_class.'>';}
?>

<div id="tt-header-wrap" <?php echo $true_header_class; ?>>

<?php
//toolbar check
if ( 'true' == $toolbar ) {
?>
    <aside class="top-aside clearfix">
        <div class="center-wrap">
            <div class="one_half">
                <?php dynamic_sidebar( 'Top Left Toolbar' ); ?>
            </div><!-- end .top-toolbar-left -->

            <div class="one_half">
                <?php dynamic_sidebar( 'Top Right Toolbar' ); ?>
            </div><!-- end .top-toolbar-right -->
        </div><!-- end .center-wrap -->
        <div class="top-aside-shadow"></div>
    </aside>
<?php } ?>

    <header <?php echo $true_logo_class; ?>>
        <div class="center-wrap">
            <div class="companyIdentity">
                <?php if ( is_page_template( 'page-template-under-construction.php' ) ) { ?>
                    <img src="<?php echo esc_url( $logo ); ?>" alt="<?php bloginfo( 'name' ); ?>" />
                <?php } else { ?>
                    <?php if ( '' == $custom_logo_text ) { ?>
                        <a href="<?php echo home_url(); ?>"><img src="<?php echo esc_url( $logo ); ?>" alt="<?php bloginfo( 'name' ); ?>" /></a>
                    <?php } else { ?>
                        <a href="<?php echo home_url(); ?>"><img src="<?php echo get_template_directory_uri(); ?>/images/global/<?php echo esc_attr( $custom_logo ); ?>" alt="<?php bloginfo( 'name' ); ?>" /></a>
                        <h1><a href="<?php echo home_url(); ?>"><?php echo esc_html( $custom_logo_text ); ?></a></h1>
                    <?php } ?>
                <?php } ?>
            </div><!-- end .companyIdentity -->
            <nav>
                <ul id="menu-main-nav">
                    <?php wp_nav_menu( array( 'container' => false, 'theme_location' => 'Main Menu', 'depth' => 0 ) ); ?>
                </ul>
            </nav>
        </div><!-- end .center-wrap -->
    </header>
</div><!-- END #tt-header-wrap -->