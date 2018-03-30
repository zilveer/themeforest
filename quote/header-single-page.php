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

    <?php $preloader = get_theme_mod('show_preloader' , 1); if($preloader) { ?>
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
    
    <?php include('nav-single-page.php'); ?>    
	
	<!-- MAIN IMAGE SECTION -->
	<div id="headerwrap" class="fullsize">
		<div class="container">
			<div class="row">
                <?php if ( is_404() ) { ?>
                <div id="bannertext" class="col-lg-8 col-lg-offset-2">
                    <h1 class="fade-down gap"><span class="pe-7s-close-circle"></span> OOPS</h1>
                    <h2 class="fade-up">The Requested Page Cannot Be Found.</h2>
                    <div class="spacer"></div>          
                </div>
                <?php } else { 
                    $showwelcome = get_theme_mod('show_welcome_msg' , 'show');
                    $welcome = get_option('headline_title' , 'QUOTE');
                    $welcometext = get_option('headline_text' , 'WE LOVE PIXEL PERFECTION');
                    $welcomeicon = get_theme_mod('headline_icon' , 'pe-7s-chat');
                    if($showwelcome == 'show') { ?>
        				<div id="bannertext" class="col-lg-8 col-lg-offset-2">
        					<h1 class="fade-down gap"><?php if (strpos($welcomeicon,'fa-icon') !== false) { ?><i class="fa <?php echo $welcomeicon; ?> home-icon bounce-in"></i><?php } else { ?><span class="home-icon bounce-in <?php echo $welcomeicon; ?>"></span><?php } ?> <?php echo htmlspecialchars_decode($welcome); ?></h1>
        					<h2 class="fade-up"><?php echo htmlspecialchars_decode($welcometext); ?></h2>
        					<div class="spacer"></div>			
        				</div>  
                    <?php } ?>
                <?php } ?>
			</div><!-- row -->
		</div><!-- /container -->
        <?php if ( !is_404() ) { ?>
		<span class="headerwrap-btn-wrap">
			<a href="#content-wrapper" class="headerwrap-btn"><i class="fade-up fa fa-angle-down"></i></a>
		</span>	
        <?php } ?>
	</div><!-- /headerwrap -->

	<div id="content-wrapper">