<?php
/**
 * The header for our theme.
 *
 * Displays all of the <head> section and everything up till <div id="content">
 *
 * @package quote
 */
?><!DOCTYPE html>
<html <?php language_attributes(); ?>>
<head>
<meta charset="<?php bloginfo( 'charset' ); ?>">
<meta name="viewport" content="width=device-width, initial-scale=1">
<title><?php wp_title( '|', true, 'right' ); ?></title>
<link rel="profile" href="http://gmpg.org/xfn/11">
<link rel="pingback" href="<?php bloginfo( 'pingback_url' ); ?>">

<?php wp_head(); ?>
</head>

<body <?php body_class(); ?>>

    <?php $preloader = get_theme_mod('show_preloader', 1); if($preloader) { ?>
    <div id="preloader"></div>
    <?php } ?>

    <?php if(get_theme_mod('show_header_search')) { ?>
    <div id="search-wrapper">
        <div class="container">
            <form role="search" method="get" id="searchform" action="<?php echo home_url( '/' ); ?>" role="form">
                <div class="input-group">
                    <input type="text" value="" name="s" id="s" class="form-control" placeholder="<?php _e('Search', DISTINCTIVETHEMESTEXTDOMAIN); ?>" />
                    <span class="input-group-btn">
                        <button class="btn btn-primary btn-outlined" type="submit"><i class="fa fa-search"></i></button>
                    </span>
                    <span class="close-trigger"><i class="fa fa-angle-up"></i></span>
                </div>
            </form>
        </div>
    </div>
    <?php } ?>
    
    <?php 
    $menustyle = get_theme_mod('menu_style' , 'side');
    if(empty($menustyle)) { $menustyle = 'side'; }
    if ($menustyle == 'top') { 
        include('top-nav-bar.php');
    } elseif ($menustyle == 'side') {
        include('side-nav-bar.php');
    } ?>      

	<div id="content-wrapper">